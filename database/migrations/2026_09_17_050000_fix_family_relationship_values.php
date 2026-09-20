<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite' || !Schema::hasTable('family_relationships')) {
            return;
        }

        $tableSql = DB::selectOne(
            "select sql from sqlite_master where type = 'table' and name = 'family_relationships'"
        )?->sql;

        if (!$tableSql || !str_contains($tableSql, "'lainnya lain'")) {
            return;
        }

        DB::statement('PRAGMA foreign_keys = OFF');

        DB::statement('CREATE TABLE family_relationships_new (
            id integer primary key autoincrement not null,
            family_id integer not null,
            resident_id integer not null,
            family_relationship varchar not null check (family_relationship in (
                \'kepala keluarga\', \'suami\', \'istri\', \'anak\', \'orang tua\',
                \'keponakan\', \'saudara\', \'sepupu\', \'mertua\', \'menantu\',
                \'cucu\', \'lainnya\'
            )),
            created_at datetime,
            updated_at datetime,
            foreign key (family_id) references families(id) on delete cascade,
            foreign key (resident_id) references residents(id) on delete cascade
        )');

        DB::statement("insert into family_relationships_new
            (id, family_id, resident_id, family_relationship, created_at, updated_at)
            select id, family_id, resident_id,
                case when family_relationship = 'lainnya lain' then 'lainnya'
                     else family_relationship end,
                created_at, updated_at
            from family_relationships");

        Schema::drop('family_relationships');
        Schema::rename('family_relationships_new', 'family_relationships');

        DB::statement('PRAGMA foreign_keys = ON');
    }

    public function down(): void
    {
        // The corrected relationship values are intentionally retained on rollback.
    }
};

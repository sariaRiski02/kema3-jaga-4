<?php

namespace Tests\Feature;

use App\Models\Family;
use App\Models\Resident;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTemplateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withSession(['is_admin' => true]);
    }

    public function test_download_template_returns_csv_template(): void
    {
        $response = $this->get(route('dashboard.download-template'));

        $response->assertOk();
        $this->assertStringContainsString('nik,nama,jenis_kelamin', $response->streamedContent());
        $this->assertStringContainsString('no_kk', $response->streamedContent());
    }

    public function test_import_resident_csv_creates_resident_and_family_relationship(): void
    {
        $csv = "nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,alamat,status_dikeluarga,pekerjaan,agama,status_perkawinan,pendidikan,no_kk\n";
        $csv .= "1234567890123456,Budi Santoso,Laki-laki,Bandung,12-05-1990,Jl. Merdeka 1,kepala keluarga,PNS,Islam,Kawin,SMA/SMK,1234567890123456\n";

        $response = $this->post(route('dashboard.store-import-resident'), [
            'file' => UploadedFile::fake()->createWithContent('warga.csv', $csv),
        ]);

        $response->assertRedirect(route('dashboard.import-resident'));
        $this->assertDatabaseHas('residents', [
            'nik' => '1234567890123456',
            'name' => 'Budi Santoso',
            'place_of_birth' => 'Bandung',
            'gender' => 'laki-laki',
        ]);
        $this->assertSame('1990-05-12', Resident::where('nik', '1234567890123456')->first()->date_of_birth->format('Y-m-d'));
        $this->assertDatabaseHas('families', [
            'family_number' => '1234567890123456',
        ]);
        $this->assertDatabaseHas('family_relationships', [
            'family_relationship' => 'kepala keluarga',
        ]);
    }

    public function test_import_resident_accepts_excel_serial_date(): void
    {
        $csv = "nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir\n";
        $csv .= "1234567890123457,Siti Aminah,Perempuan,Manado,33000\n";

        $response = $this->post(route('dashboard.store-import-resident'), [
            'file' => UploadedFile::fake()->createWithContent('warga.csv', $csv),
        ]);

        $response->assertRedirect(route('dashboard.import-resident'));
        $resident = Resident::where('nik', '1234567890123457')->first();

        $this->assertNotNull($resident);
        $this->assertSame('1990-05-07', $resident->date_of_birth->format('Y-m-d'));
    }

    public function test_import_resident_normalizes_option_values_without_case_sensitivity(): void
    {
        $csv = "nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,agama,pendidikan\n";
        $csv .= "1234567890123458,Andi Setiawan,laki-laki,Manado,12-05-1990,BUDDHA,SMA / SMK\n";

        $response = $this->post(route('dashboard.store-import-resident'), [
            'file' => UploadedFile::fake()->createWithContent('warga.csv', $csv),
        ]);

        $response->assertRedirect(route('dashboard.import-resident'));
        $this->assertDatabaseHas('residents', [
            'nik' => '1234567890123458',
            'religion' => 'buddha',
            'education' => 'sma/sederajat',
        ]);
    }

    public function test_import_resident_accepts_lainnya_family_relationship(): void
    {
        $csv = "nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,status_dikeluarga,no_kk\n";
        $csv .= "1234567890123459,Made Contoh,Laki-laki,Denpasar,12-05-1990,lainnya,1234567890123459\n";

        $response = $this->post(route('dashboard.store-import-resident'), [
            'file' => UploadedFile::fake()->createWithContent('warga.csv', $csv),
        ]);

        $response->assertRedirect(route('dashboard.import-resident'));
        $this->assertDatabaseHas('family_relationships', [
            'family_relationship' => 'lainnya',
        ]);
    }

    public function test_import_marks_higher_education_resident_as_currently_studying(): void
    {
        $csv = "nik,nama,jenis_kelamin,tempat_lahir,tanggal_lahir,pendidikan,sedang_bersekolah\n";
        $csv .= "1234567890123460,Rina Contoh,Perempuan,Manado,12-05-1990,Sarjana,YA\n";

        $response = $this->post(route('dashboard.store-import-resident'), [
            'file' => UploadedFile::fake()->createWithContent('warga.csv', $csv),
        ]);

        $response->assertRedirect(route('dashboard.import-resident'));
        $this->assertDatabaseHas('residents', [
            'nik' => '1234567890123460',
            'education' => 'sarjana',
            'is_currently_studying' => 1,
        ]);
    }
}

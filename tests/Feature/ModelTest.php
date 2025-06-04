<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Warga;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_model(): void
    {
        // Membuat 1 data warga
        $warga = Warga::factory()->create();

        $found = Warga::first();
        dd($found);
    }
}

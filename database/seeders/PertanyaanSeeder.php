<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $pertanyaan = \App\Models\Pertanyaan::create([
            'kode' => 'kuisioner-kib24jam2',
            'pertanyaan' => 'Rating penilaian pelayanan Kantor KIB (Keramahan Petugas, Kemudahan Pelayanan, dan ANTI PENYUAPAN)',
            'catatan' => 'dibuat oleh seeder'
        ]);
        \App\Models\PertanyaanValue::create([
            'pertanyaan_id' => $pertanyaan->id,
            'value' => 'Sangat Kurang'
        ]);
        \App\Models\PertanyaanValue::create([
            'pertanyaan_id' => $pertanyaan->id,
            'value' => 'Kurang'
        ]);
        \App\Models\PertanyaanValue::create([
            'pertanyaan_id' => $pertanyaan->id,
            'value' => 'Cukup'
        ]);
        \App\Models\PertanyaanValue::create([
            'pertanyaan_id' => $pertanyaan->id,
            'value' => 'Baik'
        ]);
        \App\Models\PertanyaanValue::create([
            'pertanyaan_id' => $pertanyaan->id,
            'value' => 'Sangat Baik'
        ]);
    }
}

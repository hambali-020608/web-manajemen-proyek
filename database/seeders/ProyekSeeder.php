<?php

namespace Database\Seeders;

use App\Models\Proyek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proyek::create([
          'nama_proyek' => 'Bangun Restorant',
          'id_klien'=>1,
          'deadline_proyek' => '2025-06-30',
          'status_proyek' => 'done',
          'tanggal_mulai' => now(),
          
        ]);
        Proyek::create([
          'nama_proyek' => 'Bangun Hotel',
          'id_klien'=>1,
          'deadline_proyek' => '2025-06-30',
          'status_proyek' => 'pending',
          'tanggal_mulai' => now(),
          
        ]);
    }
}

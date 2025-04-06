<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Klien;
use App\Models\Obrolan;
use App\Models\Proyek;
use App\Models\Tukang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObrolanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    
    public function run(): void
    {
        $karyawan = Karyawan::first();
        $klien = Klien::first();
        $tukang = Tukang::first();
        $proyek = Proyek::first();
        // $proyek2 = Proyek::where('id', 2);
        Obrolan::create([
            'sender_type'=> get_class($karyawan),
            'sender_id'=>$karyawan->id,
            'proyek_id'=>$proyek->id,
            'message'=> 'halo',
            
          ]);
        Obrolan::create([
            'sender_type'=> get_class($tukang),
            'sender_id'=>$tukang->id,
            'proyek_id'=>$proyek->id,
            'message'=> 'oit',
            
          ]);
        Obrolan::create([
            'sender_type'=> get_class($klien),
            'sender_id'=>$klien->id,
            'proyek_id'=>2,
            'message'=> 'hai',
            
          ]);
    }
}

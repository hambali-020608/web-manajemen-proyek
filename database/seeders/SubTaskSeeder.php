<?php

namespace Database\Seeders;

use App\Models\SubTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubTask::create([
            'nama_sub_task'=>'Welding',
            'id_task'=>1,
            'deadline_sub_task'=>'2025-06-20',
            'id_tukang'=>1,
    
            
        ]);
        SubTask::create([
            'nama_sub_task'=>'angkat kayu',
            'id_task'=>1,
            'id_tukang'=>1,
            'deadline_sub_task'=>'2025-06-20',
            'status_sub_task'=>'completed',
    
            
        ]);
        SubTask::create([
            'nama_sub_task'=>'Angkat besi',
            'id_task'=>1,
            'id_tukang'=>2,
            'deadline_sub_task'=>'2025-06-20',
            'status_sub_task'=>'completed',
    
            
        ]);
        SubTask::create([
            'nama_sub_task'=>'Angkat besi',
            'id_task'=>2,
            'id_tukang'=>1,
            'deadline_sub_task'=>'2025-06-20',
            'status_sub_task'=>'completed',
    
            
        ]);
    }
}

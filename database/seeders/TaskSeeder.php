<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'nama_task'=>'Pembangunan fondasi',
            'id_proyek'=>1,
            'deadline_task'=>'2025-06-20',
    
            
        ]);
        Task::create([
            'nama_task'=>'Dekorasi',
            'id_proyek'=>1,
            'deadline_task'=>'2025-06-20',
    
            
        ]);
    }
}

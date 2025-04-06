<?php

namespace Database\Seeders;

use App\Models\TestProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestProject::create([
            'proyek_id'=>1,
            'quality_id'=>1,
            
        ]);
    }
}

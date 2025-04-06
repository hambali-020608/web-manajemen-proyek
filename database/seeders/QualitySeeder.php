<?php

namespace Database\Seeders;

use App\Models\Quality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quality::create([
            'quality_name'=>'Kualitas material',
        
        ]);
    }
}

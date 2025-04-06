<?php

namespace Database\Seeders;

use App\Models\Klien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Klien::factory()->create([
            'name' => 'tian',
            'email' => 'tian@gmail.com',
            'password' => '123',
            
        ]);
    }
}

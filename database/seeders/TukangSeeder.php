<?php

namespace Database\Seeders;

use App\Models\Tukang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TukangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tukang::create([
            'name' => 'bastian',
            'email' => 'bastian@gmail.com',
            'password' => '123',
           
        ]);
        Tukang::create([
            'name' => 'morgan',
            'email' => 'morgan@gmail.com',
            'password' => '123',
           
            
        ]);
    }
}

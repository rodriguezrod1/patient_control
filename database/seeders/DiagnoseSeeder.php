<?php

namespace Database\Seeders;

use App\Models\Diagnose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnoseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diagnose::factory()->count(50)->create();
    }
}

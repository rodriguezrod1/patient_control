<?php

namespace Database\Seeders;

use App\Models\PatientDiagnose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientDiagnoseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PatientDiagnose::factory()->count(50)->create();
    }
}

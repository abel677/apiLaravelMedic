<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialties')->insert([
            'specialty' => 'Cirugía Neurológica',
        ]);
        DB::table('specialties')->insert([
            'specialty' => 'Radio-Oncología',
        ]);
        DB::table('specialties')->insert([
            'specialty' => 'Oncología Pediátrica',
        ]);
        DB::table('specialties')->insert([
            'specialty' => 'Oncología Médica',
        ]);
        DB::table('specialties')->insert([
            'specialty' => 'Cirugía Oncológica',
        ]);

        DB::table('specialties')->insert([
            'specialty' => 'Hematología',
        ]);
        DB::table('specialties')->insert([
            'specialty' => 'Urología',
        ]);
        DB::table('specialties')->insert([
            'specialty' => 'Medicina General',
        ]);
    }
}

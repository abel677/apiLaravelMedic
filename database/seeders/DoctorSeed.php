<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            'idPerson' => 2,
            'idSpecialty' => 4,
            'idSchedule' => 2,
        ]);
        DB::table('doctors')->insert([
            'idPerson' => 3,
            'idSpecialty' => 6,
            'idSchedule' => 4,
        ]);
    }
}

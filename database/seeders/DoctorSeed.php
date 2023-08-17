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
            'idPerson' => 1,
            'idSpecialty' => 1,
            'idSchedule' => 1,
        ]);
        DB::table('doctors')->insert([
            'idPerson' => 2,
            'idSpecialty' => 1,
            'idSchedule' => 2,
        ]);
        DB::table('doctors')->insert([
            'idPerson' => 3,
            'idSpecialty' => 1,
            'idSchedule' => 3,
        ]);
        DB::table('doctors')->insert([
            'idPerson' => 4,
            'idSpecialty' => 1,
            'idSchedule' => 4,
        ]);

        DB::table('doctors')->insert([
            'idPerson' => 5,
            'idSpecialty' => 2,
            'idSchedule' => 1,
        ]);
        DB::table('doctors')->insert([
            'idPerson' => 6,
            'idSpecialty' => 2,
            'idSchedule' => 2,
        ]);
        DB::table('doctors')->insert([
            'idPerson' => 7,
            'idSpecialty' => 2,
            'idSchedule' => 3,
        ]);


    }
}

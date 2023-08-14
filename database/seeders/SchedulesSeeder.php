<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert([
            'schedule' => '06h30 - 08h30',
        ]);

        DB::table('schedules')->insert([
            'schedule' => '08h30 - 10h30',
        ]);

        DB::table('schedules')->insert([
            'schedule' => '10h30 - 12h30',
        ]);

        DB::table('schedules')->insert([
            'schedule' => '14h30 - 16h30',
        ]);
    }
}

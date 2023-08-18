<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => Hash::make('Pass123$')
        // ]);


        $this->call([
            UserSeeder::class,
            RolesSeed::class,
            
            PageSeed::class,
            PageRolSeed::class,

            UserRoleSeed::class,
            GenderSeeder::class,
            SpecialtySeeder::class,
            SchedulesSeeder::class,
            PersonSeed::class,
            DoctorSeed::class,
            //PatientSeed::class
        ]);
    }
}

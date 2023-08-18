<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Romario',
            'email' => 'romario@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
        DB::table('users')->insert([
            'name' => 'Jhaira',
            'email' => 'jahaira@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
        DB::table('users')->insert([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
        DB::table('users')->insert([
            'name' => 'Betty',
            'email' => 'bety@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
        DB::table('users')->insert([
            'name' => 'Ladys',
            'email' => 'ladys@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
        DB::table('users')->insert([
            'name' => 'David',
            'email' => 'david@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
        DB::table('users')->insert([
            'name' => 'Johan',
            'email' => 'joah@gmail.com',
            'password' => Hash::make('Pass123$')
        ]);
    }
}

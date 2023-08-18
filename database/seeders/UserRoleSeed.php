<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('usersroles')->insert([
            'idRole' => 1,
            'idUser' => 1,
        ]);
        DB::table('usersroles')->insert([
            'idRole' => 2,
            'idUser' => 2,
        ]);
        DB::table('usersroles')->insert([
            'idRole' => 2,
            'idUser' => 3,
        ]);
        DB::table('usersroles')->insert([
            'idRole' => 2,
            'idUser' => 4,
        ]);
        DB::table('usersroles')->insert([
            'idRole' => 2,
            'idUser' => 5,
        ]);
        DB::table('usersroles')->insert([
            'idRole' => 2,
            'idUser' => 6,
        ]);
        DB::table('usersroles')->insert([
            'idRole' => 2,
            'idUser' => 7,
        ]);
    }
}

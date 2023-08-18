<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageRolSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('permissionsRoles')->insert([
            'idPage' => 1,
            'idRole' => 2,
        ]);
        DB::table('permissionsRoles')->insert([
            'idPage' => 1,
            'idRole' => 3,
        ]);


        DB::table('permissionsRoles')->insert([
            'idPage' => 2,
            'idRole' => 3,
        ]);
        DB::table('permissionsRoles')->insert([
            'idPage' => 3,
            'idRole' => 2,
        ]);

        DB::table('permissionsRoles')->insert([
            'idPage' => 4,
            'idRole' => 2,
        ]);
        DB::table('permissionsRoles')->insert([
            'idPage' => 4,
            'idRole' => 3,
        ]);
    }
}

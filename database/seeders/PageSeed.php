<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('pages')->insert([
            'menu' => 'Inicio',
            'name' => 'Inicio',
            'url' => '/home'
        ]);
        DB::table('pages')->insert([
            'menu' => 'Agendar Cita',
            'name' => 'Agendar Cita',
            'url' => '/home/appointments'
        ]);
        DB::table('pages')->insert([
            'menu' => 'Resolver Cita',
            'name' => 'Resolver Cita',
            'url' => '/home/resolved/appointments'
        ]);
        DB::table('pages')->insert([
            'menu' => 'Contacto',
            'name' => 'Contacto',
            'url' => '/home/personal/contact'
        ]);
    }
}

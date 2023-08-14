<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('persons')->insert([
            'name' => 'Abel Agutín',
            'lastName' => 'Abel Mejía',
            'birthDate' => '1997-01-13',
            'typeBlood' => 'O+',
            'direction' => 'La karina',
            'email' => 'abelandrade@gmail.com',
            'phone' => '0981976667',
            'idUser' => 11,
            'idGender' => 1,
        ]);
        DB::table('persons')->insert([
            'name' => 'Jhaira Asunción',
            'lastName' => 'Rios Cedeño',
            'birthDate' => '2021-03-13',
            'typeBlood' => 'A+',
            'direction' => 'Los Ceibos',
            'email' => 'jahariarios@gmail.com',
            'phone' => '0967600032',
            'idUser' => 1,
            'idGender' => 2,
        ]);
        DB::table('persons')->insert([
            'name' => 'Juan Roberto',
            'lastName' => 'Calderón Zambrano',
            'birthDate' => '1998-03-13',
            'typeBlood' => 'AO+',
            'direction' => 'Shanta Martha',
            'email' => 'juanCaleron@gmail.com',
            'phone' => '0967600030',
            'idUser' => 5,
            'idGender' => 1,
        ]);
    }
}

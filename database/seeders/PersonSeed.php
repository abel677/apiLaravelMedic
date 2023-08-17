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
            'name' => 'Romario Ram[on',
            'lastName' => 'Casanova Morales',
            'birthDate' => '1997-01-13',
            'typeBlood' => 'O+',
            'direction' => 'La Juanita',
            'phone' => '0981976667',
            'idUser' => 1,
            'idGender' => 1,
        ]);
        DB::table('persons')->insert([
            'name' => 'Jhaira Asunción',
            'lastName' => 'Rios Cedeño',
            'birthDate' => '2021-03-13',
            'typeBlood' => 'A+',
            'direction' => 'Los Ceibos',
            'phone' => '0967600032',
            'idUser' => 2,
            'idGender' => 2,
        ]);

        DB::table('persons')->insert([
            'name' => 'Juan Roberto',
            'lastName' => 'Calderon Zambrano',
            'birthDate' => '1998-03-13',
            'typeBlood' => 'AO+',
            'direction' => 'Santa Martha',
            'phone' => '0967600030',
            'idUser' => 3,
            'idGender' => 1,
        ]);

        DB::table('persons')->insert([
            'name' => 'Betty Maria',
            'lastName' => 'Mejía Vera',
            'birthDate' => '1985-03-13',
            'typeBlood' => 'A+',
            'direction' => 'La Karina',
            'phone' => '0967600416',
            'idUser' => 4,
            'idGender' => 2,
        ]);

        DB::table('persons')->insert([
            'name' => 'Ladys Marian',
            'lastName' => 'Cusme Solórzano',
            'birthDate' => '1990-03-13',
            'typeBlood' => 'O+',
            'direction' => 'Manta',
            'phone' => '0967612547',
            'idUser' => 5,
            'idGender' => 2,
        ]);

        DB::table('persons')->insert([
            'name' => 'David Alexander',
            'lastName' => 'Almeida Bravo',
            'birthDate' => '1995-03-13',
            'typeBlood' => 'A+',
            'direction' => 'Portoviejo',
            'phone' => '0987774412',
            'idUser' => 6,
            'idGender' => 1,
        ]);
        DB::table('persons')->insert([
            'name' => 'Johan Ariel',
            'lastName' => 'Cedeño Rendon',
            'birthDate' => '1985-03-13',
            'typeBlood' => 'A+',
            'direction' => 'Chone',
            'phone' => '0988556632',
            'idUser' => 7,
            'idGender' => 1,
        ]);
    }
}

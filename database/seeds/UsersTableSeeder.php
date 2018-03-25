<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert(
            [
                'name' => 'Douglas Alves Marcelino',
                'email' => 'douglas_champion@hotmail.com',
                'password' => bcrypt('pavalo'),
                'type' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Gabriel De Oliveira Azevedo',
                'email' => 'gabbrother@gmail.com',
                'password' => bcrypt('bar123'),
                'type' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Christian Souza Valentin',
                'email' => 'chris_valentin@outlook.com',
                'password' => bcrypt('abacate'),
                'type' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Bianca Silva Molina',
                'email' => 'bianca.molina9@hotmail.com',
                'password' => bcrypt('sagoba'),
                'type' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Gabriela Santos Oliveira',
                'email' => 'gabinew96@gmail.com',
                'password' => bcrypt('bolada'),
                'type' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Raquel Benetti Baldavira',
                'email' => 'bbaldavira@gmail.com',
                'password' => bcrypt('springboot'),
                'type' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Giovani Ravagnashauhdia',
                'email' => 'giovani@gmail.com',
                'password' => bcrypt('darnota10'),
                'type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'André Favareto',
                'email' => 'andre@ideia.com',
                'password' => bcrypt('ideias'),
                'type' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }
}

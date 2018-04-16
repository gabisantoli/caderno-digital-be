<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->truncate();

        DB::table('answers')->insert(
            [
                'text' => '<p>Discordo, SpringBoot é mozaumn</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 1,
                'post_id' => 1,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>Concordo com o Doug</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 3,
                'post_id' => 1,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>Xapou, vlws Gabii!</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 2,
                'post_id' => 2,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>Claro, melhor Scrum Master da turma!</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 7,
                'post_id' => 3,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>SAHUSHAUSHAUSHAUSAUS</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 3,
                'post_id' => 4,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>Inveja dessa mina ai eim</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 8,
                'post_id' => 4,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>Opa, como que apaga um comentario??? Alguem me ajuda!!!!</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 8,
                'post_id' => 4,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>ksoapkspaoskasokasp</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 6,
                'post_id' => 5,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>www.linkdorogerio.com</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 4,
                'post_id' => 7,
            ]
        );

        DB::table('answers')->insert(
            [
                'text' => '<p>Valeu Bia</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 5,
                'post_id' => 7,
            ]
        );
    }
}

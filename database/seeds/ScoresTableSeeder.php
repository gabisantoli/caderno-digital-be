<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scores')->truncate();

        DB::table('scores')->insert(
            [
                'user_id' => 1,
                'level' => 10,
                'points' => 50000,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 2,
                'level' => 8,
                'points' => 30000,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 3,
                'level' => 7,
                'points' => 20000,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 4,
                'level' => 8,
                'points' => 30000,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 5,
                'level' => 10,
                'points' => 99999,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 6,
                'level' => 7,
                'points' => 20000,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 7,
                'level' => 9,
                'points' => 45000,
            ]
        );

        DB::table('scores')->insert(
            [
                'user_id' => 8,
                'level' => 1,
                'points' => 200,
            ]
        );

    }
}

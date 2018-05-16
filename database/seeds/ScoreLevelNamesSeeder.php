<?php

use Illuminate\Database\Seeder;

class ScoreLevelNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('score_level_names')->truncate();

        DB::table('score_level_names')->insert(
            [
                'level_number' => 1,
                'name' => "Andrelson",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 2,
                'name' => "Trozobinha",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 3,
                'name' => "Donut",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 4,
                'name' => "CV2",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 5,
                'name' => "Migue",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 6,
                'name' => "Sagobeiro",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 7,
                'name' => "Moleirao",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 8,
                'name' => "Mariah Kellen",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 9,
                'name' => "Abacate",
            ]
        );

        DB::table('score_level_names')->insert(
            [
                'level_number' => 10,
                'name' => "PAVALO",
            ]
        );

    }
}

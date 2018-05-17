<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    
    public function updateScore($user_id, $pontos, $ganhar_pontos=true){
        $score = Score::where("user_id", $user_id)->take(1)->get()[0];
        if($ganhar_pontos){
            $score->points += $pontos;
        }else{
            $score->points -= $pontos;
        }
        $score->level = ManageUserLevel::checkLevel($score->points);
        $score->save();
    }
}

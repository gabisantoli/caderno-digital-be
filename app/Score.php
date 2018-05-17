<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * Adiciona e remove pontos de um usuário 
     * @param Integer $user_id - Id do usuário
     * @param Integer $pontos - Numero de pontos que será adicionados ou removidos
     * @param Boolean $ganhar_pontos - Se definido como true, soma os pontos, se não, remove os pontos
     **/   
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function getRatingFromContext($id, $context){
        $rating = new Rating();
        $num_rating = array();

        $condition = [
            "id_context" => $id,
            "context" => $context,
            "status" => "positivo"
        ];
        $num_rating['positivo'] = sizeof($rating::where($condition)->get()->toArray());

        $condition['status'] = "negativo"; 

        $num_rating['negativo'] = sizeof($rating::where($condition)->get()->toArray());

        return $num_rating;
    }

    public function calculateScore($rating, $points, $reverse=false){
        $score = new Score();
        $user_id = -1;

        if($rating->context == "post"){
            $post = Post::find($rating->id_context);
            $user_id = $post->user_id;
        }

        if($rating->context == "answer"){
            $answer = Answer::find($rating->id_context);
            $user_id = $answer->user_id;
        }

        if($rating->status == "positivo"){
            if(!$reverse) $score->updateScore($user_id, $points);
            if($reverse) $score->updateScore($user_id, $points, false);
        }
        
        if($rating->status == "negativo"){
            if(!$reverse) $score->updateScore($user_id, $points, false);
            if($reverse) $score->updateScore($user_id, $points);
        }

    }
}

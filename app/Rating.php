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

    public function userAlreadyRated($rating){
        $condition = [
            "id_user" => $rating->id_user,
            "id_context" => $rating->id_context,
            "context" => $rating->context
        ];
        return $rating::where($condition)->get()->toArray();
    }

    public function addClassCSSToVotingIcon($id_user, $id_context, $context, $context_obj){
        $rating_context = new Rating();
        $rating_context->id_user = $id_user;
        $rating_context->id_context = $id_context;
        $rating_context->context = $context;
        $voto_usuario = $this->userAlreadyRated($rating_context);

        if(sizeof($voto_usuario) != 0){
            
            if($voto_usuario[0]['status'] == "positivo"){
                $context_obj->flag_voto_usuario['positivo_css'] = "voto-positivo";
            }

            if($voto_usuario[0]['status'] == "negativo"){
                $context_obj->flag_voto_usuario['negativo_css'] = "voto-negativo";
            }
                
        }

        return $context_obj;
    }
}

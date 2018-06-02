<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * Retorna o número de votos positivos e negativos de uma postagem ou resposta
     * @param Integer $id - id de um post ou answer
     * @param String $context - contexto pode ser 'post' ou  'answer'
     * @return Array $num_rating - array com o número de votos positivos e negativos
     */
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

    /**
     * Atualiza o Score de um usuário após uma avaliação de postagem ou resposta
     * @param Object $rating - um objeto do tipo Rating
     * @param Integer $points - quantidade de pontos a ser recebida ou retirada
     * @param Boolean $reverse - inverte a lógica de soma e subtração de pontos
     * (ideal para quando o usuário quer remover uma avaliação)
     */
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

    /**
     * Verifica se o usuário já votou em uma postagem ou resposta em especifica
     * @param Object $rating - objeto do tipo Rating
     * @return Array - retorna um array Rating do voto do usuário
     */
    public function userAlreadyRated($rating){
        
        $condition = [
            "id_user" => $rating->id_user,
            "id_context" => $rating->id_context,
            "context" => $rating->context
        ];
        
        return $rating::where($condition)->get()->toArray();
    }

    /**
     * Adiciona uma classe CSS nos ícones de votação, caso o usuário tenha avaliado
     * uma postagem ou resposta
     * @param Integer $id_user - id do usuário
     * @param Integer $id_context - id de um post ou answer
     * @param String $context - context pode ser 'post' ou 'answer'
     * @param Object $context_obj - um objeto do tipo Post ou Answer
     * @return Object $context_obj - o mesmo objeto do parametro $context_obj
     */
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

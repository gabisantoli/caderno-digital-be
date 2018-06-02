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
}

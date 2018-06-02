<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    public $avaliacoes_positivas = 0;
    public $avaliacoes_negativas = 0;
    
    public $button = array(
        'delete' => false,
         'edit' => false
        );
    
    public $flag_voto_usuario = array(
        "positivo_css" => "", 
        "negativo_css" => ""
    );

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}

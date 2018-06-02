<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $avaliacoes_positivas = 0;
    public $avaliacoes_negativas = 0;
    public $flag_voto_usuario = array(
        "positivo_css" => "", 
        "negativo_css" => ""
    );
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

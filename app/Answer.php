<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    public $button = array('delete' => false, 'edit' => false);
    public $avaliacoes_positivas = 0;
    public $avaliacoes_negativas = 0;

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}

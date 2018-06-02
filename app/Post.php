<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $avaliacoes_positivas = 0;
    public $avaliacoes_negativas = 0;
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

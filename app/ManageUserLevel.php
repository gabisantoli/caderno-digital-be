<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageUserLevel extends Model
{
    public static function checkLevel($points){
        if($points < 1000) return 1;
        if($points >= 1000 && $points < 2000) return 2;
        if($points >= 2000 && $points < 5000) return 3;
        if($points >= 5000 && $points < 10000) return 4;
        if($points >= 10000 && $points < 15000) return 5;
        if($points >= 15000 && $points < 20000) return 6;
        if($points >= 20000 && $points < 30000) return 7;
        if($points >= 30000 && $points < 40000) return 8;
        if($points >= 40000 && $points < 50000) return 9;
        if($points >= 50000) return 10;
    }


}

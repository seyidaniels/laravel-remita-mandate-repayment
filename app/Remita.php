<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remita extends Model
{
    static function generateHashSha512($concatString = ""){
        $hash = hash('sha512', $concatString);
        return $hash;
    }
    
}

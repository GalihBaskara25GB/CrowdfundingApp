<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //

    public function articles() {
        return $this->hasMany(Article::class);
    }
    
}



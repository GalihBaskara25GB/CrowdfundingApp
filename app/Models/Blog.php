<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \App\Http\Traits\UsesUuid;

class Blog extends Model
{
    protected $table = 'blogs';
    
    use UsesUuid;
    protected $guarded=[];
}

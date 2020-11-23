<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \App\Http\Traits\UsesUuid;

class Campaign extends Model
{
    protected $table = 'campaigns';
    
    use UsesUuid;
    protected $guarded=[];
}

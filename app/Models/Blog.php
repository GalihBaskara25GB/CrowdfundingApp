<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\UuidTrait;

class Blog extends Model
{
    protected $table = 'blogs';
    
    use UuidTrait;
    protected $guarded=[];
}

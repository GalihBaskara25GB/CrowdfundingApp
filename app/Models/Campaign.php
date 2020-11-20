<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\UuidTrait;

class Campaign extends Model
{
    protected $table = 'campaigns';
    
    use UuidTrait;
    protected $guarded=[];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\UuidTrait;

class Role extends Model
{
    protected $table = 'roles';

    use UuidTrait;
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id');
    }
    
}

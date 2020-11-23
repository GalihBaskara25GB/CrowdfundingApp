<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \App\Http\Traits\UsesUuid;


class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = [];
    use UsesUuid;

    /**
     * The "booting" function of model
     *
     * @return void
     */
    protected static function boot() {
        // UuidTrait::bootUsesUuid();
        parent::boot();
        static::creating(function ($model) {
            if ( ! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function users()
    {
        return $this->hasMany('App\User', 'role_id');
    }
    
}

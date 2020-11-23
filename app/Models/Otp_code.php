<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \App\Http\Traits\UsesUuid;

class Otp_code extends Model
{
    
    protected $table = 'otp_codes';
    protected $guarded = [];
    use UsesUuid;
    
    // protected static function boot() {
    //     // UuidTrait::bootUsesUuid();
    //     parent::boot();
    //     static::creating(function ($model) {
    //         if ( ! $model->getKey()) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    // public function getIncrementing()
    // {
    //     return false;
    // }

    // /**
    //  * Get the auto-incrementing key type.
    //  *
    //  * @return string
    //  */
    // public function getKeyType()
    // {
    //     return 'string';
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

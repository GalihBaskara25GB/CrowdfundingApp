<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Traits\UuidTrait;
use App\Models\Articles\Article;
use App\Models\Role;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    // protected $table = 'users';

    // use UuidTrait;
    // protected $guarded = [];
     /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    protected function get_user_role_id()
    {
        $role = Role::where('role' , 'user')->first();
        return $role->attributes['id'];
    }

    public function isAdmin()
    {
        $role = Role::find($this->role_id)->role;
        if ($role == "admin") return true;
        return false;
    }

    public function isEmailVerified()
    {
        if ($this->email_verified_at != null) return true;
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsTo('App\Role');
    }

    public function otp_code()
    {
        return $this->hasOne('App\Otp_code', 'user_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function getRouteKeyName() {
        return 'id';
    }

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
           $model->role_id = $model->get_user_role_id();

        });
    }

}

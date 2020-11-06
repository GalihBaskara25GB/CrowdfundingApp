<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'subject_id'];
    protected $with = ['subject', 'user'];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

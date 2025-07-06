<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_tags()
    {
        return $this->belongsToMany(User::class, 'user_tags');
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'hashtag_post');
    }
}

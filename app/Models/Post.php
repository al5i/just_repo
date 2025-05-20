<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $tables = 'posts';
    protected $guarded = false;

    public function likers()
    {
        return $this->belongsToMany(User::class, 'post_user_likes', 'post_id', 'user_id');
    }

    public function commentators()
    {
        return $this->belongsToMany(User::class, 'post_user_comments', 'post_id', 'user_id');
    }

}

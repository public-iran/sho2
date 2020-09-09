<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_comments extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Post::class);
    }
}

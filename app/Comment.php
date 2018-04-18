<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table ='comments';

    protected $fillable =[
        'body',
        'commentable_id',
        'commentable_type',
        'user_id',

    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}

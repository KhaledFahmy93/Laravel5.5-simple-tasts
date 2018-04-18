<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use Sluggable;
    protected $fillable = [
        'title',
        'desc',
        'image',
        'user_id',
        "slug"
    ];
    protected $table  = 'posts';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }   

}

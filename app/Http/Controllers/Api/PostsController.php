<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\StoreBlogPost;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return PostResource::collection($posts);   
    }
    
    public function store(StoreBlogPost $request)
    {
        $post  = new Post([
            'title' => $request->title ,
        ]);
        $post->fill($request->all());
        $post->save();
        return new PostResource($post);
    }
}

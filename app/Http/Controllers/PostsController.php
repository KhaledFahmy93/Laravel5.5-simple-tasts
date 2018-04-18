<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\User;
use \App\Http\Requests\StoreBlogPost;
use App\Http\Requests\UpdatePost;
use Storage;
use Auth;
use Illuminate\Foundation\Console\UpCommand;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::Paginate(5);
        return view('posts.index',compact('posts'))
            ->with('i', (Request()->input('page', 1) - 1) * 5);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        $post  = new Post([
            'title' => $request->title ,
        ]);
        $path = $request->image->store('public');
        $post->fill($request->except("image"));
        $post->image = $path;
        

        // $post->comments()->create([
        //     'body' => 'blah for topic',
        //     'user_id' => Auth::id(),
        //     'commentable_id' => 2]);
        $post->save();
        // $post = Post::create(
        //     array_merge($request->except('image'),['image' => $path])
        // );
             
        return redirect()->route('posts.index')
        ->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = $post->comments; 
        return view('posts.show',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit',compact('post' , "users"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, $id)
    {   
        $post = Post::find($id);
        Storage::delete($post->image);

        $post->update($request->except("image"));
        $post->image= $request->image->store('public');
        $post->save();

        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $post =Post::find($id);
        Storage::delete($post->image);
        $post->delete();
        return redirect()
        ->route('posts.index')->with('success','Post deleted successfully');
    }

}

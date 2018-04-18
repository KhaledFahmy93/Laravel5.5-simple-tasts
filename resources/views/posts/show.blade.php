@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Post</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h3><strong>Title:</strong> </h3>
                {{ $post->title}}
            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h3><strong>Description:</strong></h3>
                {{ $post->desc}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <h3><strong>User name:</strong></h3>
                {{ $post->user->name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <h3><strong>Slug:</strong></h3>
                {{ $post->slug}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <h3><strong>User Email:</strong></h3>
                {{ $post->user->email}}
            </div>
        </div>
        @foreach($comments as $comment)
         <div>Comment By:</div> {{$comment->user->username}} <br />
          {{ $comment->body }};
        @endforeach
        {{ \Carbon\Carbon::parse($post->user->created_at)->format('l jS \of F Y h:i:s A')}}
    </div>
@endsection
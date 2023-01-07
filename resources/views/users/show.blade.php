@extends('layouts.basic')

@section('title', 'User:')

@section('content')
    <p>@ {{$user->username}}</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href={{route('posts.show', ['id'=>$post->id])}}> {{$post->title}}</a></li>
            <li>{{$post->text}}</li>
            <br>
        @endforeach
    </ul>

    <p>@ {{$user->username}} comments: </p>

    <ul>
        @foreach ($comments as $comment)
            <li>Post: <a href={{route('posts.show', ['id'=>$comment->post->id])}}> {{$comment->post->title}}</a></li>
            <li>@ {{$user->username}}: {{$comment->comment_text}}</li>
            <br>
        @endforeach
    </ul>

@endsection
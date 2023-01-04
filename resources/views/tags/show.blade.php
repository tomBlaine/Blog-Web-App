@extends('layouts.basic')

@section('title', 'Tags')

@section('content')
    <style>
        .post {
          display: flex;
          flex-direction: row;
          margin-bottom: 20px;
        }
        .username {
          font-weight: bold;
        }
        .post-title {
          margin-left: 10px;
        }
        .post-text {
          margin-left: 10px;
        }
    </style>

    <p>Posts using #{{$tag->name}}</p>
    <ul>
        @foreach ($posts as $post)
            <li class="username"><a href={{route('users.show', ['id'=>$post->user_id])}}> @ {{$post->User->username}}</a></li>
            <li class="post-title"><a href={{route('posts.show', ['id'=>$post->id])}}> Title: {{$post->title}}</a></li>
            <li class="post-text">Post: {{$post->text}}</li>
            <p> </p>
            <p> </p>
        @endforeach
    </ul>


@endsection
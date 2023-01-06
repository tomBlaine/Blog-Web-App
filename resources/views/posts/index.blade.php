@extends('layouts.basic')

@section('title', 'Timeline')

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
        .post-date {
          float: right;
        }
        .container {
          max-width: 75%; 
        }

    </style>

    @livewire('search')
    <div class="container">
    <p>Your Timeline:</p>
    <ul>
        @foreach ($posts as $post)
            <li class="username"><a href={{route('users.show', ['id'=>$post->user_id])}}> @ {{$post->User->username}}</a></li>
            <li class="post-title"><a href={{route('posts.show', ['id'=>$post->id])}}> Title: {{$post->title}}</a></li>
            <li class="post-text">Post: {{$post->text}}</li>
            <li class="post-date">Date: {{$post->created_at}}</li>
            <p> </p>
            <p> </p>
        @endforeach
    </ul>
    </div>

    {{ $posts->links() }}

@endsection
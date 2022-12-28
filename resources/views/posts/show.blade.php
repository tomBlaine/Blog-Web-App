@extends('layouts.basic')

@section('title', 'Posts')

@section('content')
    <ul>
        <li>Username: {{$post->User->username}}</li>
        <li>Title: {{$post->title}}</li>
        <li>Post: {{$post->text}}</li>

        <p> </p>
        <p>Comments: </p>
        <ul>
            @foreach ($comments as $comment)
                <li> {{$comment->User->username}}: {{$comment->comment_text}}</li>
            @endforeach
        </ul>

    </ul>

@endsection
@extends('layouts.basic')

@section('title', 'Posts')

@section('content')
    <ul>
        <li>Username: {{$post->User->username}}</li>
        <li>Title: {{$post->title}}</li>
        <li>Post: {{$post->text}}</li>

        @if ($post->User->id = auth()->id())
            <form method="POST" action="{{route('posts.destroy', ['id'=>$post])}}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif


        <p> </p>
        <p>Comments: </p>
        <ul>
            @foreach ($comments as $comment)
                <li> {{$comment->User->username}}: {{$comment->comment_text}}</li>
            @endforeach
        </ul>

        <form method="POST" action="{{route('comments.store', ['id'=>$post])}}">
            @csrf
            <p>Your Comment: <input type="text" name="comment"></p>
            <input type="submit" value="Post">
        </form>


    </ul>

@endsection
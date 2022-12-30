@extends('layouts.basic')

@section('title', 'Posts')

@section('content')
    <style>
    .comment-container {
        display: flex;
    }

    </style>

    <ul>
        <li>Username: {{$post->User->username}}</li>
        <li>Title: {{$post->title}}</li>
        <li>Post: {{$post->text}}</li>

        @if ($post->User->id == auth()->id())
            <form method="POST" action="{{route('posts.destroy', ['id'=>$post])}}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif

        @if ($post->User->id == auth()->id())
            <li><a href={{route('posts.edit', ['id'=>$post])}}>Edit Post</a></li>
        @endif


        <p> </p>
        <p>Comments: </p>
        <ul>
        
        @foreach ($comments as $comment)
            <li> <a href={{route('users.show', ['id'=>$comment->user_id])}}> {{$comment->User->username}}: </a>
                <div class="comment-container">

                <div class="comment-text">{{$comment->comment_text}}</div> 
                    @if($comment->user_id == auth()->user()->id)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="float: right">Delete</button>
                    </form>
                    @endif
                </div>
            </li>
        @endforeach
        

        </ul>
        <div class="comment-container">
        <form method="POST" action="{{route('comments.store', ['id'=>$post])}}">
            @csrf
            <p>Your Comment: <input type="text" name="comment">
            <input type="submit" value="Post" style="float: right">
            </p>
        </form>
        </div>

    </ul>

@endsection
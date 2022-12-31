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
        <li>
            @if($post->file_path)
            <img src="{{ $post->file_path }}" alt="Photo">
            @endif
        </li>

        @auth
            @if ($post->User->id == auth()->id() || auth()->user()->privileges>1)
                <form method="POST" action="{{route('posts.destroy', ['id'=>$post])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            @endif
        @endauth
        

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
                @auth
                    @if($comment->user_id == auth()->user()->id || auth()->user()->privileges>1 || $post->user_id == auth()->user()->id)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="float: right">Delete</button>
                    </form>
                    @endif
                @endauth
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
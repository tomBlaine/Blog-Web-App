@extends('layouts.basic')

@section('title', 'Posts')

@section('content')
    <style>
    .comment-container {
        display: flex;
    }

    </style>

    <ul>
        <li>@ {{$post->User->username}}</li>
        <li>Title: {{$post->title}}</li>
        <li>Post: {{$post->text}}</li>
        <p>
            @if($post->file_path)
            <img src="{{ $post->file_path }}" alt="Photo">
            @endif
        </p>
        <li>Tags: 
            @foreach ($tags as $tag)
                {{$tag->name}}, 
            @endforeach
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
        
        @auth
            @if ($post->User->id == auth()->id() || auth()->user()->privileges>1)
                <li><a href={{route('posts.edit', ['id'=>$post])}}>Edit Post</a></li>
            @endif
        @endauth
        

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

                    @if($comment->user_id == auth()->user()->id || auth()->user()->privileges>1)
                    <a href={{route('comments.edit', ['id'=>$comment])}}>Edit Comment</a>
                    @endif
                @endauth
                </div>
            </li>
        @endforeach
        <div>
            @yield('editComment')
        </div>

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

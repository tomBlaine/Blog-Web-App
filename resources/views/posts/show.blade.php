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
                <a href={{route('tags.show', ['id' =>$tag->id])}}>{{$tag->name}}, </a>
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

        <br>
        @livewire('index-comment', ['postId' => $post->id])
        <div>
            @yield('editComment')
        </div>

        <div class="comment-container">
        <form method="POST" action="{{route('comments.store', ['id'=>$post])}}">
            @csrf
            <p>Your Comment: <input type="text" name="comment">
            <input type="submit" value="Post" style="float: right">
            </p>
        </form>
        </div>

        @auth
        @livewire('post-comment', ['postId' => $post->id])
        @endauth
    </ul>

@endsection

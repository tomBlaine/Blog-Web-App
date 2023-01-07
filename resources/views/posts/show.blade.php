@extends('layouts.basic')

@section('title', 'Posts')

@section('content')
    <style>
    .comment-container {
        display: flex;
    }
    .container {
          max-width: 75%;
    }


    </style>
<div class="container">
    <ul>
        <p><a href={{route('users.show', ['id'=>$post->user_id])}}>@ {{$post->User->username}}</a></p>
        <p style="font-weight: bold">{{$post->title}}</p>
        <p>{{$post->text}}</p>
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



        <br>
        @livewire('index-comment', ['postId' => $post->id])
        <div>
            @yield('editComment')
        </div>
        <br>
        @auth
        @livewire('post-comment', ['postId' => $post->id])
        @endauth
        <br>
        <br>
        @auth
        @if ($post->User->id == auth()->id() || auth()->user()->privileges>1)
            <form method="POST" action="{{route('posts.destroy', ['id'=>$post])}}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Post</button>
            </form>
        @endif
        @endauth
        
        @auth
        @if ($post->User->id == auth()->id() || auth()->user()->privileges>1)
            <p><a href={{route('posts.edit', ['id'=>$post])}}>Edit Post</a></p>
        @endif
        @endauth
    </ul>

</div>
@endsection

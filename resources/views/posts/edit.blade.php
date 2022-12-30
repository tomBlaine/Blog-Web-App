@extends('layouts.basic')

@section('title', 'Create Post')

@section('content')
    <p>Edit Post:</p>
    <form method="POST" action="{{route('posts.update', ['id'=>$post])}}">
        @csrf
        @method('PUT')
        <p>Title: <input type="text" name="title" value="{{$post->title}}"></p>
        <p>Body: <input type="text" name="body" value="{{$post->text}}"></p>
        <input type="submit" value="Post">
        <a href="{{route('posts.index')}}">Cancel</a>
    </form>


@endsection
@extends('layouts.basic')

@section('title', 'Create Post')

@section('content')
    <p>Create Post:</p>
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <p>Title: <input type="text" name="title"></p>
        <p>Body: <input type="text" name="body"></p>
        <p>Attached image URL: <input type="text" name="img"></p>
        <p>Tags (Seperated by a space key): <input type="text" name="tags"></p>
        <input type="submit" value="Post">
        <a href="{{route('posts.index')}}">Cancel</a>
    </form>


@endsection
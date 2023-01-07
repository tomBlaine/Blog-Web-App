@extends('layouts.basic')

@section('title', 'Create Post')

@section('content')
    <p>Create Post:</p>
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <p>Title: </p>
        <textarea type="text" name="title" rows=2 style="width: 80%"></textarea>
        <p>Body: </p>
        <textarea type="text" name="body" rows=15 style="width: 80%"></textarea>
        <p>Attached image URL: </p>
        <textarea type="text" name="img" rows=1 style="width: 80%"></textarea>
        <p>Tags (Seperated by a space key): </p>
        <textarea type="text" name="tags" rows=1 style="width: 80%"></textarea>
        <br>
        <br>
        <input type="submit" value="Post">
        <a href="{{route('posts.index')}}">Cancel</a>
    </form>


@endsection
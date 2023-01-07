@extends('layouts.basic')

@section('title', 'Create Post')

@section('content')
    <p>Edit Post:</p>
    <form method="POST" action="{{route('posts.update', ['id'=>$post])}}">
        @csrf
        @method('PUT')
        <p>Title: </p>
        <textarea type="text" name="title" rows=2 style="width: 80%">{{$post->title}}</textarea>

        <p>Body: </p>
        <textarea type="text" name="body" rows=15 style="width: 80%">{{$post->text}}</textarea>

        <p>Attached image URL: </p>
        <textarea type="text" name="img" rows=1 style="width: 80%">{{$post->file_path}}</textarea>

        <p>Tags: </p>
        <textarea type="text" name="tags" rows=1 style="width: 80%">{{$tagString}}</textarea>
        <br>
        <br>
        <input type="submit" value="Post">
        <a href="{{route('posts.index')}}">Cancel</a>
    </form>


@endsection
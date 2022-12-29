@extends('layouts.basic')

@section('title', 'User:')

@section('content')
    <p>{{$user->username}}</p>
    <ul>
        @foreach ($posts as $post)
            <li><a href={{route('posts.show', ['id'=>$post->id])}}> {{$post->title}}</a></li>
            <li>{{$post->text}}</li>
            <li>  </li>
        @endforeach
    </ul>

@endsection
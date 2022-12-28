@extends('layouts.basic')

@section('title', 'User:')

@section('content')
    <p>{{$user->username}}</p>
    <ul>
        @foreach ($posts as $post)
            <li>{{$post->title}}</li>
            <li>{{$post->text}}</li>
        @endforeach
    </ul>

@endsection
@extends('posts.show')

@section('editComment')

<form method="POST" action="{{route('comments.update', ['id'=>$comment])}}">
    @csrf
    @method('PUT')
    <p>Comment: <input type="text" name="text" value="{{$comment->comment_text}}"></p>
    <input type="submit" value="Save">
    <a href="{{route('posts.index')}}">Cancel</a>
</form>

@endsection
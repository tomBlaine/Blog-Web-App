@extends('posts.show')

@section('editComment')

<form method="POST" action="{{route('comments.update', ['id'=>$comment])}}">
    @csrf
    @method('PUT')
    <p>Comment: </p>
    <textarea type="text" name="text" rows=3 style="width: 30%">{{$comment->comment_text}}</textarea>
    <input type="submit" value="Save">
    <a href="{{route('posts.index')}}">Cancel</a>
</form>

@endsection
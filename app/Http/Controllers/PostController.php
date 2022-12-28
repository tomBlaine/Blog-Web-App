<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->get();
        return view('posts.show', ['post' => $post, 'comments'=>$comments]);
    }

    public function index()
    {
        $posts = Post::get();
        return view('posts.index', ['posts' => $posts]);
    }

}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->get();
        return view('posts.show', ['post' => $post, 'comments'=>$comments]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:3000'],
        ]);

        $a = new Post;
        $a->title = $validatedData['title'];
        $a->text = $validatedData['body'];
        $a->user_id = auth()->id();
        $a->save();

        session()->flash('message', 'Post was created.');
        return redirect()->route('posts.index');
    }

    public function index()
    {
        $posts = Post::get();
        return view('posts.index', ['posts' => $posts]);
    }

}


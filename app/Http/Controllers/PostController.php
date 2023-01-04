<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->get();
        $tag_entries = DB::table('post_tag')->select('*')->where('post_id', $id)->get();

        $tags = [];
        foreach($tag_entries as $item){
            $tag = Tag::where('id', $item->tag_id)->first();
            array_push($tags, $tag);
        }
        return view('posts.show', ['post' => $post, 'comments'=>$comments, 'tags'=>$tags]);
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
            'img' =>['max:2000']
        ]);

        $a = new Post;
        $a->title = $validatedData['title'];
        $a->text = $validatedData['body'];
        $a->file_path=$validatedData['img'];
        $a->user_id = auth()->id();
        $a->save();

        session()->flash('message', 'Post was created.');
        return redirect()->route('posts.index');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post was deleted.');
    }


    public function edit($id)
    {
        $post= Post::findOrFail($id);
        return view('posts.edit', ['post'=>$post]);
        
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:3000'],
            'img' =>['max:2000'],
        ]);

        $post= Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->text = $validatedData['body'];
        $post->file_path=$validatedData['img'];
        $post->save();

        session()->flash('message', 'Post was changed.');
        return redirect()->route('posts.index');


    }


}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $a = new Comment;
        $a->comment_text = $validatedData['comment'];
        $a->user_id = auth()->id();
        $a->post_id = $id;
        $a->save();

        session()->flash('message', 'Comment was posted.');
        return redirect()->route('posts.show', ['id'=>$id]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('posts.show', ['id'=>$comment->post_id])->with('message', 'Comment was deleted.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);
        $comments=Comment::where('post_id', $comment->post_id)->get();
        return view('comments.edit', ['comment'=>$comment, 'post'=>$post, 'comments'=>$comments]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'text' => ['required', 'string', 'max:3000'],
        ]);

        $comment= Comment::findOrFail($id);
        $comment->comment_text = $validatedData['text'];
        $comment->save();

        session()->flash('message', 'Comment was changed.');
        return redirect()->route('posts.show', ['id'=>$comment->post_id]);


    }
}

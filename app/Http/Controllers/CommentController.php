<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\CommentNotification;

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

        $post = Post::findOrFail($id);
        $post->user->notify(new CommentNotification($a));

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

        $tag_entries = DB::table('post_tag')->select('*')->where('post_id', $id)->get();

        $tags = [];
        foreach($tag_entries as $item){
            $tag = Tag::where('id', $item->tag_id)->first();
            array_push($tags, $tag);
        }

        return view('comments.edit', ['comment'=>$comment, 'post'=>$post, 'comments'=>$comments, 'tags'=>$tags]);
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

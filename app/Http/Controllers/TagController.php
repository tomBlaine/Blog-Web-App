<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        $post_entries = DB::table('post_tag')->select('*')->where('tag_id', $id)->get();

        $posts = [];
        foreach($post_entries as $item){
            $post = Post::where('id', $item->post_id)->first();
            array_push($posts, $post);
        }

        return view('tags.show', ['posts' => $posts, 'tag'=>$tag]);
    }
}

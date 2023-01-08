<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Notifications\PostEditDeleted;
use App\Http\Joke;

class PostController extends Controller
{



    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->orderBy('created_at','asc')->get();
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


    public function tagStringToID(string $tagString)
    {

        $words = explode(' ', $tagString);

        //dd($words);
        $tags = [];
        foreach ($words as $item){
            $tag = Tag::where('name', $item)->first();
            if (!$tag) {
                $tag = new Tag;
                $tag->name = $item;
                $tag->save();
            }
            array_push($tags, $tag);
        }

        $tagIDs = [];
        foreach ($tags as $tag){
            array_push($tagIDs, $tag->id);
        }

        return $tagIDs;

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:3000'],
            'img' =>['max:2000'],
            'tags' => ['max:500']
        ]);

        $a = new Post;
        $a->title = $validatedData['title'];
        $a->text = $validatedData['body'];
        $a->file_path=$validatedData['img'];
        $a->user_id = auth()->id();
        

        $tagIDs = PostController::tagStringToID($validatedData['tags']);
        

        $a->save();
        
        $a->tags()->sync($tagIDs);


        session()->flash('message', 'Post was created.');
        return redirect()->route('posts.index');
    }

    public function index(Joke $joke)
    {
        
        $jokeText = $joke->getRandomJoke();
        //dd($jokeText);
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(7);
        return view('posts.index', ['posts' => $posts, 'joke'=>$jokeText]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        if(auth()->user()->id!=$post->user->id){
            $post->user->notify(new PostEditDeleted($post));
        }
        return redirect()->route('posts.index')->with('message', 'Post was deleted.');
    }


    public function edit($id)
    {
        $post= Post::findOrFail($id);
        $tags= DB::table('post_tag')->select('*')->where('post_id', $post->id)->get();
        
        $tagString = "";
        foreach($tags as $tag){
            $tag = Tag::where('id', $tag->tag_id)->first();
            $tagString .= $tag->name ." ";
        }

        return view('posts.edit', ['post'=>$post, 'tagString'=>$tagString]);
        
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:3000'],
            'img' =>['max:2000'],
            'tags' => ['max:500'],
        ]);

        $post= Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->text = $validatedData['body'];
        $post->file_path=$validatedData['img'];
        $post->save();

        $tagIDs = PostController::tagStringToID($validatedData['tags']);

        $post->tags()->sync($tagIDs);

        session()->flash('message', 'Post was changed.');
        return redirect()->route('posts.index');


    }



}


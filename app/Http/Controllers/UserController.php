<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->get();
        return view('users.show', ['user' => $user, 'posts' => $posts]);
    }
}

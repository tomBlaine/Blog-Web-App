<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class PostComment extends Component
{
    public $body;
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function submitComment()
    {
        $this->validate([
            'body' => 'required|max:2000',
        ]);

        $a = new Comment;
        $a->comment_text = $this->body;
        $a->user_id = auth()->id();
        $a->post_id = $this->postId;
        $a->save();


        $this->body = '';
    }

    public function render()
    {
        return view('livewire.post-comment');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentNotification;

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

        $post = Post::findOrFail($this->postId);
        $post->user->notify(new CommentNotification($a));


        $this->body = '';
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.post-comment');
        
    }
}

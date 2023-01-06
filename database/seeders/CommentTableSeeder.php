<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $p1 = new Comment;
        $p1->comment_text = "This looks amazing!";
        $p1->user_id=2;
        $p1->post_id=1;
        $p1->save();

        $p2 = new Comment;
        $p2->comment_text = "Wish i was there man!";
        $p2->user_id=3;
        $p2->post_id=1;
        $p2->save();
        Comment::factory()->count(500)->create();
    }
}

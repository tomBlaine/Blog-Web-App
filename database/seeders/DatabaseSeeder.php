<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(TagTableSeeder::class);

        $tags = Tag::all();

        Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1,3))->pluck('id')->toArray()
            );
        });
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = new Post;
        $p1->title = "Trip to antigua";
        $p1->text = "The island was once a British colony, and there are several old forts and churches that have been preserved as historical landmarks. The most famous of these is Fort James, which sits on a hill overlooking the capital city of St. John's.";
        $p1->user_id=1;
        $p1->file_path = "https://a.cdn-hotels.com/gdcs/production142/d201/25d11791-6c04-4a74-abed-1ca0a329c317.jpg?impolicy=fcrop&w=800&h=533&q=medium";
        $p1->save();

        Post::factory()->count(200)->create();
    }
}

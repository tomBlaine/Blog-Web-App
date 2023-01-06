<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        if(User::inRandomOrder()->first()->id>25){
            $imageUrl = fake()->imageUrl($width=600, $height=400, $randomize=true);
        } else {
            $imageUrl = null;
        }

        return [
            'title'=>fake()->realText($maxNbChars = 100, $indexSize = 2),
            'text'=>fake()->realText($maxNbChars = 400, $indexSize = 2),
            'file_path' =>$imageUrl,
            'user_id'=>User::inRandomOrder()->first()->id,
        ];
    }
}

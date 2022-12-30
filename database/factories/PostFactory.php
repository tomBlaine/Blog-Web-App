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
        return [
            'title'=>fake()->sentence(),
            'text'=>fake()->text(),
            'file_path' =>fake()->image('public/storage/photos', 640, 480, 'cats', false),
            'user_id'=>User::inRandomOrder()->first()->id,
        ];
    }
}

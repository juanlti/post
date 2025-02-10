<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        $name = $this->faker->unique()->word(20);
        $slug = Str::slug($name);
        $categoryId = Category::all()->random()->id;
        $userID = User::all()->random()->id;
        return [
            'name' => $name,
            'slug' => $slug,
            'extract' => $this->faker->text(200),
            'body' => $this->faker->text(500),
            'status' => $this->faker->randomElement([Post::BORRADOR, Post::PUBLICADO]),
            'category_id' => $categoryId,
            'user_id' => $userID
        ];
    }
}

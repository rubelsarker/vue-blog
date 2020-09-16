<?php

namespace Database\Factories\Model;


use App\Models\Model\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'postImage' => $this->faker->imageUrl,
            'views' => 0,
            'body' => $this->faker->paragraph,
        ];
    }
}

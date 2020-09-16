<?php

namespace Database\Factories\Model;

use App\Models\Model\Post;
use App\Models\Model\PostTag;
use App\Models\Model\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'tag_id' => Tag::all()->random()->id,
            'post_id' => Post::all()->random()->id
        ];
    }
}

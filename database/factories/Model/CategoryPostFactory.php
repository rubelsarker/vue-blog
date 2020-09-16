<?php

namespace Database\Factories\Model;

use App\Models\Model\Category;
use App\Models\Model\CategoryPost;
use App\Models\Model\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       return[
           'category_id' => Category::all()->random()->id,
           'post_id' => Post::all()->random()->id
       ];

    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>$this->faker->numberBetween($min = 1, $max = 7),
            'title'=>$this->faker->title,
            'image'=>$this->faker->imageUrl($width = 640, $height = 480) ,
            'content'=>$this->faker->text,
            'slug'=>Str::slug($this->faker->title),
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}

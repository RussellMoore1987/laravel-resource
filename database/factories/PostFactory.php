<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $slug = "{$this->faker->word}-{$this->faker->word}-{$this->faker->word}" ;

        return [
            'slug' => $slug,
            'body' => $this->faker->paragraph(rand(1,10)),
        ];
    }
}

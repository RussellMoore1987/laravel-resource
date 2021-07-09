<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $description = $this->faker->sentences(rand(1,5), true);
        if (preg_match('/^.{1,252}\b/s', $description, $match))
        {
            $description = $match[0] . ( strlen($match[0]) < strlen($description) ? "..." : "" );
        }

        $title = $this->faker->words(rand(1,6), true);

        $completed_at = rand(1,100) > 50 ? $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null) : null;

        return [
            'title' => $title,
            'description' => $description,
            'completed_at' => $completed_at
        ];
    }
}

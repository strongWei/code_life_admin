<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PullRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->address,
            'status' => mt_rand(0, 1),
            'priority' => mt_rand(0, 3),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FriendshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_user' => 1,
            'second_user'=> $this->faker->numberBetween($min = 1, $max = 20),
            'acted_user'=> 1,
            'status' => 'pending'
        ];
    }
}

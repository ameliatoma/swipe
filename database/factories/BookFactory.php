<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'genre' => $this->faker->lastName(),
            'cover' => ''
        ];
    }
}

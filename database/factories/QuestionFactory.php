<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question'=>$this->faker->sentence(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function($question){
            // TODO:: Create Fake Answers For Question
        });
    }
}

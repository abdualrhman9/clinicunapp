<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::factory(),
            'question_id'=>Question::factory(),
            'answer'=>$this->faker->sentence(),
            'answered_at'=>$this->faker->dateTime(),
        ];
    }
}

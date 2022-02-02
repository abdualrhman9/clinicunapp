<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $question;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->question = Question::factory()->create();
        $this->token = $this->user->createToken('token_name')->plainTextToken;
    }

    /** @test */
    public function answers_can_be_stored(){
        $this->withoutDeprecationHandling();
        $response = $this->post('/api/questions/answers',$this->getData(),[
            'Accept'=>'application/json',
            'Authorization'=>'Bearer '.$this->token
        ]);
        $response->assertJson([
            'message'=>'success',
        ]);
        $this->assertCount(1,Answer::all());
    }

    private function getData(){
        return [
            'question_id' => $this->question->id,
            'user_id' => $this->user->id,
            'answer' => 'my answer here .',
        ];
    }
}

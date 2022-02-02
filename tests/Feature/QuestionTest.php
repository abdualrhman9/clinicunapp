<?php

namespace Tests\Feature;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionTest extends TestCase
{

    protected $patient;
    protected $token;
    protected $roles;
    protected $questions;
    
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // User factory create user of with patient role
        $this->patient = User::factory()->create();
        $reolsSeed = new RolesSeeder();
        $reolsSeed->run();

        $this->token = $this->patient->createToken('test_device')->plainTextToken;
        
        $this->questions = Question::factory()->count(5)->create();
    }

    /** @test */
    public function questions_can_be_fetched(){
        $this->withoutDeprecationHandling();
        $response = $this->get('/api/questions',[
            'Accept'=>'application/json',
            'Authorization'=>'Bearer '.$this->token
        ]);


        $response->assertJson([
            [
                'id'=>Question::first()->id,
                'question'=>Question::first()->question,
            ],
            [
                'id'=>Question::find(2)->id,
                'question'=>Question::find(2)->question,
            ],
            [
                'id'=>Question::find(3)->id,
                'question'=>Question::find(3)->question,
            ],
            [
                'id'=>Question::find(4)->id,
                'question'=>Question::find(4)->question,
            ],
            [
                'id'=>Question::find(5)->id,
                'question'=>Question::find(5)->question,
            ],
        ]);

    } 

    /** @test */
    public function filter_questions(){
        $this->withoutExceptionHandling();        
        $response = $this->post('/api/questions/answers',$this->answersData(),[
            'Accept'=>'application/json',
            'Authorization'=>'Bearer '.$this->token
        ]);

        $response->assertJson([
            'message'=>'success',
        ]);
        
        $response = $this->get('/api/questions',[
            'Accept'=>'application/json',
            'Authorization'=>'Bearer '.$this->token
        ]);


        $response->assertJson([
            // [
            //     'id'=>Question::first()->id,
            //     'question'=>Question::first()->question,
            // ],
            [
                'id'=>Question::find(2)->id,
                'question'=>Question::find(2)->question,
            ],
            [
                'id'=>Question::find(3)->id,
                'question'=>Question::find(3)->question,
            ],
            [
                'id'=>Question::find(4)->id,
                'question'=>Question::find(4)->question,
            ],
            [
                'id'=>Question::find(5)->id,
                'question'=>Question::find(5)->question,
            ],
        ]);
    }

    private function answersData(){
        return [
            'question_id' => $this->questions->first()->id,
            'user_id' => $this->patient->id,
            'answer' => 'my answer here .',
        ];
    }
}

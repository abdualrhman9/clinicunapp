<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    protected $patient;
    protected $doctor;
    protected $token;
    protected function setUp(): void
    {
        parent::setUp();
        $dbSeed = new DatabaseSeeder();
        $dbSeed->run();
        $this->patient = User::factory()->create();
        $this->doctor = User::factory()->create();
        $this->token = $this->patient->createToken('token_name')->plainTextToken;
        $this->doctor->roles()->detach(2);
        $this->doctor->roles()->attach(3);
        $re = $this->post('/api/patients/doctors',
        [
            'doctor_id'=>$this->doctor->id
        ],
        [
            'accept'=>'application/json',
            'authorization'=>'Bearer '.$this->token
        ]
    );
    
    }

    /** @test */
    public function patient_can_store_message(){
        $response = $this->post('/api/patients/messages',$this->getData(),[
             'accept'=>'application/json',
             'authorization'=>'Bearer '.$this->token
         ]);

        $response->assertJson([
            'message'=> 'success'
        ]);
    }

    /** @test */    
    public function patient_can_fetch_messages(){
        //Send Message From Patient
        $this->post('/api/patients/messages',$this->getData(),[
            'accept'=>'application/json',
            'authorization'=>'Bearer '.$this->token
        ]);

        $response = $this->get('/api/patients/messages',[
             'accept'=>'application/json',
             'authorization'=>'Bearer '.$this->token
         ]);
        // dd($response->getContent());
        $message = Message::first();
        $response->assertJson([
            'data'=> [
                [
                    'id'=>$message->id,
                    'message'=>$message->message,
                    'doctor_id'=>$message->doctor_id,
                    'patient_id'=>$message->patient_id,
                    'message_type'=>$message->message_type
                ]
            ]
        ]);
    }



    private function getData(){
        return [
            'message'=>'Test Message Here',
            'patient_id'=>$this->patient->id,
            'doctor_id'=>$this->doctor->id,
        ];
    }
}

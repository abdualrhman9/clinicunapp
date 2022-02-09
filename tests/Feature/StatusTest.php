<?php

namespace Tests\Feature;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusTest extends TestCase
{

    use RefreshDatabase;

    protected $patient;
    protected $token;
    protected function setUp(): void
    {
        parent::setUp();
        $this->patient = User::factory()->create();
        $this->token = $this->patient->createToken('TestName')->plainTextToken;
    }

    /** @test */
    public function patient_can_store_status(){
        $response = $this->post(
            '/api/patients/status',
            $this->getData(),
            [
                'accept'=>'application/json',
                'authorization' => 'Bearer '.$this->token  
            ]
        );
        $status = Status::first();
        $this->assertCount(1,Status::all());
        $this->assertTrue($this->patient->status->status == 'Don\'t be bussy be productive !');
        $response->assertJson([
            'status'=>$status->status,
            'user'=>$status->patient->name,
        ]);
    }

    /** 
     * @test
     * test if current user can fetch its status
     * first we create status for current user
     * we fetch the user status 
     *  
     * */
    public function patient_can_fetch_status(){
        
        $response = $this->post(
            '/api/patients/status',
            $this->getData(),
            [
                'accept'=>'application/json',
                'authorization' => 'Bearer '.$this->token  
            ]
        );

        $response = $this->get(
            '/api/patients/status',
            [
                'accept'=>'application/json',
                'authorization' => 'Bearer '.$this->token  
            ]
        );
        
        $response->assertJson([
            'status'=>$this->patient->status->status,
        ]);
    }

    private function getData() {
        return [
            'status' => 'Don\'t be bussy be productive !'
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorsTest extends TestCase
{
    protected $patient;
    protected $doctor;
    protected $pToken;
    protected $dToken;
    protected $roles;
    
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // User factory create user of with patient role
        
        $reolsSeed = new RolesSeeder();
        $reolsSeed->run();
        $this->patient = User::factory()->create();
        $this->doctor = User::factory()->create();
        $this->doctor->roles()->detach(2);
        $this->doctor->roles()->attach(3);

        $this->pToken = $this->patient->createToken('test_device')->plainTextToken;
        $this->dToken = $this->doctor->createToken('test_device')->plainTextToken;
        
    }

    /** @test */
    public function insure_users_has_right_role(){
        $this->assertTrue($this->doctor->hasRole('doctor'));
        $this->assertTrue($this->patient->hasRole('patient'));
    }

    /** @test */
    public function doctor_can_fetch_his_patients() {

        //Attach patient to our doctor
        $this->patient->doctors()->attach($this->doctor->id);

        $this->doctor = $this->doctor->fresh();
        $response = $this->get(
            'api/doctors/patients/index',
            [
                'accept'=>'application/json',
                'authorization' => 'Bearer '.$this->dToken,
            ]
        );
        
        dd($response->getContent());
        
    }

}

<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register(){
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register',$this->getData());
        $user = User::first();
        assertCount(1,User::all());
        assertCount(1,$user->tokens);
    }

    /** @test */
    public function user_can_login(){
        $this->withoutExceptionHandling();

        $this->post('/api/register',$this->getData());

        $filtredData = collect($this->getData())
                    ->only('email','password','device_name')
                    ->toArray();

        $response = $this->post('/api/login',$filtredData);
        
        $user = User::first();
        assertCount(2,$user->tokens);

    }

    /** @test */
    public function user_has_role(){
        $user = User::factory()->create();
        $role = Role::create(['role'=>'admin']);
        $user->roles()->attach($role->id);
        assertCount(1,$user->all());
    }

    /** @test */
    public function user_created_with_token(){
        $user = User::factory()->create();
        assertCount(1,$user->tokens);
    }

    /** @test */
    // public function user_can_logout(){
        
    //     $response = $this->post('api/register',$this->getData());

    //     $token = json_decode($response->getContent())->token;

    //     $this->post('api/logout',$this->getData(),[
    //         'Accept'=>'application/json',
    //         'Authorization'=>'Beared '.$token
    //     ]);
    // }

    private function getData(){
        return [
            'name' => 'Jack Nelson' ,
            'email' => 'mr.jackallways@gmail.com',
            'password' => 'password', // password
            'password_confirmation'=>'password',
            'device_name'=>'Iphone12'
        ];
    }
}

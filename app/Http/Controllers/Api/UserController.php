<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function register(Request $request){
        
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|string|email|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed',
            // 'device_name'=>'required|string|min:5'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $this->attachRoleToUser($user);

        $token = $user->createToken('token_name')->plainTextToken;

        return response()->json([
            // 'message'=>'success',
            'token'=>$token,
            'user'=>new UserResource($user),
        ]);
        
    }

    private function attachRoleToUser(User $user){

        $doctors = Email::doctors()->get()->pluck('email')->toArray();
        $admins  = Email::admins()->get()->pluck('email')->toArray();

        $isDoctor = in_array($user->email,$doctors);
        $isAdmin  = in_array($user->email,$admins);

        if($isDoctor){
            $user->roles()->attach(3);
            Email::where('email',$user->email)->get()->first()->delete();
        }

        if($isAdmin) {
            $user->roles()->attach(1);
            Email::where('email',$user->email)->get()->first()->delete();
        }

        if(!$isAdmin and !$isDoctor)
            $user->roles()->attach(2);
        
    }

    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|string|min:8',
            // 'device_name'=>'required|string'
        ]);

        $pass = Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]);

        $user = User::where('email',$data['email'])->get()->first();

        

        if($pass){
            $token = $user->createToken('token_name')->plainTextToken;
            return response()->json([
                // 'message'=>'success',
                'token'=>$token,
                'user'=>new UserResource($user),
            ]);
        }else {
            return response()->json([
                'message' => "This Credintals Dosnot Match Our Records"
            ]);
        }
    }


    public function logout(Request $request){
        $data = $request->validate([
            'device_name'=>'required|string|min:5',
            'token'=>'required,'
        ]);

        Auth::user()->tokens()->delete();

        return response()->json([
            'message'=>'success',
        ]);
    }
}

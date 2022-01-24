<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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
            'device_name'=>'required|string|min:5'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $token = $user->createToken($data['device_name'])->plainTextToken;

        return response()->json([
            'token'=>$token,
            'user'=>new UserResource($user),
        ]);
        
    }

    public function login(Request $request){
        $data = $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|string|min:8',
            'device_name'=>'required|string|min:8'
        ]);

        $pass = Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]);

        $user = User::where('email',$data['email'])->get()->first();

        $token = $user->createToken($data['device_name']);

        if($pass){
            return response()->json([
                'status'=>'success',
                'user'=>new UserResource($user),
                'token'=>$token
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

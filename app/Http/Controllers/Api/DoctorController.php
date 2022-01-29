<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){
        
        $doctors = User::whereHas('roles',function($q){
            $q->where('role_id', 3);
        })->get();
        
        return response()->json(UserResource::collection($doctors));
    }
}

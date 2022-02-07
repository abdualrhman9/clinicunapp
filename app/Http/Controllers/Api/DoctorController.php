<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Policies\AttachmentPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function test(){
        $users = User::all();
        return UserResource::collection($users);
    }

    public function index(){
        
        $doctors = User::whereHas('roles',function($q){
            $q->where('role_id', 3);
        })->get();
        
        return response()->json(UserResource::collection($doctors));
    }

    // public function patients() {
    //     $patients = User::whereHas
    // }

    public function attachment(Request $request){
        
        $data = $request->validate([
            'doctor_id'=>'required|exists:App\Models\User,id',
        ]);

        $doctor = User::find($data['doctor_id']);

        $user = Auth::user();

        $this->authorize('canAttach',$doctor);

        $user->doctors()->detach();

        $user->doctors()->attach($doctor->id);

        
        return response()->json([
            'user'=>new UserResource($user),
            // 'doctor'=> new UserResource($doctor),
        ]);

    }

}

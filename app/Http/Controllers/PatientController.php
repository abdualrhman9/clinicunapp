<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnswerResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index(){
        $patients = Auth::user()->patients;
        
        return response()->json([
            'patients'=>UserResource::collection($patients)
        ]);
    }

    public function profileData(){
        $user = auth()->user();
        return response()->json([
            'patients'=>$user->patients->count(),
            'messages'=>Message::where('doctor_id',$user->id)->get()->count(),
        ]);
    }

    public function show(User $patient) {
        return response()->json([
            'id'=>$patient->id,
            'name'=>$patient->name,
            'email'=>$patient->email,
            'status'=>$patient->status ?? 'No Status',
        ]);
    }

    public function getMessages(User $patient){
        if($patient->doctors->count() == 0 or $patient->doctors->first()->id != auth()->user()->id)
            return response()->json(['message'=>'something wrong']);
        
        $messages = Message::where('patient_id',$patient->id)
            ->where('doctor_id',auth()->user()->id)
            ->get();
        return MessageResource::collection($messages);
    }

    public function sendMessage(Request $request){
        
        $data = $request->validate([
            'message' => 'required|string|min:5|max:255',
            'patient_id' => 'required|exists:App\Models\User,id'
        ]);
        $data['message_type'] = 'reciver';
        $data['doctor_id'] = auth()->user()->id;

        $patient = User::find($data['patient_id']);

        if($patient->doctors->count() == 0 or $patient->doctors->first()->id != auth()->user()->id)
            return response()->json(['message'=>'something wrong']);

        $message = Message::create($data);

        return response()->json([
            'message'=> 'success',
        ]);

    }

    public function getAnswers(User $patient){
        $answers = $patient->answers;
        return AnswerResource::collection($answers);
    }
}

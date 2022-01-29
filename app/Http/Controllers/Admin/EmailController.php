<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(Request $request){
        $emails = Email::all();
        
        return view('dashboard.emails.index',compact('emails'));
    }

    public function create(){
        return view('dashboard.emails.create');
    }

    public function store(Request $request){
        $data = $request->validate($this->getData());
        
        Email::create($data);

        return redirect()->back()->with('message','Success Saving Email');
    }

    public function destroy(Email $email){
        $email->delete();
        return redirect()->back()->with('message','success deleting email');
    }

    private function getData(){
        return [
            'email'=>'required|email|unique:users',
            'role'=>'numeric|min:1|max:3',
        ];
    }

}

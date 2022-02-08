<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'text'=>'required|string',
        ]);

        $status = Auth::user()->status()->updateOrCreate($data);

        return response()->json([
            'status'=>$status->text,
            'user'=>Auth::user()->name,
        ]);
    }
}

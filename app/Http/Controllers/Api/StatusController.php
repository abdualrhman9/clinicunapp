<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{

    public function getStatus() {
        $status = Auth::user()->status->status;
        return response()->json([
            'status'=>$status,
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'status'=>'required|string',
        ]);

        $status = Auth::user()->status()->updateOrCreate($data);

        return response()->json([
            'status'=>$status->status,
            'user'=>Auth::user()->name,
        ]);
    }
}

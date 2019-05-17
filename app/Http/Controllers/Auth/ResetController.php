<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\TemporaryUser;
use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function create(){
        return view('auth.reset');
    }

    public function store(Request $request){
        $user = User::where('email', $request->email)->first();
        $reset = new TemporaryUser();
        $reset->user_id = $user->id;
        $reset->email = $user->email;
        $reset->token = $request->session()->token();
        $reset->created_at = now();
        $reset->save();

        Mail::to('tsubasa.kudo@andco.group')->send(new PasswordReset($request->session()->token()));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Mail\PasswordReset;
use App\Models\User;
use App\Models\TemporaryUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetController extends Controller
{
    public function create()
    {
        return view('auth.reset');
    }

    public function store(PasswordResetRequest $request)
    {
        $token = Str::random(32);
        $user = User::where('email', $request->email)->first();
        $temp = $user->temporaryUser();
        $temp->create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);
        Mail::to($user->email)->send(new PasswordReset($token));
        return view('index');
    }

    public function reset(Request $request)
    {
        $temp = TemporaryUser::where('token', $request->reset)->first();
        $time = (new Carbon($temp->created_at))->addHours(24);
        if(now() > $time){
            return view('auth.update', [
                'expiry' => true,
            ]);
        }
        return view('auth.update', [
            'expiry' => false,
        ]);
    }

    public function update(PasswordUpdateRequest $request)
    {
        $temp = TemporaryUser::where('token', $request->reset)->first();
        $user = $temp->user;
        $user->passwordUpdate($request);
        $temp->delete();
        return redirect('/login');
    }
}

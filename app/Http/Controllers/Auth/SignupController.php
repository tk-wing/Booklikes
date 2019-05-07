<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\SignupRequest;

class SignupController extends Controller
{
    public function create()
    {
        return view('auth.signup');
    }

    public function store(SignupRequest $request)
    {
        $user = new User();
        $user->store($request);

        $profile = Profile::firstOrNew(['id' => $user->id]);
        $profile->id = $user->id;
        $profile->save();

        Auth::login($user);

        if (auth()->user()) {
            return redirect('/home');
        } else {
            return redirect('/login');
        }

    }
}

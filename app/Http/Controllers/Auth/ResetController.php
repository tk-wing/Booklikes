<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetController extends Controller
{
    public function create(){
        return view('auth.reset');
    }
}

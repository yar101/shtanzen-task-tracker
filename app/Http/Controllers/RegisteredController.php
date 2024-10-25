<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class RegisteredController
{
    public function create()
    {
        return view('auth.register');
    }
}

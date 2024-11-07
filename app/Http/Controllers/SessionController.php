<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $attempt = Auth::attempt($attributes);

        if (!$attempt) {
            return redirect()->route('login')->withErrors(
                ['login' => 'Неверный логин или пароль']
            );
        }

        return redirect()->route('tasks');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

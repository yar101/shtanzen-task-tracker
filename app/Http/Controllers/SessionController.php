<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        if (!(User::where('name', '=', $attributes['name'])->first())) {
            return redirect()->route('login')->withErrors(
                ['login' => 'Нет пользователя с таким именем']
            );
        }

        if (!$attempt) {
            return redirect()->route('login')->withErrors(
                ['login' => 'Неверный логин или пароль']
            );
        }

        if (Auth::user()->role->name == 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('tasks');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

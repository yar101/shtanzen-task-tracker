<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function tasks()
    {
        return view('admin.tasks');
    }

    public function contractors()
    {
        return view('admin.contractors');
    }

    public function createTestUser()
    {
        if (User::factory(1)->create()) {
            session()->flash('createUserSuccess', 'Пользователь успешно создан');
        } else {
            session()->flash('createUserError', 'Пользователь не создан');
        }
        return redirect()->route('admin.index');
    }
}

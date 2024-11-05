<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Admin\Users\Forms\UserForm;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public UserForm $form;
    public function render()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('livewire.admin.users.create-user', compact('roles', 'departments'));
    }

    public function store(): void
    {
        $this->form->store();
    }
}

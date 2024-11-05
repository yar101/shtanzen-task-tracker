<?php

namespace App\Livewire\Admin\Users\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate(['required'])]
    public $name = '';

    #[Validate(['required', 'email', 'max:254'])]
    public $email = '';

    #[Validate(['nullable', 'date'])]
    public $email_verified_at = '';

    #[Validate(['required', 'confirmed'])]
    public $password = '';

    #[Validate(['required'])]
    public $password_confirmation = '';

    #[Validate(['integer'])]
    public $role_id = '';

    #[Validate(['integer'])]
    public $department_id = '';

    public function store()
    {
        $this->validate();

        if (User::create($this->all())) {
            session()->flash('createUserSuccess', 'Пользователь успешно создан');
        } else {
            session()->flash('createUserError', 'Пользователь не создан');
        }
        return redirect()->route('admin.index');
    }
}

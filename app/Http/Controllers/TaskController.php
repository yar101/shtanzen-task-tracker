<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController
{
    public function index()
    {
        if (auth()->user()->role->name == 'head-of-department') {
            $contractors = Contractor::all();
            $users = User::all()->where('department_id', '=', auth()->user()->department->id);
            $tasks = Task::all()->where('department_id', '=', auth()->user()->department->id);
            return view('tasks.index', compact('tasks', 'contractors', 'users'));
        } else if (auth()->user()->role->name == 'admin') {
            $users = User::all();
            $contractors = Contractor::all();
            $tasks = Task::all();
            return view('tasks.index', compact('tasks', 'contractors'));
        } else if (auth()->user()->role->name == 'user') {
            $contractors = Contractor::all();
            $tasks = Task::all()->where('manager_id', '=', auth()->user()->id);
            return view('tasks.index', compact('tasks', 'contractors'));
        };
    }

    public function store(Request $request)
    {
        if (auth()->user()->role->name == 'user') {
            $attributes = $request->validate([
                'title' => ['required'],
                'body' => ['required'],
                'deadline_end' => ['required', 'date'],
                'cost' => ['nullable', 'integer'],
                'currency' => ['required'],
                'comment' => ['nullable'],
                'priority' => ['required'],
                'contractor_id' => ['nullable'],
            ]);
        } else if (auth()->user()->role->name == 'head-of-department') {
            $attributes = $request->validate([
                'title' => ['required'],
                'body' => ['required'],
                'deadline_end' => ['required', 'date'],
                'cost' => ['nullable', 'integer'],
                'currency' => ['required'],
                'comment' => ['nullable'],
                'priority' => ['required'],
                'contractor_id' => ['nullable'],
                'manager_id' => ['required'],
//                'department_id' => ['required'],
            ]);
        }

        $task = Task::create($attributes);
        $task->created_by = auth()->user()->id;
        $task->department_id = auth()->user()->department->id;
        if (auth()->user()->role->name == 'user') {
            $task->manager_id = auth()->user()->id;
        }
        $task->save();
        return redirect()->route('tasks');
    }

    public function edit($id)
    {

        $task = Task::find($id);
        if (auth()->user()->role->name == 'head-of-department') {
            $users = User::all()->where('department_id', '=', auth()->user()->department->id);
            return view('tasks.edit', compact('task', 'users'));
        } else {
            return view('tasks.edit', compact('task'));
        }
    }
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (auth()->user()->role->name == 'head-of-department') {
            $attributes = $request->validate([
                'title' => ['required'],
                'body' => ['required'],
                'deadline_end' => ['required', 'date'],
                'cost' => ['nullable', 'integer'],
                'currency' => ['required'],
                'comment' => ['nullable'],
                'priority' => ['required'],
                'manager_id' => ['required'],
            ]);
        } else if (auth()->user()->role->name == 'user') {
            $attributes = $request->validate([
                'title' => ['required'],
                'body' => ['required'],
                'deadline_end' => ['required', 'date'],
                'cost' => ['nullable', 'integer'],
                'currency' => ['required'],
                'comment' => ['nullable'],
                'priority' => ['required'],
            ]);
        }

        $task->update($attributes);
        return redirect()->route('tasks');
    }
}

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
            $tasks = Task::all()->where('created_by', User::all()->where('department_id', '=', auth()->user()->department_id));
        } else if (auth()->user()->role->name == 'admin') {
            $tasks = Task::all();
        } else if (auth()->user()->role->name == 'user') {
            $tasks = Task::all()->where('created_by', auth()->user()->id);
        };

        $contractors = Contractor::all();
        return view('tasks.index', compact('tasks', 'contractors'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'deadline_end' => ['required', 'date'],
            'cost' => ['nullable', 'integer'],
            'currency' => ['required'],
            'comment' => ['nullable'],
            'priority' => ['required'],
            'contractor_id' => ['nullable']
        ]);

        $task = Task::create($attributes);
        $task->created_by = auth()->user()->id;
        $task->save();
        return redirect()->route('tasks');
    }
}

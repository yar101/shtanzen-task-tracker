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
            $tasks = Task::all()->where('department_id', '=', auth()->user()->department->id);
            return view('tasks.index', compact('tasks', 'contractors'));
        } else if (auth()->user()->role->name == 'admin') {
            $contractors = Contractor::all();
            $tasks = Task::all();
            return view('tasks.index', compact('tasks', 'contractors'));
        } else if (auth()->user()->role->name == 'user') {
            $contractors = Contractor::all();
            $tasks = Task::all()->where('created_by', auth()->user()->id);
            return view('tasks.index', compact('tasks', 'contractors'));
        };
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
            'contractor_id' => ['nullable'],
        ]);

        $task = Task::create($attributes);
        $task->created_by = auth()->user()->id;
        $task->department_id = auth()->user()->department->id;
        $task->save();
        return redirect()->route('tasks');
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name == 'user') {
            $attributes = $request->validate([

            ]);
        };

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

        $task = Task::find($id);
    }
}

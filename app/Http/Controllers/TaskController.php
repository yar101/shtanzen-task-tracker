<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index')->with('tasks', $tasks);
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
        ]);

        $task = Task::create($attributes);
        $task->created_by = auth()->user()->id;
        $task->save();
        return redirect()->route('tasks');
    }
}

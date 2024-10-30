<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController
{
    public function index()
    {
        $tasks = Task::all()->where('created_by', auth()->user()->id);
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

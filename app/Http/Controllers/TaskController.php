<?php

namespace App\Http\Controllers;

use App\Jobs\TaskLockRefresh;
use App\Models\Comment;
use App\Models\Contractor;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController
{
    public function index(Request $request)
    {
        $statuses = Status::all();
        $contractors = Contractor::all();
        $users = User::where('department_id', auth()->user()->department->id)->get();
        $tasks = Task::where('department_id', auth()->user()->department->id);

        // Фильтрация по пользователю
        if ($request['filter-user'] && $request['filter-user'] !== 'tasks-all') {
            $tasks = $tasks->where('manager_id', $request['filter-user']);
        }

        // Фильтрация по дате
        if ($request['filter-start-date'] && $request['filter-end-date']) {
            $startDate = Carbon::parse($request['filter-start-date']);
            $endDate = Carbon::parse($request['filter-end-date']);
            $tasks = $tasks->whereDate('deadline_end', '>=', $startDate)->whereDate('deadline_end', '<=', $endDate);
        } elseif (!$request['filter-start-date'] && $request['filter-end-date']) {
            $endDate = Carbon::parse($request['filter-end-date']);
            $tasks = $tasks->whereDate('deadline_end', '<=', $endDate);
        } elseif ($request['filter-start-date'] && !$request['filter-end-date']) {
            $startDate = Carbon::parse($request['filter-start-date']);
            $tasks = $tasks->whereDate('deadline_end', '>=', $startDate);
        }

        // Получаем задачи с сортировкой
        $tasks = $tasks->orderBy('created_at')->get();

        return view('tasks.index', compact('tasks', 'contractors', 'statuses', 'users'));
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
                'priority' => ['required'],
                'contractor_id' => ['nullable'],
                'parent_id' => ['nullable'],
            ]);
        } else if (auth()->user()->role->name == 'head-of-department') {
            $attributes = $request->validate([
                'title' => ['required'],
                'body' => ['required'],
                'deadline_end' => ['required', 'date'],
                'cost' => ['nullable', 'integer'],
                'currency' => ['required'],
                'priority' => ['required'],
                'contractor_id' => ['nullable'],
                'manager_id' => ['required'],
                'parent_id' => ['nullable'],
            ]);
        }

        $task = Task::create($attributes);

//        if ($request['comment']) {
//            Comment::create([
//                'task_id' => $task->id,
//                'content' => $request['comment'],
//            ]);
//        }

        $task->created_by = auth()->user()->id;
        $task->department_id = auth()->user()->department->id;

        if ($request['parent_id'] != null) {
            $task->parent_id = $request['parent_id'];
            $task->contractor_id = Task::where('id', $request['parent_id'])->first()->contractor_id;
        }

        $task->save();
        return redirect()->route('tasks');
    }

    public function edit($id)
    {
        $task = Task::find($id);

        if ($task->locked_by == null) {

            $task->update(['locked_by' => auth()->user()->id]);
            $task->update(['locked_at' => now()]);

            TaskLockRefresh::dispatch($task->id)->delay(now()->addMinutes(5));

        } elseif ($task->locked_by != auth()->user()->id) {
            $locked_at = Carbon::parse($task->locked_at);
            $unlocked_at = Carbon::parse($locked_at)->addMinutes(5)->format('H:i:s');
            $error = 'Задача редактируется пользователем ' . User::findOrFail($task->locked_by)->name . '. Блокировка спадёт в ' . $unlocked_at . '.';
            return redirect()->route('tasks')->withErrors(['edit-locked' => $error]);
        }

        if (auth()->user()->role->name == 'head-of-department' || auth()->user()->role->name == 'admin') {
            $users = User::all()->where('department_id', '=', auth()->user()->department->id);
            $contractors = Contractor::all();
            return view('tasks.edit', compact('task', 'users', 'contractors'));
        } elseif (auth()->user()->role->name == 'user') {
            $contractors = Contractor::all();
            return view('tasks.edit', compact('task', 'contractors'));
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
                'contractor_id' => ['nullable'],
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
                'contractor_id' => ['nullable'],
            ]);
        }

        $task->update($attributes);
        $task->update(['locked_by' => null, 'locked_at' => null]);
        return redirect()->route('tasks');
    }

    public function statusUpdate(Request $request, $id)
    {
        $task = Task::find($id);

        $attributes = $request->validate([
            'status_id' => ['required'],
        ]);

        $task->update($attributes);
        return redirect()->route('tasks');
    }

    public function deadlineEndUpdate(Request $request, $id)
    {
        $task = Task::find($id);
        $attributes = $request->validate([
            'deadline_end' => ['required', 'date'],
        ]);

        $task->update($attributes);
        return redirect()->route('tasks');
    }

    public function refreshLock(Request $request, $id)
    {
        $task = Task::find($id);
        $task->update(['locked_by' => $request['locked_by'], 'locked_at' => $request['locked_at']]);
        return redirect()->route('tasks');
    }
}

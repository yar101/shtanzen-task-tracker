<div>
    <div class="flex flex-row justify-between mb-4">
        <form action="{{ route('tasks') }}" method="post">
            <label for="tasks">Менеджер:</label>
            <select class="p-1 bg-neutral-700 rounded-md min-w-[150px]" name="tasks" onchange="this.form.submit()">
                <option value="tasks-all" selected>Задачи всех сотрудников</option>
                @foreach($users->where('department_id', '=', auth()->user()->department->id) as $user)
                    <option value="tasks-{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="w-full inline-flex">
    <div class="flex flex-row gap-5 content-center mb-4">
        <form action="{{ route('tasks') }}" method="get">
            @csrf
            <select class="p-1 bg-neutral-700 rounded-md min-w-[150px]" name="filter-user" onchange="this.form.submit()">

                <option value="" disabled selected>
                    @if(request('filter-user') == null)
                        Все задачи
                    @endif
                    @if(request('filter-user') == 'tasks-all')
                        Все задачи
                    @else
                        {{ $users->where('id', '=', request('filter-user'))->pluck('name')->first() }}
                    @endif
                </option>

                @if(request('filter-user') != 'tasks-all' && request('filter-user') != null)
                    <option value="tasks-all">Все задачи</option>
                @endif

                @foreach($users->where('department_id', '=', auth()->user()->department->id) as $user)
                    @if(request('filter-user') != $user->id)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </form>
        <form action="{{ route('tasks') }}" method="get">
            @csrf
            <input type="hidden" name="filter-user" value="{{ auth()->user()->id }}">
            <button class="p-1 bg-blue-300 rounded-md text-gray-800 hover:bg-blue-400 transition-colors {{ request('filter-user') == auth()->user()->id ? 'bg-blue-400' : '' }}" type="submit" onclick="this.form.submit()">
                Мои задачи
            </button>
        </form>
    </div>
</div>

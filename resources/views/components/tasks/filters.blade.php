<div class="w-full inline-flex">
    <div class="flex flex-row gap-5 content-center mb-4">

{{--        <form action="{{ route('tasks') }}" method="get">--}}
{{--            @csrf--}}
{{--            <input type="hidden" name="filter-user" value="{{ auth()->user()->id }}">--}}
{{--            <button class="p-1 bg-blue-300 rounded-md text-gray-800 hover:bg-blue-400 transition-colors {{ request('filter-user') == auth()->user()->id ? 'bg-blue-400' : '' }}" type="submit" onclick="this.form.submit()">--}}
{{--                Мои задачи--}}
{{--            </button>--}}
{{--        </form>--}}

        <form action="{{ route('tasks') }}" method="get" class="flex gap-2">
            @csrf
{{--            <select class="p-1 bg-neutral-700 rounded-md min-w-[150px]" name="filter-user">--}}
{{--                <option value="{{ request('filter-user') }}" disabled selected>--}}
{{--                    @if(request('filter-user') == null)--}}
{{--                        Все задачи--}}
{{--                    @endif--}}
{{--                    @if(request('filter-user') == 'tasks-all')--}}
{{--                        Все задачи--}}
{{--                    @else--}}
{{--                        {{ $users->where('id', '=', request('filter-user'))->pluck('name')->first() }}--}}
{{--                    @endif--}}
{{--                </option>--}}

{{--                @if(request('filter-user') != 'tasks-all' && request('filter-user') != null)--}}
{{--                    <option value="tasks-all">Все задачи</option>--}}
{{--                @endif--}}

{{--                @foreach($users as $user)--}}
{{--                    @if(request('filter-user') != $user->id)--}}
{{--                        <option value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </select>--}}

            <select class="p-1 shadow-md bg-neutral-300 border border-gray-500/30 text-gray-600 rounded-md min-w-[150px]" name="filter-user">
                <option value="" disabled @if(request('filter-user') == null) selected @endif>
                    {{ request('filter-user') == null ? 'Все задачи' : $users->where('id', '=', request('filter-user'))->pluck('name')->first() }}
                </option>

                <option value="tasks-all" @if(request('filter-user') == 'tasks-all') selected @endif class="{{ request('filter-user') == null ? 'hidden' : '' }}">
                    Все задачи
                </option>

                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if(request('filter-user') == $user->id) selected @endif class="{{ request('filter-user') == $user->id ? 'hidden' : '' }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="filter-start-date" value="{{ request('filter-start-date') }}" class="p-1 bg-neutral-300 border border-gray-500/40 text-gray-600 shadow-md rounded-md" placeholder="Начальная дата">
            <input type="date" name="filter-end-date" value="{{ request('filter-end-date') }}" class="p-1 bg-neutral-300 border border-gray-500/40 text-gray-600 shadow-md rounded-md" placeholder="Конечная дата">

            <x-tasks.filter-status :statuses="$statuses" />

            <button type="submit" class="p-1 px-6 shadow-md bg-amber-300 rounded-md text-gray-800 hover:bg-amber-400 transition-colors">
                Отфильтровать
            </button>
        </form>
    </div>
</div>

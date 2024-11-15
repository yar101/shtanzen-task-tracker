<x-errors-window/>

<div {{ $attributes->merge(['class' => 'fixed hidden z-50 inset-0 bg-neutral-800 bg-opacity-60 overflow-y-auto h-full w-full mx-auto p-20', 'id' => 'create-task-form']) }}>
    <div class="w-[500px] bg-neutral-200 text-gray-900 rounded-md mx-auto">
        <div
            class="grid grid-cols-[1fr,auto] bg-neutral-200 border-t border-t-neutral-500/70 shadow-md text-gray-600 rounded-md rounded-b-none mb-5 w-full p-1 text-center">
            <span class="text-center" id="create-task-form-header">Создание задачи</span>
            <button class="flex justify-center items-center p-1 bg-red-600/30 border border-red-500/50 shadow-md text-gray-900 rounded-md h-6 w-6 hover:bg-red-600/50 transition-colors cursor-pointer" onclick="closeCreateTaskModal('create-task-form')">X</button>
        </div>
        <form action="{{ route('task.store') }}" method="post" class="flex flex-col gap-2 p-3 w-full">
            @csrf

            <input type="hidden" value="" name="parent_id">

            <x-label for="contractor_id">Контрагент</x-label>
            <select class="p-1 bg-neutral-100 shadow-md border border-gray-500/50 rounded-md" name="contractor_id">
                @foreach($contractors as $contractor)
                    <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                @endforeach
            </select>

            @if(auth()->user()->role->name == 'head-of-department' && auth()->user()->role->name == 'admin')
                <x-label for="manager_id">Менеджер</x-label>
                <select class="p-1 bg-neutral-100 shadow-md border border-gray-500/50 rounded-md" name="manager_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            @elseif(auth()->user()->role->name == 'user')
                <input type="hidden" value="{{ auth()->user()->id }}" name="manager_id">
            @endif

            <x-label for="title">Заголовок</x-label>
            <x-input type="text" name="title" value="{{ old('title') }}"/>

            <x-label for="body">Описание</x-label>
            <textarea type="text" name="body" class="bg-neutral-100 shadow-md border border-gray-500/50 p-2 rounded-md">{{ old('body') }}</textarea>

            <x-label for="Дедлайн">Дедлайн</x-label>
            <x-input type="date" name="deadline_end" value="{{ \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d') }}"/>

            <div class="">
                <x-label for="cost">Стоимость</x-label>
                <br>
                <x-input type="text" name="cost" value="{{ old('cost') }}"/>
                <select class="p-1 bg-neutral-100 shadow-md border border-gray-500/50 rounded-md" name="currency">
                    <option value="RUB" selected>RUB</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="CNY">CNY</option>
                    <option value="LYR">LYR</option>
                </select>
            </div>

            <x-label for="priority">Приоритет</x-label>
            <select class="p-1 bg-neutral-100 shadow-md border border-gray-500/50 rounded-md" name="priority">
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III" selected>III</option>
            </select>

{{--            <x-label for="comment">Комментарий</x-label>--}}
{{--            <textarea type="text" name="comment" class="bg-neutral-100 shadow-md border border-gray-500/50 p-2 rounded-md"></textarea>--}}

            <x-button id="create-task-submit-button" type="submit">Создать</x-button>
        </form>
    </div></div>

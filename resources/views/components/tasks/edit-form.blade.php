@if ($errors->any())
    <div id="task-create-errors"
         class="absolute bottom-5 left-5 z-10 shadow shadow-black bg-neutral-900 rounded-md border border-red-500">
        <span class="text-red-600 font-bold p-1 text-end flex justify-between">
            <span class="pl-1">Ошибка</span>
            <button id="close-errors-button" class="pr-1">X</button>
        </span>
        <ul class="border-l-0 border-r-0 border border-red-500 p-2">
            @foreach($errors->all() as $error)
                <li class="text-red-600">
                    # {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

<div {{ $attributes->merge(['class' => 'w-full h-fit bg-neutral-800 rounded-md w-[500px] mx-auto', 'id' => 'edit-task-form']) }}>
    {{--            <button class="bg-blue-800 text-white p-1 rounded-md w-fit mb-5">Создать задачу</button>--}}
    <div class=" flex flex-row align-middle gap-2 bg-neutral-700 border-t border-t-neutral-500/70 text-white rounded-md rounded-b-none mb-5 w-full p-1 text-center">
        <div class="bg-red-600/20 p-1 rounded-md">
            <a href="/tasks" class="text-red-500 text-lg font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                </svg>
            </a>
        </div>
        <div class="text-center flex-grow content-center">Редактирование задачи № {{ $task->id }}</div>
    </div>
    <form action="{{ route('task.update', $task->id ) }}" method="post" class="flex flex-col gap-2 p-3 w-full">
        @csrf
        @method('PATCH')
        {{--        <x-label for="contractor_id">Контрагент</x-label>--}}
        {{--        <select class="p-1 bg-neutral-700 rounded-md" name="contractor_id">--}}
        {{--            @foreach($contractors as $contractor)--}}
        {{--                <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>--}}
        {{--            @endforeach--}}
        {{--        </select>--}}

        @if(auth()->user()->role->name == 'head-of-department')
            <x-label for="manager_id">Менеджер</x-label>
            <select class="p-1 bg-neutral-700 rounded-md" name="manager_id">
                @foreach($users as $user)
                    <option
                        value="{{ $user->id }}" {{ $task->manager_id == $user->id ? 'selected' : '' }}>{{ $user->name }}
                    </option>
                @endforeach
            </select>
        @endif

        <x-label for="title">Заголовок</x-label>
        <x-input type="text" name="title" value="{{ $task->title ?? old('title') }}"/>

        <x-label for="body">Описание</x-label>
        <textarea type="text" name="body"
                  class="bg-neutral-700 p-2 rounded-md h-[100px]">{{ $task->body ?? old('body') }}</textarea>

        <x-label for="Дедлайн">Дедлайн</x-label>
        <x-input type="date" name="deadline_end"
                 value="{{ $task->deadline_end ?? \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d') }}"/>

        <div class="">
            <x-label for="cost">Стоимость</x-label>
            <br>
            <x-input type="text" name="cost" value="{{ $task->cost ?? old('cost') }}"/>
            <select class="p-1 bg-neutral-700 rounded-md" name="currency">
                <option value="RUB" {{ $task->currency == 'RUB' ? 'selected' : '' }}>RUB</option>
                <option value="USD" {{ $task->currency == 'USD' ? 'selected' : '' }}>USD</option>
                <option value="EUR" {{ $task->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                <option value="CNY" {{ $task->currency == 'CNY' ? 'selected' : '' }}>CNY</option>
                <option value="LYR" {{ $task->currency == 'LYR' ? 'selected' : '' }}>LYR</option>
            </select>
        </div>

        <x-label for="priority">Приоритет</x-label>
        <select class="p-1 bg-neutral-700 rounded-md" name="priority">
            <option value="I" {{ $task->priority == 'I' ? 'selected' : '' }}>I</option>
            <option value="II" {{ $task->priority == 'II' ? 'selected' : '' }}>II</option>
            <option value="III" {{ $task->priority == 'III' ? 'selected' : '' }}>III</option>
        </select>

        <x-label for="comment">Комментарий</x-label>
        <textarea type="text" name="comment"
                  class="bg-neutral-700 p-2 rounded-md h-[200px]">{{ $task->comment ?? old('comment') }}</textarea>

        <x-button type="submit">Сохранить</x-button>
    </form>
</div>

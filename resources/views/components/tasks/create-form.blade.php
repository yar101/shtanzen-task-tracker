@if ($errors->any())
    <div id="task-create-errors" class="absolute bottom-5 left-5 z-10 shadow shadow-black bg-neutral-900 rounded-md border border-red-500">
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

<div {{ $attributes->merge(['class' => 'w-full h-fit bg-neutral-800 rounded-md hidden', 'id' => 'create-task-form']) }}>
    {{--            <button class="bg-blue-800 text-white p-1 rounded-md w-fit mb-5">Создать задачу</button>--}}
    <div class="bg-neutral-700 border-t border-t-neutral-500/70 text-white rounded-md rounded-b-none mb-5 w-full p-1 text-center">Создание задачи</div>
    <form action="{{ route('task.store') }}" method="post" class="flex flex-col gap-2 p-3 w-full">
        @csrf

        <x-label for="contractor_id">Контрагент</x-label>
        <select class="p-1 bg-neutral-700 rounded-md" name="contractor_id">
            @foreach($contractors as $contractor)
                <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
            @endforeach
        </select>

        <x-label for="title">Заголовок</x-label>
        <x-input type="text" name="title" value="{{ old('title') }}"/>

        <x-label for="body">Описание</x-label>
        <textarea type="text" name="body" class="bg-neutral-700 p-2 rounded-md">{{ old('body') }}</textarea>

        <x-label for="Дедлайн">Дедлайн</x-label>
        <x-input type="date" name="deadline_end" value="{{ \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d') }}"/>

        <div class="">
            <x-label for="cost">Стоимость</x-label>
            <br>
            <x-input type="text" name="cost"/>
            <select class="p-1 bg-neutral-700 rounded-md" name="currency">
                <option value="RUB" selected>RUB</option>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="CNY">CNY</option>
                <option value="LYR">LYR</option>
            </select>
        </div>

        <x-label for="priority">Приоритет</x-label>
        <select class="p-1 bg-neutral-700 rounded-md" name="priority">
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III" selected>III</option>
        </select>

        <x-label for="comment">Комментарий</x-label>
        <textarea type="text" name="comment" class="bg-neutral-700 p-2 rounded-md"></textarea>

        <x-button id="create-task-submit-button" type="submit">Создать</x-button>
    </form>
</div>

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

<div {{ $attributes->merge(['class' => 'w-full h-fit bg-neutral-800 rounded-md hidden', 'id' => 'create-contractor-form']) }}>
    {{--            <button class="bg-blue-800 text-white p-1 rounded-md w-fit mb-5">Создать задачу</button>--}}
    <div class="bg-neutral-700 border-t border-t-neutral-500/70 text-white rounded-md rounded-b-none mb-5 w-full p-1 text-center">Создание контрагента</div>
    <form action="{{ route('contractor.store') }}" method="post" class="flex flex-col gap-2 p-3 w-full">
        @csrf
        <x-label for="title">Наименование</x-label>
        <x-input type="text" name="name" value="{{ old('name') }}"/>

        <x-button id="create-task-submit-button" type="submit">Создать</x-button>
    </form>
</div>

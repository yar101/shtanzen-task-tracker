<x-errors-window/>
<div {{ $attributes->merge(['class' => 'w-full h-fit bg-neutral-300 border border-gray-500/50 rounded-md hidden', 'id' => 'create-contractor-form']) }}>
    {{--            <button class="bg-blue-800 text-white p-1 rounded-md w-fit mb-5">Создать задачу</button>--}}
    <div class="bg-neutral-400 border-t border-t-neutral-500 text-neutral-900 rounded-md rounded-b-none mb-5 w-full p-1 text-center">Создание контрагента</div>
    <form action="{{ route('contractor.store') }}" method="post" class="flex flex-col gap-2 p-3 w-full">
        @csrf
        <x-label for="title">Наименование</x-label>
        <x-input type="text" name="name" value="{{ old('name') }}"/>

        <x-button id="create-task-submit-button" type="submit">Создать</x-button>
    </form>
</div>

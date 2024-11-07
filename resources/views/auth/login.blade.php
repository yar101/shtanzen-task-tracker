<x-layout>
    <div class="w-full mt-52">
        <form action="/login" method="post"
              class="flex flex-col gap-5 w-[320px] mx-auto bg-neutral-100 p-3 rounded-md shadow-xl text-neutral-800">
            @csrf
            <div class="flex justify-center text-lg font-bold text-neutral-800">
                Вход
            </div>
            @if($errors)
                <div class="flex flex-row justify-center mb-2 w-full bg-red-100 rounded-md">
                    <span class="text-red-600">
                        {{ $errors->first() }}
                    </span>
                </div>
            @endif
            <x-form-field class="">
                <x-label for="name">Имя</x-label>
                <x-input type="text" name="name"></x-input>
            </x-form-field>
            <x-form-field class="">
                <x-label for="password">Пароль</x-label>
                <x-input type="password" name="password"></x-input>
            </x-form-field>
            <div class="">
                <x-button type="submit">Войти</x-button>
            </div>
        </form>
    </div>
</x-layout>

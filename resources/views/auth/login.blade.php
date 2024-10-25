<x-layout>
    <div class="w-full mt-52">
        <form action="/login" method="post" class="flex flex-col gap-5 w-[400px] mx-auto bg-neutral-900 p-8 rounded-lg">
            @csrf
            <div class="flex justify-center text-lg font-bold text-blue-300">
                Вход
            </div>
            <div class="flex flex-row justify-center mb-2 w-full">
                @error('login')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
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

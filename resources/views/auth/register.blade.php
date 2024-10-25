<x-layout>
    <div class="w-full mt-52">
        <form action="/register" method="post" class="flex flex-col gap-2 w-[300px] mx-auto">
            @csrf
            <x-form-field class="">
                <x-label for="name">Имя</x-label>
                <x-input type="text" name="name"></x-input>
            </x-form-field>
            <x-form-field class="">
                <x-label for="email">Email</x-label>
                <x-input type="email" name="email"></x-input>
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

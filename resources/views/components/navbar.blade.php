<nav class="flex flex-row justify-between bg-neutral-800 py-2 px-5">
    <div>
        <a href="{{ route('tasks') }}" class="font-bold text-lg text-blue-300">STANZEN</a>
    </div>

    <div class="">
        <x-navbar-link>Задачи</x-navbar-link>
    </div>

    <div class="">
        <x-profile-dropdown />

    </div>
</nav>

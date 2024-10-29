<nav class="flex fixed z-10 w-full backdrop-blur-xl flex-row justify-between bg-neutral-900/80 border-b border-neutral-600 py-2 px-5">
    <div class="flex flex-row gap-5">
        <a href="{{ route('tasks') }}" class="font-bold text-lg text-blue-300">STANZEN /tasker</a>
        @if (request()->routeIs('tasks'))
            <button id="create-task-button" class="text-violet-300 hover:text-violet-500 transition-colors border-violet-300 hover:border-violet-500 border px-2 rounded-md">Создать задачу</button>
        @endif
    </div>

    <div class="">
        <x-navbar-link href="/tasks" :active="request()->routeIs('tasks')">Задачи</x-navbar-link>
    </div>

    <div class="">
        <x-profile-dropdown />

    </div>
</nav>

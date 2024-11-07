<nav class="flex fixed z-10 w-full backdrop-blur-xl flex-row justify-between bg-blue-300/70 border-b border-neutral-600/30 shadow-md py-2 px-5">
    <div class="flex flex-row gap-5">
        <a href="{{ route('tasks') }}" class="font-bold text-lg text-gray-600">STANZEN /tasker /{{ auth()->user()->department->name }}</a>
        @if (request()->routeIs('tasks'))
            <button id="create-task-button" onclick="openModal('create-task-form')" class="text-gray-900 hover:shadow-md bg-indigo-300/80 transition-all border-blue-700 hover:border-blue-900 border px-2 rounded-md">Создать задачу</button>
        @endif
        @if (request()->routeIs('contractors'))
            <button id="create-contractor-button" class="text-gray-900 hover:shadow-md bg-indigo-300/80 transition-all border-blue-700 hover:border-blue-900 border px-2 rounded-md">Создать контрагента</button>
        @endif
    </div>

    <div class="flex flex-row gap-5">
        <x-navbar-link href="/tasks" :active="request()->routeIs('tasks')">Задачи</x-navbar-link>
        @if(auth()->user()->role->name == 'head-of-department')
            <x-navbar-link href="/contractors" :active="request()->routeIs('contractors')">Контрагенты</x-navbar-link>
        @endif
    </div>

    <div class="">
        <x-profile-dropdown />

    </div>
</nav>

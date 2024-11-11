<nav
    class="grid grid-cols-[auto,1fr,1fr,auto] gap-10 fixed z-10 w-full backdrop-blur-xl flex-row justify-between bg-blue-300/70 border-b border-neutral-600/30 shadow-md py-2 px-5">

    <div class="w-fit">
        <a href="{{ route('tasks') }}" class="font-bold text-lg text-gray-600">STANZEN /tasker /Админ панель</a>
    </div>

    <div class="flex w-fit gap-5">
        @if (request()->routeIs('admin.tasks'))
            <button id="create-task-button" onclick="openModal('create-task-form')"
                    class="text-gray-900 hover:shadow-md bg-indigo-300/80 transition-all border-blue-700 hover:border-blue-900 border px-2 rounded-md">
                Создать задачу
            </button>
        @endif
        @if (request()->routeIs('admin.contractors'))
            <button id="create-contractor-button"
                    class="text-gray-900 hover:shadow-md bg-indigo-300/80 transition-all border-blue-700 hover:border-blue-900 border px-2 rounded-md">
                Создать контрагента
            </button>
        @endif
    </div>

    <div class="flex justify-center items-center w-fit gap-5">
        <x-navbar-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">Дашборд
        </x-navbar-link>
        <x-navbar-link href="{{ route('admin.tasks') }}" :active="request()->routeIs('admin.tasks')">Задачи
        </x-navbar-link>
        <x-navbar-link href="{{ route('admin.contractors') }}" :active="request()->routeIs('contractors')">Контрагенты
        </x-navbar-link>
    </div>

    <div class="flex items-center">
        <x-profile-dropdown/>
    </div>
</nav>

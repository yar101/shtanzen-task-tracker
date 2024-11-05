<x-admin.layout>
    <x-admin.navbar/>

    <div id="admin-wrapper" class="w-full justify-center gap-5 py-20 px-10">

        <div class="bg-neutral-300/50 text-neutral-800 shadow-xl border border-gray-500/15 rounded-md">

            <div
                class="flex justify-center text-lg font-bold bg-neutral-400/70 border-b border-gray-500/30 text-neutral-800 rounded-t-md">
                Панель
                статистики
            </div>

            <div class="p-5 text-md text-neutral-900 grid grid-cols-[40%,auto]" id="admin-statistics">

                <div class="mt-10">

                    <span class="font-semibold text-lg">Пользователи</span> <br>

                    <button onclick="openModal('create-user-form')"
                            class="font-semibold px-8 border border-gray-500/30 py-1 bg-blue-500/30 rounded hover:bg-blue-500/50 transition-all">
                        Создать пользователя
                    </button>

                    <form action="{{ route('admin.create-test-user') }}">
                        <button type="submit"
                            class="font-semibold px-8 border border-gray-500/30 py-1 bg-yellow-500/30 rounded hover:bg-blue-500/50 transition-all">
                            Создать ТЕСТОВОГО пользователя
                        </button>
                    </form>

                    <div class="flex flex-col gap-2 mt-3 max-h-96 overflow-y-scroll p-2">
                        @foreach($users as $user)
                            <div
                                class="flex justify-between items-center bg-neutral-200 shadow-md border border-gray-500/30 px-5 py-2 rounded hover:bg-gray-100 hover:px-10 transition-all">
                                <span class="mr-5 font-semibold">{{$user->name}} - {{ $user->role->name }}</span>
                                <div class="flex gap-2">
                                    <button
                                        class="px-2 text-sm py-1 bg-yellow-500/30 hover:bg-yellow-500/50 transition-all rounded-md"
                                        wire:click="editUser({{ $user->id }})">Редактировать
                                    </button>
                                    <button
                                        class="px-2 py-1 text-sm bg-red-500/30 hover:bg-red-500/50 transition-all rounded-md "
                                        wire:click="deleteUser({{ $user->id }})">Удалить
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="">
                    block2
                </div>

            </div>
        </div>
    </div>

    <livewire:admin.users.create-user/>

    @if (session()->has('createUserSuccess'))
        <div class="bg-green-500 text-white p-2 rounded">
            {{ session('createUserSuccess') }}
        </div>
    @endif

    @if (session()->has('createUserError'))
        <div class="bg-red-500 text-white p-2 rounded">
            {{ session('createUserError') }}
        </div>
    @endif

</x-admin.layout>

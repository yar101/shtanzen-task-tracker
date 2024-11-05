<div class='fixed hidden z-50 inset-0 bg-neutral-800 bg-opacity-60 overflow-y-auto h-full w-full mx-auto p-20' id="create-user-form">
    <div class="w-[500px] bg-neutral-200 text-gray-900 rounded-md mx-auto">
        <div
            class="grid grid-cols-[1fr,auto] bg-neutral-200 border-t border-t-neutral-500/70 shadow-md text-gray-600 rounded-md rounded-b-none mb-5 w-full p-1 text-center">
            <span class="text-center" id="create-task-form-header">Создание пользователя</span>
            <button
                class="flex justify-center items-center p-1 bg-red-600/30 border border-red-500/50 shadow-md text-gray-900 rounded-md h-6 w-6 hover:bg-red-600/50 transition-colors cursor-pointer"
                onclick="closeCreateTaskModal('create-user-form')">X
            </button>
        </div>
        <form wire:submit="store" class="flex flex-col gap-2 p-3 w-full">
            @csrf

            <x-input type="text" wire:model="form.name" placeholder="name" />
            <x-error-raw :field="'form.name'" />

            <x-input type="email" wire:model="form.email" placeholder="email" />
            <x-error-raw :field="'form.email'" />

            <x-input type="password" wire:model="form.password" placeholder="password" />
            <x-error-raw :field="'form.password'" />

            <x-input type="password" wire:model="form.password_confirmation" placeholder="password confirmation" />
            <x-error-raw :field="'form.password_confirmation'" />

            <div class="w-full text-center text-lg">Роль</div>
            <div class="neo-inset p-2 rounded-md grid grid-cols-[1fr,1fr]">
                @foreach($roles as $role)
                    <div class="flex flex-row gap-2">
                        <input type="radio" wire:model="form.role_id" value="{{ $role->id }}"/>
                        <div>{{ $role->name }}</div>
                    </div>
                @endforeach
            </div>
{{--            <x-input type="text" wire:model="form.role_id" placeholder="role_id" />--}}
            <x-error-raw :field="'form.role_id'" />

            <div class="w-full text-center text-lg">Отдел</div>
            <div class="neo-inset p-2 rounded-md grid grid-cols-[1fr,1fr]">
                @foreach($departments as $department)
                    <div class="flex flex-row gap-2">
                        <input type="radio" wire:model="form.department_id" value="{{ $department->id }}"/>
                        <div>{{ $department->name }}</div>
                    </div>
                @endforeach
            </div>
{{--            <x-input type="text" wire:model="form.department_id" placeholder="department_id" />--}}
            <x-error-raw :field="'form.department_id'" />

            <x-button id="create-task-submit-button" type="submit">Создать</x-button>

        </form>
    </div>
</div>

<x-layout>
    <x-navbar/>

    <div id="tasks-wrapper" class="w-full justify-center py-20 px-10">

        @if(auth()->user()->role->name == 'head-of-department' || auth()->user()->role->name == 'admin')
            <x-tasks.edit-form :task="$task" :users="$users" :contractors="$contractors" />
        @elseif (auth()->user()->role->name == 'user')
            <x-tasks.edit-form :task="$task" :contractors="$contractors" />
        @endif

    </div>
</x-layout>

<x-layout>
    <x-navbar/>

    <div id="tasks-wrapper" class="w-full justify-center py-20 px-10">

        @if(auth()->user()->role->name == 'head-of-department')
            <x-tasks.edit-form :task="$task" :users="$users" />
        @else
            <x-tasks.edit-form :task="$task" />
        @endif

    </div>
</x-layout>

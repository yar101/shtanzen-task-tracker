<x-layout>
    <x-navbar/>

    <div id="tasks-wrapper" class="w-full justify-center gap-5 py-20 px-10">

        @if(auth()->user()->role->name == 'head-of-department' || auth()->user()->role->name == 'admin')
            <x-tasks.create-form :contractors="$contractors" :users="$users" />
        @else
            <x-tasks.create-form :contractors="$contractors" />
        @endif

        <x-tasks.table :tasks="$tasks"/>

    </div>
</x-layout>

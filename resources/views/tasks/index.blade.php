<x-layout>
    <x-navbar/>

    <div class="py-20 px-10">
        <x-tasks.filters :users="$users"/>

        <div id="tasks-wrapper" class="w-full justify-center gap-5">

            @if(auth()->user()->role->name == 'head-of-department' || auth()->user()->role->name == 'admin')
                <x-tasks.create-form :contractors="$contractors" :users="$users"/>
            @elseif (auth()->user()->role->name == 'user')
                <x-tasks.create-form :contractors="$contractors"/>
            @endif

            <x-tasks.table :tasks="$tasks" :statuses="$statuses" :users="$users" :contractors="$contractors"/>

        </div>
    </div>
</x-layout>

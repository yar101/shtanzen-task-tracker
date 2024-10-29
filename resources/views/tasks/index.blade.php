<x-layout>
    <x-navbar/>

    <div id="tasks-wrapper" class="w-full justify-center gap-5 py-20 px-10">

        <x-tasks.create-form />
        <x-tasks.table :tasks="$tasks"/>

    </div>
</x-layout>

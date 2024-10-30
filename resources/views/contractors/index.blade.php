<x-layout>
    <x-navbar/>

    <div id="contractors-wrapper" class="w-full justify-center gap-5 py-20 px-10">

        <x-contractors.create-form />
        <x-contractors.table :contractors="$contractors"/>

    </div>
</x-layout>

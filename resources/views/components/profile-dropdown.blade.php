<div class="relative inline-block text-left">
    <div id="menu-button">
        <button type="button" id="profile-button" class="inline-flex w-full justify-center gap-x-1.5 px-3 text-sm font-semibold text-black" aria-expanded="true" aria-haspopup="true">
            {{ auth()->user()->name }}
            {{--                    <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">--}}
            {{--                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />--}}
            {{--                    </svg>--}}
        </button>
    </div>

    <!--
      Dropdown menu, show/hide based on menu state.

      Entering: "transition ease-out duration-100"
        From: "transform opacity-0 scale-95"
        To: "transform opacity-100 scale-100"
      Leaving: "transition ease-in duration-75"
        From: "transform opacity-100 scale-100"
        To: "transform opacity-0 scale-95"
    -->
    <div id="profile-menu" class="absolute hidden right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-neutral-100 border border-gray-500 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
{{--        <div class="py-1" role="none">--}}
{{--            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->--}}
{{--            <a href="#" class="block m-2 rounded-md px-4 py-2 text-sm text-neutral-100 hover:bg-blue-800/50" role="menuitem" tabindex="-1" id="menu-item-0">Edit</a>--}}
{{--            <a href="#" class="block m-2 rounded-md px-4 py-2 text-sm text-neutral-100 hover:bg-blue-800/50" role="menuitem" tabindex="-1" id="menu-item-1">Duplicate</a>--}}
{{--        </div>--}}
{{--        <div class="py-1" role="none">--}}
{{--            <a href="#" class="block m-2 rounded-md px-4 py-2 text-sm text-neutral-100 hover:bg-blue-800/50" role="menuitem" tabindex="-1" id="menu-item-2">Archive</a>--}}
{{--            <a href="#" class="block m-2 rounded-md px-4 py-2 text-sm text-neutral-100 hover:bg-blue-800/50" role="menuitem" tabindex="-1" id="menu-item-3">Move</a>--}}
{{--        </div>--}}
{{--        <div class="py-1" role="none">--}}
{{--            <a href="#" class="block m-2 rounded-md px-4 py-2 text-sm text-neutral-100 hover:bg-blue-800/50" role="menuitem" tabindex="-1" id="menu-item-4">Share</a>--}}
{{--            <a href="#" class="block m-2 rounded-md px-4 py-2 text-sm text-neutral-100 hover:bg-blue-800/50" role="menuitem" tabindex="-1" id="menu-item-5">Add to favorites</a>--}}
{{--        </div>--}}
        <div class="" role="none">
            <form action="/logout" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full block px-4 py-2 text-sm text-red-800 hover:bg-red-800/40 hover:text-black transition-colors" role="menuitem" tabindex="-1" id="menu-item-6">Выйти</button>
            </form>
        </div>
    </div>
</div>

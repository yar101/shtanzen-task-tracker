@if ($errors->any())
    <div id="errors-window" class="fixed top-[4rem] right-5 z-10 shadow-md bg-red-300/60 backdrop-blur-md rounded-md border border-red-500/50">
        <span class="font-bold p-1 text-end flex justify-between">
            <span class="pl-1 text-black flex items-center">Ошибка</span>
            <button id="close-errors-button" class="py-1 px-2 text-red-500 border border-red-600 hover:border-neutral-700/60 hover:text-red-400 rounded-md transition-all">X</button>
        </span>
        <ul class="border-l-0 border-r-0 border border-red-500 p-2">
            @foreach($errors->all() as $error)
                <li class="text-neutral-950 font-mono">
                    {{ $loop->index + 1 }}. {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif

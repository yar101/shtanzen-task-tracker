<div class="">
    <div class="flex flex-row justify-between">
        <div class="grid grid-cols-5 font-bold text-lg text-blue-300 border border-blue-300 rounded p-2 w-full hover:bg-blue-300 hover:text-black transition-colors">
            <div class="">
                {{ $task->title }}
            </div>
            <div class="">
                {{ $task->body }}
            </div>
            <div class="">
                {{ $task->deadline_start }}
            </div>
            <div class="">
                {{ $task->deadline_end }}
            </div>
        </div>
    </div>
</div>

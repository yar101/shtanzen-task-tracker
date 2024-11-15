<div class="relative overflow-x-auto border-gray-500/50 shadow-xl border rounded-xl">
    <table class="w-full text-md text-gray-800">
        <thead class="text-xs text-gray-700 uppercase bg-blue-200 border-b border-b-blue-400/50 border-gray-500/50">
        <tr>
            <th scope="col" class="px-2 py-2 text-center w-[150px]">
                Статус
            </th>
            <th scope="col" class="px-2 py-2 text-center">
                Менеджер
            </th>
            <th scope="col" class="px-2 py-2 text-center">

            </th>
            <th scope="col" class="px-2 py-2 text-center">
                Заказчик
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Тема
            </th>

            <th scope="col" class="px-2 py-2 text-center w-fit">
                Задача
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Начало
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Дедлайн
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Последний комментарий
            </th>

            <th scope="col" class="px-2 py-2 text-center">
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            @if($task->subtasks()->count() > 0)

{{--                @if(!($loop->first))--}}
{{--                    <tr class="separator-row">--}}
{{--                        <td colspan="10" class="h-5 border-b border-t bg-transparent border-gray-500/50"></td>--}}
{{--                    </tr>--}}
{{--                @endif--}}

                <x-tasks.table-row :task="$task" :statuses="$statuses" class="border-b border-gray-500/50"/>

                @foreach($task->subtasks() as $subtask)
                    <x-tasks.table-row :task="$subtask" :statuses="$statuses" class="border-b border-gray-500/50"/>
                @endforeach

                <tr class="separator-row">
                    <td colspan="10" class="h-10 bg-transparent border-b border-t border-gray-500/50"></td>
                </tr>

            @elseif ($task->parent_id == null)
                <x-tasks.table-row :task="$task" :statuses="$statuses" class="border-b border-gray-500/50"/>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

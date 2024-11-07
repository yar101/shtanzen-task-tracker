<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-md text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-2 py-2 text-center w-[150px]">
                Статус
            </th>
            <th scope="col" class="px-2 py-2 text-center">
                Менеджер
            </th>
            <th scope="col" class="px-2 py-2 text-center">
                Приоритет
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
                Дата начала
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
                @if(!($loop->first))
                    <tr class="separator-row">
                        <td colspan="10" class="h-5 bg-transparent"></td>
                    </tr>
                @endif

                <x-tasks.table-row :task="$task" :statuses="$statuses"/>
                @foreach($task->subtasks() as $subtask)
                    <x-tasks.table-row :task="$subtask" :statuses="$statuses" />
                @endforeach
                <tr class="separator-row">
                    <td colspan="10" class="h-5 bg-transparent"></td>
                </tr>
            @elseif ($task->parent_id == null)
                <x-tasks.table-row :task="$task" :statuses="$statuses"/>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

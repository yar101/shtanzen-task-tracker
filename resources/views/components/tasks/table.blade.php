<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-md text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-4 text-center">
                Статус
            </th>
            <th scope="col" class="px-4 py-4 text-center">
                Менеджер
            </th>
            <th scope="col" class="px-4 py-4 text-center">
                Приоритет
            </th>
            <th scope="col" class="px-4 py-4 text-center">
                Заказчик
            </th>

            <th scope="col" class="px-4 py-4 text-center">
                Тема
            </th>

            <th scope="col" class="px-4 py-4 text-center">
                Задача
            </th>

            <th scope="col" class="px-4 py-4 text-center">
                Дата начала
            </th>

            <th scope="col" class="px-4 py-4 text-center">
                Дедлайн
            </th>

            <th scope="col" class="px-4 py-4 text-center">
                Комментарий
            </th>

{{--            <th scope="col" class="px-3 py-4 text-center">--}}
{{--            </th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="task-status px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center
                {{
                    match ($task->status->name) {
                        'NOT STARTED' => 'bg-gray-200/40 text-blue-100',
                        'ONGOING' => 'bg-blue-500/40 text-blue-100',
                        'DELAY' => 'bg-yellow-500/40 text-yellow-100',
                        'DONE' => 'bg-green-500/40 text-green-100',
                        'ARCHIVED' => 'bg-neutral-700/40 text-gray-200',
                        }
 }}
                ">
                    {{ $task->status->name }}
                </th>
                <td class="px-4 py-4 text-center">
                    {{ \App\Models\User::find($task->created_by)->name }}
                </td>
                <td class="px-4 py-4 text-center
                {{
                    match ($task->priority) {
                        'I' => 'bg-red-500/40 text-red-100',
                        'II' => 'bg-yellow-500/40 text-yellow-100',
                        'III' => 'bg-green-500/40 text-green-100',
                        }
 }}
                ">
                    {{ $task->priority }}
                </td>
                <td class="px-4 py-4 text-center">
                    @if($task->contractor_id)
                        {{ $task->contractor->name }}
                    @else
                        Без контрагента
                    @endif
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $task->title }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $task->body }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $task->deadline_start }}
                </td>
                <td id="task-deadline-end" class="px-4 py-4 text-center">
                    {{ $task->deadline_end }}
                </td>
                <td class="px-4 py-4 text-center">
                    {{ $task->cutComment() }}
                </td>
{{--                <td class="px-4 py-4">--}}
{{--                    <button id="task-{{$task->id}}}-action-button" class="flex flex-col gap-1">--}}
{{--                        <span class="w-1 h-1 rounded-full bg-green-600 block"></span>--}}
{{--                        <span class="w-1 h-1 rounded-full bg-green-600 block"></span>--}}
{{--                        <span class="w-1 h-1 rounded-full bg-green-600 block"></span>--}}
{{--                    </button>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

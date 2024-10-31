<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-md text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-2 py-2 text-center">
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

            <th scope="col" class="px-2 py-2 text-center">
                Задача
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Дата начала
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Дедлайн
            </th>

            <th scope="col" class="px-2 py-2 text-center">
                Комментарий
            </th>

            <th scope="col" class="px-2 py-2 text-center">
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="task-status font-medium text-gray-900 whitespace-nowrap dark:text-white text-center
                {{
                    match ($task->status->name) {
                        'NOT STARTED' => 'bg-gray-200/20',
                        'ONGOING' => 'bg-blue-500/30',
                        'ON HOLD' => 'bg-yellow-500/40',
                        'DONE' => 'bg-green-500/40',
                        'DELAY' => 'bg-red-700/30',
                        }
}}
                ">
                    <form action="{{ route('task.status-update', $task->id) }}" method="post" class="">
                        @csrf
                        @method('PATCH')
                        <select name="status_id" onchange="this.form.submit()" class="p-2 bg-transparent cursor-pointer
                        {{
    match ($task->status->name) {
        'NOT STARTED' => 'text-neutral-400',
        'ONGOING' => 'text-blue-500',
        'ON HOLD' => 'text-yellow-400',
        'DONE' => 'text-green-400',
        'DELAY' => 'text-red-500',
    }
}}
                        ">
                            @foreach($statuses as $status)
                                <option
                                    value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </th>
                <td class="px-2 py-2 text-center">
                    {{ \App\Models\User::find($task->manager_id)->name }}
                </td>
                <td class="px-2 py-2 text-center
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
                <td class="px-2 py-2 text-center">
                    @if($task->contractor_id)
                        {{ $task->contractor->name }}
                    @else
                        Без контрагента
                    @endif
                </td>
                <td class="px-2 py-2 text-center">
                    {{ $task->title }}
                </td>
                <td class="px-2 py-2 text-center">
                    {{ $task->body }}
                </td>
                <td class="px-2 py-2 text-center">
                    {{ $task->deadline_start }}
                </td>
                <td id="task-deadline-end" class="px-2 py-2 text-center">
                    {{ $task->deadline_end }}
                </td>
                <td class="px-2 py-2 text-center">
                    @if(strlen($task->comment) > 30)
                        <details class="w-full">
                            <summary class="cursor-pointer text-cyan-300 select-none hover:underline">
                                {{ $task->cutComment() }}...
                            </summary>
                            <div class="break-words">
                                {{ $task->comment }}
                            </div>
                        </details>
                    @else
                        {{ $task->comment }}
                    @endif
                </td>
                <td class="">
                    <a href="{{ route('task.edit', $task->id) }}"
                       class="flex justify-center m-1 bg-cyan-500/20 hover:bg-cyan-500/70 p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="white" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-9.193 9.193a4.5 4.5 0 01-1.591 1.035l-3.372 1.124a.75.75 0 01-.949-.949l1.124-3.372a4.5 4.5 0 011.035-1.591l9.193-9.193z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6.75L15 2.25"/>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{--Сохранение позиции скролла--}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Проверяем, есть ли сохраненная позиция скролла в localStorage
        const scrollPosition = localStorage.getItem("scrollPosition");

        // Если позиция есть, восстанавливаем её
        if (scrollPosition) {
            window.scrollTo(0, scrollPosition);
        }

        // Сохраняем текущую позицию скролла в localStorage при прокрутке страницы
        window.addEventListener("scroll", function () {
            localStorage.setItem("scrollPosition", window.scrollY);
        });
    });
</script>

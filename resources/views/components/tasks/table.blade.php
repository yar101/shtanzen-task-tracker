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
                    <form action="{{ route('task.status-update', $task->id) }}" method="post" class="w-[100px]">
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
                <td class="px-2 py-2 text-center w-[70px]
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
                <td class="px-2 py-2 text-center w-[200px]">
                    {{ $task->title }}
                </td>
                <td class="px-2 py-2 text-center w-[500px]">
                    {{ $task->body }}
                </td>
                <td class="px-2 py-2 text-center">
                    {{ $task->deadline_start }}
                </td>
                <td id="task-deadline-end" class="px-2 py-2 text-center">
                    <form action="{{ route('task.deadline-end-update', $task->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="date" name="deadline_end" value="{{ $task->deadline_end }}"
                               class="bg-transparent p-1 text-center border-none"
                               onblur="this.form.submit()">
                    </form>
                </td>
                <td class="px-2 py-2 text-center">
                    @if($task->comments->count() > 0)
                        {{ $task->comments->last()->content }}
                    @else
                        <div class="flex flex-col gap-1">
                            -
                        </div>
                    @endif
                </td>

                <td>
                    <button class="bg-blue-100 flex justify-center text-white rounded-md p-1 hover:bg-blue-200 h-8 w-8"
                            onclick="openModal('modelConfirm-{{ $task->id }}')">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M10 9H17M10 13H17M7 9H7.01M7 13H7.01M21 20L17.6757 18.3378C17.4237 18.2118 17.2977 18.1488 17.1656 18.1044C17.0484 18.065 16.9277 18.0365 16.8052 18.0193C16.6672 18 16.5263 18 16.2446 18H6.2C5.07989 18 4.51984 18 4.09202 17.782C3.71569 17.5903 3.40973 17.2843 3.21799 16.908C3 16.4802 3 15.9201 3 14.8V7.2C3 6.07989 3 5.51984 3.21799 5.09202C3.40973 4.71569 3.71569 4.40973 4.09202 4.21799C4.51984 4 5.0799 4 6.2 4H17.8C18.9201 4 19.4802 4 19.908 4.21799C20.2843 4.40973 20.5903 4.71569 20.782 5.09202C21 5.51984 21 6.0799 21 7.2V20Z"
                                    stroke="#1c71d8" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </button>
                </td>

                <td class="">
                    <a href="{{ route('task.edit', $task->id) }}"
                       class="flex justify-center bg-[#ffde70] p-1 m-1 rounded-md h-8 w-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="#000" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-9.193 9.193a4.5 4.5 0 01-1.591 1.035l-3.372 1.124a.75.75 0 01-.949-.949l1.124-3.372a4.5 4.5 0 011.035-1.591l9.193-9.193z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6.75L15 2.25"/>
                        </svg>
                    </a>
                </td>
            </tr>
            <x-comments.create-form :task="$task"/>
        @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
    window.openModal = function (modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function (modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

</script>

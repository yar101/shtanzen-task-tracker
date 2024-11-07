<tr {{ $attributes->merge(['class' => "border-b border-b-neutral-500/70 " . ($task->isParent() ? 'bg-neutral-100' : 'bg-neutral-300/20')]) }}>

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

    <td class="flex gap-1 justify-center items-center m-5 mr-1 ml-1">
        <button class="bg-blue-100 text-white rounded-md p-1 hover:bg-blue-200 h-8 w-8"
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


        <a href="{{ route('task.edit', $task->id) }}"
           class="bg-[#ffde70] p-1 rounded-md h-8 w-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="#000" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-9.193 9.193a4.5 4.5 0 01-1.591 1.035l-3.372 1.124a.75.75 0 01-.949-.949l1.124-3.372a4.5 4.5 0 011.035-1.591l9.193-9.193z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6.75L15 2.25"/>
            </svg>
        </a>

        <button
            class="border border-green-500/50 bg-green-500/20 p-1 rounded-md h-8 w-8"
            onclick="openCreateTaskModal('create-task-form', '{{ $task->id }}')">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M3 5.25C3 4.00736 4.00736 3 5.25 3H18.75C19.9926 3 21 4.00736 21 5.25V12.0218C20.5368 11.7253 20.0335 11.4858 19.5 11.3135V5.25C19.5 4.83579 19.1642 4.5 18.75 4.5H5.25C4.83579 4.5 4.5 4.83579 4.5 5.25V18.75C4.5 19.1642 4.83579 19.5 5.25 19.5H11.3135C11.4858 20.0335 11.7253 20.5368 12.0218 21H5.25C4.00736 21 3 19.9926 3 18.75V5.25Z"
                        fill="#212121"></path>
                    <path
                        d="M10.7803 7.71967C11.0732 8.01256 11.0732 8.48744 10.7803 8.78033L8.78033 10.7803C8.48744 11.0732 8.01256 11.0732 7.71967 10.7803L6.71967 9.78033C6.42678 9.48744 6.42678 9.01256 6.71967 8.71967C7.01256 8.42678 7.48744 8.42678 7.78033 8.71967L8.25 9.18934L9.71967 7.71967C10.0126 7.42678 10.4874 7.42678 10.7803 7.71967Z"
                        fill="#212121"></path>
                    <path
                        d="M10.7803 13.2197C11.0732 13.5126 11.0732 13.9874 10.7803 14.2803L8.78033 16.2803C8.48744 16.5732 8.01256 16.5732 7.71967 16.2803L6.71967 15.2803C6.42678 14.9874 6.42678 14.5126 6.71967 14.2197C7.01256 13.9268 7.48744 13.9268 7.78033 14.2197L8.25 14.6893L9.71967 13.2197C10.0126 12.9268 10.4874 12.9268 10.7803 13.2197Z"
                        fill="#212121"></path>
                    <path
                        d="M17.5 12C20.5376 12 23 14.4624 23 17.5C23 20.5376 20.5376 23 17.5 23C14.4624 23 12 20.5376 12 17.5C12 14.4624 14.4624 12 17.5 12ZM18.0011 20.5035L18.0006 18H20.503C20.7792 18 21.003 17.7762 21.003 17.5C21.003 17.2239 20.7792 17 20.503 17H18.0005L18 14.4993C18 14.2231 17.7761 13.9993 17.5 13.9993C17.2239 13.9993 17 14.2231 17 14.4993L17.0005 17H14.4961C14.22 17 13.9961 17.2239 13.9961 17.5C13.9961 17.7762 14.22 18 14.4961 18H17.0006L17.0011 20.5035C17.0011 20.7797 17.225 21.0035 17.5011 21.0035C17.7773 21.0035 18.0011 20.7797 18.0011 20.5035Z"
                        fill="#212121"></path>
                    <path
                        d="M13.25 8.5C12.8358 8.5 12.5 8.83579 12.5 9.25C12.5 9.66421 12.8358 10 13.25 10H16.75C17.1642 10 17.5 9.66421 17.5 9.25C17.5 8.83579 17.1642 8.5 16.75 8.5H13.25Z"
                        fill="#212121"></path>
                </g>
            </svg>
        </button>

        @if ($task->locked_by && $task->locked_by != auth()->user()->id)
            <a href="{{ route('task.edit', $task->id) }}"
               class="lock-icon border border-red-500/50 bg-red-500/20 p-1 rounded-md h-8 w-8"
               data-task-id="{{ $task->id }}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g
                        id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier"
                       stroke-linecap="round"
                       stroke-linejoin="round"></g>
                    <g
                        id="SVGRepo_iconCarrier">
                        <path
                            d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                            stroke="#E6484F" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
            </a>
        @endif
    </td>
</tr>
<x-comments.create-form :task="$task"/>

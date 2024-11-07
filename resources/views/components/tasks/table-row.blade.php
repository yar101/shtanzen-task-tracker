<tr {{ $attributes->merge(['class' => "text-gray-950 " . ($task->isParent() ? 'bg-neutral-100' : 'bg-neutral-300')]) }}>

    <th scope="row" class="task-status font-bold whitespace-nowrap text-center
                {{
                    match ($task->status->name) {
                        'NOT STARTED' => 'bg-gray-500/20',
                        'ONGOING' => 'bg-blue-500/20',
                        'ON HOLD' => 'bg-yellow-500/20',
                        'DELAY' => 'bg-red-700/20',
                        'DONE' => 'bg-green-500/20',
                        }
                }}
                ">
        <form action="{{ route('task.status-update', $task->id) }}" method="post" class="w-[100px]">
            @csrf
            @method('PATCH')
            <select name="status_id" onchange="this.form.submit()" class="p-2 bg-transparent cursor-pointer
                        {{
                            match ($task->status->name) {
                                'NOT STARTED' => 'text-neutral-500',
                                'ONGOING' => 'text-blue-600',
                                'ON HOLD' => 'text-yellow-700',
                                'DELAY' => 'text-red-500',
                                'DONE' => 'text-green-700',
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
    <td class="px-2 py-2 text-center w-[30px]
                {{
                    match ($task->priority) {
                        'I' => 'bg-red-500/40 text-red-900',
                        'II' => 'bg-yellow-500/40 text-yellow-900',
                        'III' => 'bg-green-500/40 text-green-900',
                        }
 }}
                ">
        {{ $task->priority }}
    </td>
    <td class="px-2 py-2 text-center">
        {{ $task->contractor->name }}
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

    <td class="flex gap-1.5 justify-center items-center m-5 mr-2 ml-1">

        <button
            class="bg-blue-100 text-white rounded-md border border-blue-600/50 transition-all hover:translate-y-[-2px] p-1 hover:bg-blue-200 h-9 w-9"
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
           class="bg-amber-100 hover:bg-amber-200 border border-amber-600/50 p-1 transition-all hover:translate-y-[-2px] rounded-md h-9 w-9">

            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M7.5 2.75C7.5 2.33579 7.16421 2 6.75 2C6.33579 2 6 2.33579 6 2.75V5.75C6 6.60889 6.61875 7.32327 7.43481 7.47169L6.34113 10.4403C6.08209 11.1434 6.12117 11.9217 6.44935 12.5954L10.6068 21.129C10.8664 21.6619 11.4072 22 12 22C12.5927 22 13.1336 21.6619 13.3932 21.129L17.5034 12.6923C17.8691 11.9415 17.8739 11.0653 17.5165 10.3106L16.1851 7.5H16.25C17.2165 7.5 18 6.7165 18 5.75V2.75C18 2.33579 17.6642 2 17.25 2C16.8358 2 16.5 2.33579 16.5 2.75V5.75C16.5 5.88807 16.3881 6 16.25 6H7.75C7.61193 6 7.5 5.88807 7.5 5.75V2.75ZM14.5254 7.5L16.1609 10.9527C16.3234 11.2958 16.3212 11.6941 16.1549 12.0353L12.75 19.0243V12.2993C13.1984 12.04 13.5 11.5552 13.5 11C13.5 10.1716 12.8284 9.5 12 9.5C11.1716 9.5 10.5 10.1716 10.5 11C10.5 11.5552 10.8016 12.04 11.25 12.2993V19.0244L7.79783 11.9384C7.64866 11.6322 7.6309 11.2784 7.74864 10.9588L9.02294 7.5H14.5254Z"
                        fill="#e5a50a"></path>
                </g>
            </svg>
        </a>

        <button
            class="border border-green-500/50 bg-green-100 hover:bg-green-200 transition-all p-1 hover:translate-y-[-2px] rounded-md h-9 w-9"
            onclick="openCreateTaskModal('create-task-form', '{{ $task->id }}')">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M3 5.25C3 4.00736 4.00736 3 5.25 3H18.75C19.9926 3 21 4.00736 21 5.25V12.0218C20.5368 11.7253 20.0335 11.4858 19.5 11.3135V5.25C19.5 4.83579 19.1642 4.5 18.75 4.5H5.25C4.83579 4.5 4.5 4.83579 4.5 5.25V18.75C4.5 19.1642 4.83579 19.5 5.25 19.5H11.3135C11.4858 20.0335 11.7253 20.5368 12.0218 21H5.25C4.00736 21 3 19.9926 3 18.75V5.25Z"
                        fill="#067734"></path>
                    <path
                        d="M10.7803 7.71967C11.0732 8.01256 11.0732 8.48744 10.7803 8.78033L8.78033 10.7803C8.48744 11.0732 8.01256 11.0732 7.71967 10.7803L6.71967 9.78033C6.42678 9.48744 6.42678 9.01256 6.71967 8.71967C7.01256 8.42678 7.48744 8.42678 7.78033 8.71967L8.25 9.18934L9.71967 7.71967C10.0126 7.42678 10.4874 7.42678 10.7803 7.71967Z"
                        fill="#067734"></path>
                    <path
                        d="M10.7803 13.2197C11.0732 13.5126 11.0732 13.9874 10.7803 14.2803L8.78033 16.2803C8.48744 16.5732 8.01256 16.5732 7.71967 16.2803L6.71967 15.2803C6.42678 14.9874 6.42678 14.5126 6.71967 14.2197C7.01256 13.9268 7.48744 13.9268 7.78033 14.2197L8.25 14.6893L9.71967 13.2197C10.0126 12.9268 10.4874 12.9268 10.7803 13.2197Z"
                        fill="#067734"></path>
                    <path
                        d="M17.5 12C20.5376 12 23 14.4624 23 17.5C23 20.5376 20.5376 23 17.5 23C14.4624 23 12 20.5376 12 17.5C12 14.4624 14.4624 12 17.5 12ZM18.0011 20.5035L18.0006 18H20.503C20.7792 18 21.003 17.7762 21.003 17.5C21.003 17.2239 20.7792 17 20.503 17H18.0005L18 14.4993C18 14.2231 17.7761 13.9993 17.5 13.9993C17.2239 13.9993 17 14.2231 17 14.4993L17.0005 17H14.4961C14.22 17 13.9961 17.2239 13.9961 17.5C13.9961 17.7762 14.22 18 14.4961 18H17.0006L17.0011 20.5035C17.0011 20.7797 17.225 21.0035 17.5011 21.0035C17.7773 21.0035 18.0011 20.7797 18.0011 20.5035Z"
                        fill="#067734"></path>
                    <path
                        d="M13.25 8.5C12.8358 8.5 12.5 8.83579 12.5 9.25C12.5 9.66421 12.8358 10 13.25 10H16.75C17.1642 10 17.5 9.66421 17.5 9.25C17.5 8.83579 17.1642 8.5 16.75 8.5H13.25Z"
                        fill="#067734"></path>
                </g>
            </svg>
        </button>

        @if ($task->locked_by && $task->locked_by != auth()->user()->id)
            <a href="{{ route('task.edit', $task->id) }}"
               class="lock-icon border border-red-500/50 bg-red-100 hover:bg-red-200 hover:translate-y-[-2px] transition-all p-1 rounded-md h-9 w-9"
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

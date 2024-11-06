<div id="modelConfirm-{{ $task->id }}" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
    <div class="relative top-40 mx-auto shadow-xl rounded-md bg-gray-100 max-w-5xl">

        <div class="flex justify-end p-2">
            <button onclick="closeModal('modelConfirm-{{ $task->id }}')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div class="p-6 pt-0 w-full text-center">
{{--            <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"--}}
{{--                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
{{--            </svg>--}}
            <div class="w-full">
                <div class="w-full max-w-5xl bg-gray-100 rounded-2xl p-6 space-y-6">
                    <!-- Chat header -->
                    <div class="flex items-center space-x-4">
                        <div class="w-full p-1 flex items-center justify-center">
                            <span class="text-xl font-semibold text-gray-700">{{ $task->title }}</span>
                        </div>
{{--                        <h1 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h1>--}}
                    </div>

                    <!-- Chat messages area -->
                    <div class="h-96 overflow-y-auto neo-inset p-4 rounded-xl space-y-4">
                        <!-- Received message -->
                        @foreach($task->comments->sortBy('created_at') as $comment)
                            @if ($comment->created_by != auth()->user()->id)
                                <div class="flex flex-col gap-1 items-start space-x-2">
                                    <div class="w-fit p-2 flex-shrink-0 flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-800">{{ \App\Models\User::find($comment->created_by)->name  }}</span>
                                    </div>
                                    <div class="bg-gray-200 p-3 rounded-lg neo-shadow max-w-xl flex flex-col gap-2">
                                        <span class="text-sm text-gray-500 text-end">{{ $comment->created_at->format('d.m.Y') }}</span>
                                        <p class="text-md text-gray-700">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Sent message -->
                            @if ($comment->created_by == auth()->user()->id)
                                <div class="flex items-end justify-end space-x-2">
                                    <div class="bg-blue-200/50 p-3 rounded-lg neo-shadow max-w-xl flex flex-col gap-2">
                                        <span class="text-sm text-gray-500 text-end">{{ $comment->created_at->format('d.m.Y') }}</span>
                                        <p class="text-md text-gray-700">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Message input area -->
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <div class="flex-grow">
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <input type="text" name="content" placeholder="Введите комментарий..."
                                       class="w-full p-4 rounded-xl neo-inset bg-transparent text-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none">
                            </div>
                            <button type="submit" class="p-4 rounded-xl neo-shadow neo-button focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-sm text-red-600 flex justify-start">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-600">
                                        # {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
{{--            <a href="#"  onclick="closeModal('modelConfirm')"--}}
{{--               class="text-white bg-blue-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">--}}
{{--                Отправить--}}
{{--            </a>--}}
{{--            <a href="#" onclick="closeModal('modelConfirm')"--}}
{{--               class="text-gray-900 border border-red-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center"--}}
{{--               data-modal-toggle="delete-user-modal">--}}
{{--                Отменить--}}
{{--            </a>--}}
        </div>

    </div>
</div>

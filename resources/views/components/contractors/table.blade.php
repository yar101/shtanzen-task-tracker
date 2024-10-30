<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-md text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-4 py-4 text-center">
                Наименование
            </th>

            {{--            <th scope="col" class="px-3 py-4 text-center">--}}
            {{--            </th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($contractors as $contractor)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="contractor-status px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                    {{ $contractor->name }}
                </th>

                {{--                <td class="px-4 py-4">--}}
                {{--                    <button id="contractor-{{contractor->id}}}-action-button" class="flex flex-col gap-1">--}}
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

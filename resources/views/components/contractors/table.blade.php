<div class="relative overflow-x-auto shadow-xl">
    <table class="w-full text-md text-gray-800">
        <thead class="text-xs text-gray-700 uppercase bg-blue-200 border-b border-s border-e border-t border-b-blue-400/50 border-gray-500/50">
        <tr>
            <th scope="col" class="px-2 py-2 text-center">
                Наименование контрагента
            </th>

            {{--            <th scope="col" class="px-3 py-4 text-center">--}}
            {{--            </th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($contractors as $contractor)
            <tr class="bg-neutral-300 border-b border-s border-e border-gray-500/50">
                <th scope="row" class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap text-center">
                    {{ $contractor->name }}
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

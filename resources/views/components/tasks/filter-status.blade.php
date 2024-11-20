<div id="filter_status_wrapper" class="flex items-center flex-col gap-2">
    <div id="filter_status_button"
         class="shadow-md bg-neutral-300 text-gray-600 border border-gray-500/50 p-1 rounded-md focus:outline-none cursor-pointer select-none">
        Статусы
    </div>
    <div id="statuses_list" class="hidden flex items-center absolute z-10 mt-10 gap-2 bg-amber-100 border shadow-md border-amber-400/50 p-1 rounded-md">
        <ul>
            @foreach($statuses as $status)
                <li>
                    <label class="flex items-center justify-between gap-2 px-1 hover:bg-blue-200 transition-colors cursor-pointer select-none">
                        {{ $status->name }}
                        <input type="checkbox" value="{{ $status->id }}" name="filter-statuses[]" {{ in_array($status->id, request('filter-statuses')) ? 'checked' : '' }}>
                    </label>
                </li>
            @endforeach
            <li>
            </li>
        </ul>
    </div>
</div>

<script>
    const filterStatusButton = document.getElementById('filter_status_button');
    const statusesList = document.getElementById('statuses_list');

    filterStatusButton.addEventListener('click', () => {
        statusesList.classList.toggle('hidden');
        filterStatusButton.classList.toggle('bg-amber-200');
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('#filter_status_wrapper')) {
            statusesList.classList.add('hidden');
            filterStatusButton.classList.remove('bg-amber-200');
        }
    });
</script>

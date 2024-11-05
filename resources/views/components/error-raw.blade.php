@props([
    'field' => 'name',
])

<span class="text-sm text-red-600 font-semibold">
    @error($field) <span>{{ $message }}</span>  @enderror
</span>

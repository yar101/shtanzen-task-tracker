@props([
    'active' => false,
])

<div class="">
    <a class="{{ $active ? 'text-blue-300' : 'text-neutral-400' }} cursor-pointer hover:underline hover:text-blue-300" {{$attributes}}>{{ $slot }}</a>
</div>

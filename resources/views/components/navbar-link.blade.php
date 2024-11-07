@props([
    'active' => false,
])

<div class="">
    <a class="{{ $active ? 'text-black underline' : 'text-neutral-600' }} cursor-pointer hover:underline hover:text-neutral-800" {{$attributes}}>{{ $slot }}</a>
</div>

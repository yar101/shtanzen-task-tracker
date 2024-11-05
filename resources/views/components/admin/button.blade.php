<button {{ $attributes->merge(['class' => 'p-1 px-6 shadow-md bg-amber-300 rounded-md text-gray-800 hover:bg-amber-400 transition-colors']) }}>
    {{ $slot }}
</button>

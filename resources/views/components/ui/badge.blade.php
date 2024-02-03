@props([
    'background' => 'bg-blue-600',
    'color' => 'text-white',
])


<span
    {{ $attributes->merge(['class' => $background . ' ' . $color . 'relative inline-flex items-center text-xs font-semibold pl-2 pr-2.5 py-1 rounded-full']) }}>
    {{ $slot }}
</span>

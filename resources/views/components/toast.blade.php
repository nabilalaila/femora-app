@props([
    'message',
    'type' => 'success' // success, error, warning, info
])

@php
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'warning' => 'yellow',
        'info' => 'blue',
    ];
    $color = $colors[$type] ?? 'gray';
@endphp

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition
    class="fixed top-5 right-5 bg-{{ $color }}-500 text-white px-4 py-2 rounded shadow z-50"
>
    {{ $message }}
</div>

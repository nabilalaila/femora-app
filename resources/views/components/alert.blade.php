@props([
    'type' => 'info',
    'message' => null,
])

@php
    $colors = [
        'success' => 'text-green-700 bg-green-100 border-green-400',
        'error' => 'text-red-700 bg-red-100 border-red-400',
        'warning' => 'text-yellow-700 bg-yellow-100 border-yellow-400',
        'info' => 'text-blue-700 bg-blue-100 border-blue-400',
    ];
    $icon = [
        'success' => '✔️',
        'error' => '❌',
        'warning' => '⚠️',
        'info' => 'ℹ️',
    ];
@endphp

<div id="toast-{{ $type }}" class="fixed top-5 right-5 z-50 p-4 rounded-lg shadow max-w-xs border {{ $colors[$type] ?? $colors['info'] }}">
    <div class="flex items-center">
        <span class="mr-2">{{ $icon[$type] ?? $icon['info'] }}</span>
        <div class="text-sm font-medium">{{ $message }}</div>
        <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-lg font-bold">&times;</button>
    </div>
</div>

<script>
    setTimeout(() => {
        const el = document.getElementById('toast-{{ $type }}');
        if (el) el.remove();
    }, 3000);
</script>

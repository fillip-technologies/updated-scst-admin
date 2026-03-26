@php
    $badgeClasses = match ($status) {
        'on_time' => 'bg-green-50 text-green-700',
        'delayed' => 'bg-yellow-50 text-yellow-700',
        'not_reported' => 'bg-red-50 text-red-700',
        default => 'bg-gray-50 text-gray-700',
    };
@endphp

<span class="rounded-full px-2 py-1 text-xs font-medium {{ $badgeClasses }}">
    {{ str_replace('_', ' ', ucfirst($status)) }}
</span>

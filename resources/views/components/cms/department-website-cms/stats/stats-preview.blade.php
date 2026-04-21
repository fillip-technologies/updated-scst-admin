@php
    $stats = [
        [
            'count' => '91',
            'label' => 'Residential Schools',
            'border' => 'border-orange-500',
            'badge' => 'bg-orange-100 text-orange-700',
        ],
        [
            'count' => '25,569',
            'label' => 'Students Enrolled',
            'border' => 'border-sky-500',
            'badge' => 'bg-sky-100 text-sky-700',
        ],
        [
            'count' => '201+',
            'label' => 'Teachers',
            'border' => 'border-emerald-500',
            'badge' => 'bg-emerald-100 text-emerald-700',
        ],
    ];
@endphp

<div class="rounded-2xl border border-primary-800/10 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Preview</h2>
            <p class="mt-1 text-sm text-gray-500">Department stats card appearance.</p>
        </div>
        <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Counters</span>
    </div>

    <div class="mt-6 space-y-4">
        @foreach ($stats as $stat)
            <div class="rounded-2xl border border-primary-800/10 border-l-4 {{ $stat['border'] }} bg-gray-50 p-5 shadow-sm">
                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] {{ $stat['badge'] }}">
                    Live
                </span>
                <p class="mt-4 text-3xl font-bold text-gray-900">{{ $stat['count'] }}</p>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">{{ $stat['label'] }}</p>
            </div>
        @endforeach
    </div>
</div>

@php
    $singledata = json_decode($data->state_section, true);
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

    <!-- Schools -->
    <div class="rounded-2xl border border-primary-800/10 border-l-4 border-green-500 bg-gray-50 p-5 shadow-sm">
        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] bg-green-100 text-green-700">
            Live
        </span>
        <p class="mt-4 text-3xl font-bold text-gray-900">
            {{ $singledata['schools_count'] ?? 0 }}
        </p>
        <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">
            {{ $singledata['schools_label'] ?? '' }}
        </p>
    </div>

    <!-- Students -->
    <div class="rounded-2xl border border-primary-800/10 border-l-4 border-blue-500 bg-gray-50 p-5 shadow-sm">
        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] bg-blue-100 text-blue-700">
            Live
        </span>
        <p class="mt-4 text-3xl font-bold text-gray-900">
            {{ $singledata['students_count'] ?? 0 }}
        </p>
        <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">
            {{ $singledata['students_label'] ?? '' }}
        </p>
    </div>

    <!-- Teachers -->
    <div class="rounded-2xl border border-primary-800/10 border-l-4 border-orange-500 bg-gray-50 p-5 shadow-sm">
        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] bg-orange-100 text-orange-700">
            Live
        </span>
        <p class="mt-4 text-3xl font-bold text-gray-900">
            {{ $singledata['teachers_count'] ?? 0 }}
        </p>
        <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">
            {{ $singledata['teachers_label'] ?? '' }}
        </p>
    </div>

</div>
</div>

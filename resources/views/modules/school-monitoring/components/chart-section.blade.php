<section class="bg-white border border-gray-200 rounded-lg p-4">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Reporting Visualization</h2>
            <p class="text-sm text-gray-600">Quick breakdown of reporting status across the current school set.</p>
        </div>

        <div class="grid gap-2 text-sm md:grid-cols-3">
            <div class="rounded-md bg-gray-50 px-3 py-2">
                <p class="text-gray-500">On Time</p>
                <p class="font-semibold text-gray-900">{{ $stats['reporting'] ?? 0 }}</p>
            </div>
            <div class="rounded-md bg-gray-50 px-3 py-2">
                <p class="text-gray-500">Delayed</p>
                <p class="font-semibold text-gray-900">{{ $stats['delayed'] ?? 0 }}</p>
            </div>
            <div class="rounded-md bg-gray-50 px-3 py-2">
                <p class="text-gray-500">Not Reported</p>
                <p class="font-semibold text-gray-900">{{ $stats['not_reported'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <canvas id="monitoringStatusChart" height="120"></canvas>
    </div>
</section>

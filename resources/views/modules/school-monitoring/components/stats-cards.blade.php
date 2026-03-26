<section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <p class="text-sm text-gray-500">Total Schools</p>
        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $stats['schools'] ?? 0 }}</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <p class="text-sm text-gray-500">Reporting On Time</p>
        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $stats['reporting'] ?? 0 }}</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <p class="text-sm text-gray-500">Dropout Total</p>
        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $stats['dropout'] ?? 0 }}</p>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <p class="text-sm text-gray-500">Average Pass %</p>
        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $stats['pass_percentage'] ?? 0 }}%</p>
    </div>
</section>

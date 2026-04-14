<section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
    <div class="bg-white border border-gray-200 rounded-lg p-4 w-full">
        <p class="text-sm text-gray-500">Total Schools</p>
        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ App\Models\School::count() }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <p class="text-sm text-gray-500">Reporting On Time</p>
        <p class="mt-2 text-2xl font-semibold text-gray-900">{{ App\Models\Report::count() }}</p>
    </div>
</section>


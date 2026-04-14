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

<section class="bg-white border border-gray-200 rounded-lg p-4 space-y-4">
    <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">School Monitoring &amp; Management</h1>
            <p class="text-sm text-gray-600">Monitoring, school visibility, and administrative actions in one page.</p>
        </div>

        @if (session('success'))
            <div class="text-sm text-green-700 bg-green-50 border border-green-200 rounded-md px-3 py-2">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <form method="GET" action="{{ route('filterMonotering') }}" class="space-y-4">
        @include('modules.school-monitoring.components.filter-panel')
    </form>
</section>

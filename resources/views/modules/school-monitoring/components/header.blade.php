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

    <form method="GET" action="{{ route('school.monitoring') }}" data-monitoring-filters class="space-y-4">
        <div class="grid gap-3 md:grid-cols-2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search school by name or district"
                class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"
                data-filter-search>

            <div class="flex items-center gap-2">
                <button type="submit" class="rounded-md border border-gray-300 px-4 py-2 text-sm">
                    Apply Search
                </button>
                <button type="button" class="rounded-md border border-gray-300 px-4 py-2 text-sm" data-clear-filters>
                    Reset
                </button>
            </div>
        </div>

        @include('modules.school-monitoring.components.filter-panel')
    </form>
</section>

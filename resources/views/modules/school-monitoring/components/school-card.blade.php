<article
    class="bg-white border border-gray-200 rounded-lg p-4 space-y-4"
    data-school-card
    {{-- data-school='@json($school)'> --}}
    <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
        <div>
            <div class="flex items-center gap-2">
                <h3 class="text-base font-semibold text-gray-900">{{ $school['name'] }}</h3>
                @include('modules.school-monitoring.partials.badge', ['status' => $school['reporting_status']])
            </div>
            <p class="text-sm text-gray-600">{{ $school['district'] }}</p>
        </div>

        <div class="flex items-center gap-2 text-sm text-gray-600">
            @include('modules.school-monitoring.partials.status-dot', ['status' => $school['reporting_status']])
            <span>{{ str_replace('_', ' ', ucfirst($school['reporting_status'])) }}</span>
        </div>
    </div>

    <div class="grid gap-3 text-sm md:grid-cols-2 xl:grid-cols-4">
        <div><span class="text-gray-500">Students:</span> {{ $school['students_count'] }}</div>
        <div><span class="text-gray-500">Teachers:</span> {{ $school['teachers_count'] }}</div>
        <div><span class="text-gray-500">Dropout:</span> {{ $school['dropout_count'] }}</div>
        <div><span class="text-gray-500">Pass %:</span> {{ $school['pass_percentage'] }}%</div>
        {{-- <div><span class="text-gray-500">Reporting time:</span> {{ $school['last_report_time'] }}</div>
        <div><span class="text-gray-500">Issues:</span> {{ $school['issues_count'] }}</div> --}}
    </div>

    <div class="flex items-center gap-2">
        <button type="button" class="rounded-md border border-gray-300 px-4 py-2 text-sm" data-view-details>
            View Details
        </button>
        <button type="button" class="rounded-md border border-gray-300 px-4 py-2 text-sm" data-school-action>
            Action
        </button>
    </div>
</article>

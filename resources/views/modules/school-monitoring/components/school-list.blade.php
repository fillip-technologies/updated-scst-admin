<section class="space-y-4">
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900">School List</h2>
        <p class="text-sm text-gray-500">
            <span data-visible-count>{{ count($schools) }}</span> schools visible
        </p>
    </div>

    <div class="grid gap-4" data-school-list>
        @foreach ($schools as $school)
            @include('modules.school-monitoring.components.school-card', ['school' => $school])
        @endforeach
    </div>

    <div class="@if (count($schools) > 0) hidden @endif bg-white border border-gray-200 rounded-lg p-4 text-sm text-gray-600" data-empty-state>
        No schools match the current filters.
    </div>
</section>

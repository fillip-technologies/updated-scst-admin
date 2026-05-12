<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-100 pb-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Report Output</h2>
            <p class="mt-1 text-sm text-slate-500">Mission Aspire status by selected district, school, and pillar.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-500">
            <span class="rounded-full bg-slate-100 px-3 py-1.5" data-selected-district>
                District: {{ $filters['district'] ?? 'Not selected' }}
            </span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5" data-selected-school>School: Not selected</span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5" data-selected-mission>Mission: Not selected</span>
        </div>
    </div>

    <div class="mt-6" data-report-table>
        @include('modules.missionaspire.partials.report-table', [
            'reports' => $reports,
            'selectedMission' => $filters['mission_aspire'] ?? null,
        ])
    </div>
</section>

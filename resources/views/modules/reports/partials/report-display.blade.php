<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-100 pb-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Report Output</h2>
            <p class="mt-1 text-sm text-slate-500">
                <template x-if="selectedReportLabel">
                    <span x-text="selectedReportLabel + ' report selected'"></span>
                </template>
                <template x-if="!selectedReportLabel">
                    <span>Please select filters and report</span>
                </template>
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-500">
            <span class="rounded-full bg-slate-100 px-3 py-1.5" x-text="filters.district ? 'District: ' + prettify(filters.district) : 'District: Not selected'"></span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5" x-text="selectedSchoolLabel()"></span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5" x-text="selectedReportLabel ? 'Report: ' + selectedReportLabel : 'Report: Not selected'"></span>
        </div>
    </div>

    <div class="mt-6">
        @include('modules.reports.partials.loader')

        <div x-show="!isLoading && !hasLoaded" x-cloak class="flex min-h-[320px] flex-col items-center justify-center rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-6 text-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">
                <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <h3 class="mt-4 text-lg font-semibold text-slate-900">Please select filters and report</h3>
            <p class="mt-2 max-w-lg text-sm text-slate-500">
                Choose a district, school, and report from the library to preview district monitoring data here.
            </p>
        </div>

        <div x-show="!isLoading && hasLoaded" x-cloak class="space-y-5">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-2xl bg-emerald-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Completion</p>
                    <p class="mt-2 text-2xl font-semibold text-emerald-900">94%</p>
                </div>
                <div class="rounded-2xl bg-amber-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Flagged Issues</p>
                    <p class="mt-2 text-2xl font-semibold text-amber-900">06</p>
                </div>
                <div class="rounded-2xl bg-sky-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-700">Last Sync</p>
                    <p class="mt-2 text-2xl font-semibold text-sky-900">Today</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">District</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">School</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Report Type</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Status</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Updated On</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <template x-for="(row, index) in tableRows" :key="index">
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4 text-slate-700" x-text="row.district"></td>
                                    <td class="px-5 py-4 text-slate-700" x-text="row.school"></td>
                                    <td class="px-5 py-4 text-slate-700" x-text="row.report_type"></td>
                                    <td class="px-5 py-4">
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700" x-text="row.status"></span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-500" x-text="row.updated_on"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

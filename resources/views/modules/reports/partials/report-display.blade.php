

<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-100 pb-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Report Output</h2>
        </div>

        <div class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-500">
            <span class="rounded-full bg-slate-100 px-3 py-1.5"
                x-text="filters.district ? 'District: ' + prettify(filters.district) : 'District: Not selected'"></span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5" x-text="selectedSchoolLabel()"></span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5"
                x-text="selectedCategory ? 'Category: ' + prettify(selectedCategory) : 'Category: Not selected'"></span>
            <span class="rounded-full bg-slate-100 px-3 py-1.5"
                x-text="selectedReport ? 'Report: ' + prettify(selectedReport) : 'Report: Not selected'"></span>
        </div>
    </div>

    <div class="mt-6">
        <div class="space-y-5">
            <div class="overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">District</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">School</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Report Type</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Report Category</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">

                            @forelse ($reports as $studentReport)
                                <tr>
                                    <td class="px-5 py-4 text-slate-700">
                                        {{ $studentReport->district }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ optional($studentReport->school)->school_name ?? 'N/A' }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ $studentReport->report_type }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ Str::ucfirst($studentReport->report_category) }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ asset($studentReport->report_img) }}" target="_blank"
                                                class="inline-flex items-center px-3 py-1 rounded-md bg-green-50 text-green-700 border border-green-200 text-xs font-medium hover:bg-green-100 transition">
                                                ViewReport
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-slate-500">
                                        No reports found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-5">
        <h3 class="text-xl font-semibold text-slate-900">
            Infrastructure Report Output
        </h3>
        <p class="text-sm text-slate-500">
            View and manage infrastructure details
        </p>
    </div>
    <div class="mt-6">
        <div class="space-y-5">
            <div class="overflow-hidden rounded-3xl border border-slate-200 shadow-sm">

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">

                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">District</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">School</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Toilet</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Electricity</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Drinking Water</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Building Safety</th>
                                <th class="px-5 py-4 text-left font-semibold text-slate-600">Network</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">

                            @foreach ($infrReports as $infrReport)
                             <tr class="hover:bg-slate-50 transition">

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ $infrReport->district ?? 'N/A' }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ optional($infrReport->school)->school_name ?? 'N/A' }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ $infrReport->toilet ?? '0' }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                        {{ $infrReport->electricity == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $infrReport->electricity ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                        {{ $infrReport->drinking_water == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $infrReport->drinking_water ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                        {{ $infrReport->building_safety == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $infrReport->building_safety ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full
                                        {{ $infrReport->network_availability == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $infrReport->network_availability ?? 'N/A' }}
                                        </span>
                                    </td>

                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

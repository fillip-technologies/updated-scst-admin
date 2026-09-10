
<div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 border-b border-slate-100 pb-4 lg:flex-row lg:items-center lg:justify-between">
        {{-- <div>
            <h2 class="text-xl font-semibold text-slate-900">Report Output</h2>
        </div> --}}

        <div class="flex flex-wrap gap-3 mt-4">

            <!-- District -->
            <div
                class="flex items-center gap-2 rounded-full bg-blue-50 border border-blue-200 px-4 py-2 text-sm font-medium text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>{{ request('district') ? 'District : ' . request('district') : 'District Not Selected' }}</span>
            </div>

            <!-- School -->
            <div
                class="flex items-center gap-2 rounded-full bg-emerald-50 border border-emerald-200 px-4 py-2 text-sm font-medium text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422A12.083 12.083 0 0120 17.5c0 1.657-3.582 3-8 3s-8-1.343-8-3a12.083 12.083 0 011.84-6.922L12 14z" />
                </svg>
                <span>{{ request('school_id') ? 'School Name : ' . App\Models\School::where('id', request('school_id'))->select('school_name')->value('school_name') : 'School Not Selected' }}</span>
            </div>

            <!-- Category -->
            <div
                class="flex items-center gap-2 rounded-full bg-amber-50 border border-amber-200 px-4 py-2 text-sm font-medium text-amber-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6" />
                </svg>
                <span>{{ request('report_category') ? request('report_category') : 'Category Not Selected' }}</span>
            </div>

            <!-- Report -->
            <div
                class="flex items-center gap-2 rounded-full bg-purple-50 border border-purple-200 px-4 py-2 text-sm font-medium text-purple-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6h6v6m-8 4h10a2 2 0 002-2V7.828a2 2 0 00-.586-1.414l-3.828-3.828A2 2 0 0013.172 2H7a2 2 0 00-2 2v15a2 2 0 002 2z" />
                </svg>
                <span>{{ request('report_type') ? request('report_type') : 'Report Not Selected' }}</span>
            </div>

        </div>
    </div>
    @if ($category == 'infrastructure')

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
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Date</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Electricity</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Drinking Water</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Building Safety</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Network</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">

                                @forelse ($reports ?? [] as $infrReport)
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
                                @empty
                                      <div class="flex justify-center items-center">
                                        <div>Not Found Data !</div>
                                    </div>
                                @endforelse



                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    @elseif($category == 'academic')
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
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Date</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Report Category</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Action</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">

                                @forelse ($reports ?? [] as $studentReport)
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
                                            {{ $studentReport->date }}
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
                                    <div class="flex justify-center items-center">
                                        <div>Not Found Data !</div>
                                    </div>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
       @elseif(!empty(request('district')))
        <div class="mt-6">
            <div class="space-y-5">
                <div class="overflow-hidden rounded-3xl border border-slate-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">School Name</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Student Attendance</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Student Marks</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Teacher Attendance</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Meal Attendance</th>
                                    <th class="px-5 py-4 text-left font-semibold text-slate-600">Infrastructure</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 bg-white">

                                @forelse ($reports ?? [] as $studentReport)
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
                                            {{ $studentReport->date }}
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
                                    <div class="flex justify-center items-center">
                                        <div>Not Found Data !</div>
                                    </div>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
   @else

 <div class="flex justify-center items-center p-5 font-bold text-blue-50">
    <div> If You Want to show report you will be apply filters</div>
 </div>
@endif
</div>

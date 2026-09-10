@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Teacher Attendance Monitoring</h1>
                <p class="text-sm text-gray-500 mt-1">View and monitor daily teacher attendance records across all SC/ST
                    welfare schools.</p>
            </div>
        </div>


        <!-- Filter and Search Header -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 sm:p-5">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <!-- Search & Actions -->
                <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <div class="relative w-full sm:w-80">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </span>
                        <input type="text" placeholder="Search school name, teacher name..."
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-300 bg-gray-50 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:bg-white transition">
                    </div>

                    <button type="button"
                        class="w-full sm:w-auto px-5 py-2.5 bg-primary-700 hover:bg-primary-800 text-white rounded-xl text-sm font-medium transition shadow-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        Search
                    </button>
                </div>

                <!-- Filters Right Side -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                    <select
                        class="px-4 py-2.5 rounded-xl border border-gray-300 bg-gray-50 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:bg-white transition w-full lg:w-48">
                        <option value="">All Statuses</option>
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                        <option value="leave">On Leave</option>
                    </select>

                    <select
                        class="px-4 py-2.5 rounded-xl border border-gray-300 bg-gray-50 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:bg-white transition w-full lg:w-48">
                        <option value="">All Leave Types</option>
                        <option value="sick">Sick Leave</option>
                        <option value="casual">Casual Leave</option>
                        <option value="unpaid">Unpaid Leave</option>
                        <option value="none">No Leave</option>
                    </select>

                    <button type="button"
                        class="text-sm font-medium text-gray-500 hover:text-primary-700 transition px-4 py-2.5 rounded-xl border border-gray-300 hover:border-primary-700 whitespace-nowrap bg-white text-center">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Attendance Table Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead
                        class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs tracking-wider font-semibold">
                        <tr>
                            <th class="px-6 py-4 text-left">S.No</th>
                            <th class="px-6 py-4 text-left">School Name</th>
                            <th class="px-6 py-4 text-left">Teacher Name</th>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Leave Type</th>
                            <th class="px-6 py-4 text-left">Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse ($reports as $key => $items)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $reports->firstItem() + $key }}
                                </td>

                                <!-- School -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $items->school->school_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $items->school->district ?? 'N/A' }}
                                    </div>
                                </td>

                                <!-- Teacher -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $items->teacher->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $items->teacher->designation ?? 'N/A' }}
                                    </div>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($items->date)->format('d M, Y') }}
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if (($items->status ?? '') == 'Present')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Present
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Absent
                                        </span>
                                    @endif
                                </td>

                                <!-- Leave -->
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $items->leave_type ?? '-' }}
                                </td>

                                <!-- Remark -->
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $items->remarks ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    No records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex items-center justify-between">
                <div class="text-xs text-gray-500 font-medium">
                </div>
                <div class="flex items-center gap-2">
                   {{ $reports->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

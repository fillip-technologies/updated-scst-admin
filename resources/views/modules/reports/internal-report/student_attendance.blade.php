@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Student Attendance Monitoring</h1>
                <p class="text-sm text-gray-500 mt-1">View and monitor daily student attendance records across all SC/ST
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
                        <input type="text" placeholder="Search school name, roll number..."
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
                        <option value="late">Late</option>
                    </select>


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
                            <th class="px-6 py-4 text-left">Class</th>
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-left">Roll No</th>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-left">Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse ($reports as $key => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $reports->firstItem() + $key }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $item->school?->school_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $item->school?->district ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->allclass?->class ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->student->name ?? 'Aman' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs text-primary-700 bg-primary-50 px-2 py-1 rounded">
                                        {{ $item->student->roll_number ?? 'ST10054A' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold
                    {{ $item->status == 'Present'
                        ? 'bg-green-50 text-green-700 border border-green-200'
                        : 'bg-red-50 text-red-700 border border-red-200' }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full {{ $item->status == 'Present' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        {{ $item->status ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-gray-500">
                                    {{ $item->remarks ?? 'On Time' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-6 text-center text-gray-500">
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

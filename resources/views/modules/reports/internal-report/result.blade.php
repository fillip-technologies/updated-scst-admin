@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Student Results Monitoring</h1>
                <p class="text-sm text-gray-500 mt-1">Track, monitor, and audit academic results and term exams for SC/ST
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
                        <input type="text" placeholder="Search school name, student name..."
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
                        <option value="">All Terms</option>
                        <option value="half">Half Yearly</option>
                        <option value="third">Third Terminal</option>
                        <option value="final">Final</option>
                    </select>

                
                </div>
            </div>
        </div>

        <!-- Results Table Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead
                        class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs tracking-wider font-semibold">
                        <tr>
                            <th class="px-6 py-4 text-left">S.No</th>
                            <th class="px-6 py-4 text-left">School Name</th>
                            <th class="px-6 py-4 text-left">Student Name</th>
                            <th class="px-6 py-4 text-left">Class</th>
                            <th class="px-6 py-4 text-left">Term</th>
                            <th class="px-6 py-4 text-left">Subject</th>
                            <th class="px-6 py-4 text-left">Teacher</th>
                            <th class="px-6 py-4 text-left font-semibold">Marks</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-center">Report</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse ($reports as $key => $items)
                            <tr class="hover:bg-gray-50 transition">

                                <!-- S.No -->
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

                                <!-- Student -->
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $items->student->name ?? 'N/A' }}
                                </td>

                                <!-- Class -->
                                <td class="px-6 py-4">
                                    {{ $items->addclass->class ?? 'N/A' }}
                                </td>

                                <!-- Exam -->
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded bg-gray-100 border border-gray-200 text-gray-700 text-xs font-medium">
                                        {{ $items->term ?? 'N/A' }}
                                    </span>
                                </td>

                                <!-- Subject -->
                                <td class="px-6 py-4">
                                    {{ $items->subject->subjects ?? 'N/A' }}
                                </td>

                                <!-- Teacher -->
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $items->teacher->name ?? 'N/A' }}
                                </td>

                                <!-- Marks -->
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $items->marks ?? 0 }}
                                    <span class="text-xs text-gray-400 font-normal">
                                        / {{ $items->total_marks ?? 100 }}
                                    </span>
                                </td>

                                <!-- Result -->
                                <td class="px-6 py-4">
                                    @if (($items->marks ?? 0) >= 33)
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Pass
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Fail
                                        </span>
                                    @endif
                                </td>

                                <!-- PDF -->
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center">
                                        @if ($items->file)
                                            <a href="{{ asset($items->file) }}" target="_blank"
                                                class="px-3 py-1.5 bg-primary-50 hover:bg-primary-100 text-primary-700 rounded-lg text-xs font-semibold transition flex items-center gap-1.5">
                                                <i class="fa-solid fa-file-pdf"></i>
                                                View PDF
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center text-gray-500">
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

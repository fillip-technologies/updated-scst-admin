@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Meal Attendance Monitoring</h1>
                <p class="text-sm text-gray-500 mt-1">Track and monitor daily dining registers and mid-day meal reports
                    across SC/ST welfare school hostels.</p>
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
                        <input type="text" placeholder="Search school name..."
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-gray-300 bg-gray-50 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-700 focus:bg-white transition">
                    </div>

                    <button type="button"
                        class="w-full sm:w-auto px-5 py-2.5 bg-primary-700 hover:bg-primary-800 text-white rounded-xl text-sm font-medium transition shadow-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        Search
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
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Menu</th>
                            <th class="px-6 py-4 text-left">Report Category</th>
                            <th class="px-6 py-4 text-left">District</th>
                            <th class="px-6 py-4 text-center">Report Image</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse ($reports as $items)
                            <tr class="hover:bg-gray-50 transition">

                                <!-- Serial No -->
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $reports->firstItem() + $loop->index }}
                                </td>

                                <!-- School -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $items->school->school_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        School Code: {{ $items->school->school_code ?? 'N/A' }}
                                    </div>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($items->date)->format('d M, Y') }}
                                </td>

                                <!-- Menu -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $items->menu ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-green-600 font-semibold">
                                        {{ $items->report_type ?? '' }}
                                    </div>
                                </td>

                                <!-- Item -->
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">
                                        {{ $items->report_category ?? 'N/A' }}
                                    </div>
                                </td>

                                <!-- District -->
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $items->school->district ?? 'N/A' }}
                                </td>

                                <!-- Image -->
                                <td class="px-6 py-4 text-center">
                                    @if (!empty($items->report_img))
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ asset($items->report_img) }}" target="_blank"
                                                class="group relative block overflow-hidden rounded-lg border border-gray-200">
                                                <img src="{{ asset($items->report_img) }}" alt="Meal"
                                                    class="w-14 h-10 object-cover group-hover:scale-105 transition-transform duration-200">

                                                <div
                                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-200">
                                                    <i class="fa-solid fa-magnifying-glass-plus text-white text-xs"></i>
                                                </div>
                                            </a>

                                            <a href="{{ asset($items->report_img) }}" target="_blank"
                                                class="px-3 py-1.5 bg-primary-50 hover:bg-primary-100 text-primary-700 rounded-lg text-xs font-semibold transition flex items-center gap-1.5">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                View
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-gray-400">No Image</span>
                                    @endif
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

            <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex items-center justify-between">
                <div class="text-xs text-gray-500 font-medium">
                    Showing
                    <span class="text-gray-800">{{ $reports->firstItem() ?? 0 }}</span>
                    to
                    <span class="text-gray-800">{{ $reports->lastItem() ?? 0 }}</span>
                    of
                    <span class="text-gray-800">{{ $reports->total() }}</span>
                    records
                </div>

                <div class="flex items-center gap-2">
                    {{-- Previous Button --}}
                    @if ($reports->onFirstPage())
                        <span
                            class="px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-medium text-gray-400 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $reports->previousPageUrl() }}"
                            class="px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                            Previous
                        </a>
                    @endif

                    {{-- Page Number --}}
                    <span class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-medium">
                        {{ $reports->currentPage() }}
                    </span>

                    {{-- Next Button --}}
                    @if ($reports->hasMorePages())
                        <a href="{{ $reports->nextPageUrl() }}"
                            class="px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-medium text-gray-700 hover:bg-gray-50 transition">
                            Next
                        </a>
                    @else
                        <span
                            class="px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-medium text-gray-400 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

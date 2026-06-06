@extends('layouts.app')

@section('content')
    <div class="p-3 sm:p-4 lg:p-8 bg-gray-50 min-h-screen">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-8 h-8 rounded-lg bg-primary-900 flex items-center justify-center">
                        <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h1 class="text-lg sm:text-xl font-bold text-primary-900">Syllabus Tracking</h1>
                </div>
                <p class="text-sm text-gray-400 ml-10">Monitor syllabus progress across schools, classes & subjects</p>
            </div>
            <a href=""
                class="flex items-center gap-2 bg-primary-900 hover:bg-primary-800 text-white px-4 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-200 hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Tracking
            </a>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-6 h-6 rounded-md bg-primary-900/10 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-primary-900" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </div>
                <h2 class="text-sm font-semibold text-gray-700">Filters</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">School</label>
                    <select id="filterSchool"
                        class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                        <option value="">All District</option>
                        @foreach (getDisc() as $disc)
                            <option value="{{ $disc->district }}">{{ $disc->district }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- School -->

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">School</label>
                    <select id="filterSchool"
                        class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                        <option value="">All Schools</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Class</label>
                    <select id="filterClass"
                        class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                        <option value="">All Classes</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>

                    </select>
                </div>

                <!-- Subject -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Subject</label>
                    <select id="filterSubject"
                        class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                        <option value="">All Subjects</option>
                        @foreach (all_syllabus() as $items)
                            <option value="{{ $items }}">{{ $items }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 mt-5 pt-4 border-t border-gray-100">
                <button onclick="applyFilters()"
                    class="bg-primary-900 hover:bg-primary-800 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-200 hover:shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </button>
                <button onclick="resetFilters()"
                    class="bg-white hover:bg-gray-50 text-gray-600 px-6 py-2.5 rounded-xl text-sm font-medium transition border border-gray-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </button>
            </div>
        </div>

        <!-- Results Count -->
        <div class="mb-4" id="resultsCount" style="display:none;">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-primary-900"></div>
                <p class="text-sm text-gray-500">Showing <span id="countNumber" class="font-bold text-primary-900">0</span>
                    results</p>
            </div>
        </div>

        <!-- Cards Container -->


        @forelse ($tackingList as $items)
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-all">

                <!-- Header -->
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">
                            {{ $items->school->school_name ?? 'N/A' }}
                        </h3>
                        <p class="text-xs text-slate-500">
                            {{ $items->school->district ?? 'N/A' }}
                        </p>
                    </div>

                    <span class="px-2 py-1 text-[10px] font-semibold rounded-full bg-green-100 text-green-700">
                        {{ ucfirst($items->status) ?? 'N/A' }}
                    </span>
                </div>

                <!-- Tags -->
                <div class="flex gap-2 mt-3 flex-wrap">
                    <span class="px-2 py-1 text-[11px] rounded-md bg-blue-50 text-primary-900 font-medium">
                        {{ $items->subject ?? 'N/A' }}
                    </span>

                    <span class="px-2 py-1 text-[11px] rounded-md bg-slate-100 text-slate-700 font-medium">
                        Class {{ $items->teacher->addclass->class ?? 'N/A' }}
                    </span>
                </div>

                <!-- Teacher -->
                <div class="flex items-center gap-2 mt-3">
                    @if (!empty($items->teacher->photo))
                        <div class="w-8 h-8 rounded-full overflow-hidden border border-slate-200">
                            <img src="{{ asset($items->teacher->photo) }}" alt="Teacher"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="w-8 h-8 rounded-full bg-primary-900 text-white flex items-center justify-center text-xs font-semibold">
                            {{ strtoupper(substr($items->teacher->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="leading-tight">
                        <p class="text-sm font-medium text-slate-800">
                            {{ $items->teacher->name ?? 'N/A' }}
                        </p>
                        <p class="text-[11px] text-slate-500">
                            {{ $items->subject ?? 'N/A' }} : Subject Teacher
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                    <span class="text-[11px] text-slate-500">
                        Updated: {{ \Carbon\Carbon::parse($items->updated_at)->format('d M Y') }}
                    </span>

                    <a href="{{ route('view.tracking.details', ['school_id' =>$items->school_id, 'teacher_id' =>$items->teacher_id]) }}"
                        class="text-xs font-semibold text-primary-900 hover:underline">
                        View
                    </a>
                </div>

            </div>

        @empty
            <div id="emptyState" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 sm:p-14 text-center"
                style="display:none;">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-primary-900/5 flex items-center justify-center">
                    <svg class="w-8 h-8 text-primary-900/40" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-gray-700 mb-1">No Records Found</h3>
                <p class="text-sm text-gray-400">Adjust your filters above to find syllabus tracking data.</p>
            </div>
        @endforelse




    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-animate {
            animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
@endsection

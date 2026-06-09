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
            <form action="">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 md:grid-cols-4 gap-3">

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">District</label>
                        <select id="filterSchool" name="district"
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
                        <select id="filterSchool" name="school_id"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Schools</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Class</label>
                        <select id="filterClass" name="class_name"
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
                        <select id="filterSubject" name="subject"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Subjects</option>
                            @foreach (all_syllabus() as $items)
                                <option value="{{ $items }}">{{ $items }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Months</label>
                        <select id="filterClass" name="month"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Months</option>
                            @foreach (months() as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Years</label>
                        <select id="filterClass" name="years"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">Select Years</option>
                            @foreach (Years() as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="flex items-center gap-3 flex-wrap mt-4">

                        <!-- Search Button -->
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-primary-900 hover:bg-primary-800 active:scale-95 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </button>

                        <!-- Reset Button -->
                        <button type="button" onclick="resetFilters()"
                            class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 active:scale-95 text-gray-700 px-6 py-2.5 rounded-xl text-sm font-medium border border-gray-200 shadow-sm transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </button>

                    </div>


                </div>
            </form>




        </div>

        <!-- Results Count -->
        <div class="mb-4" id="resultsCount" style="display:none;">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-primary-900"></div>
                <p class="text-sm text-gray-500">Showing <span id="countNumber"
                        class="font-bold text-primary-900">0</span>
                    results</p>
            </div>
        </div>




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

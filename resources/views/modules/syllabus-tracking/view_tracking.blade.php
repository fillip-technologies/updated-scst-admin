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
            <form action="{{ route('view.tracking.details') }}" method="GET" id="filterForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 md:grid-cols-4 gap-3">

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">District</label>
                        <select name="district" id="district"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All District</option>
                            @foreach (getDisc() as $disc)
                                <option value="{{ $disc->district }}" @selected(request('district') == $disc->district ? 'selected' : '')>{{ $disc->district }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- School -->

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">School</label>
                        <select name="school_id" id="school_id"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Schools</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Class</label>
                        <select name="class_name"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Classes</option>
                            <option value="1" @selected(request('class_name') == '1' ? 'selected' : '')>1</option>
                            <option value="2" @selected(request('class_name') == '2' ? 'selected' : '')>2</option>
                            <option value="3" @selected(request('class_name') == '3' ? 'selected' : '')>3</option>
                            <option value="4" @selected(request('class_name') == '4' ? 'selected' : '')>4</option>
                            <option value="5" @selected(request('class_name') == '5' ? 'selected' : '')>5</option>
                            <option value="6" @selected(request('class_name') == '6' ? 'selected' : '')>6</option>
                            <option value="7" @selected(request('class_name') == '7' ? 'selected' : '')>7</option>
                            <option value="8" @selected(request('class_name') == '8' ? 'selected' : '')>8</option>
                            <option value="9" @selected(request('class_name') == '9' ? 'selected' : '')>9</option>
                            <option value="10" @selected(request('class_name') == '10' ? 'selected' : '')>10</option>

                        </select>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Subject</label>
                        <select name="subject"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Subjects</option>
                            @foreach (all_syllabus() as $items)
                                <option value="{{ $items }}" @selected(request('subject') == $items)>{{ $items }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Months</label>
                        <select name="month"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">All Months</option>
                            @foreach (months() as $month)
                                <option value="{{ $month }}" @selected(request('month') == $month)>{{ $month }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Years</label>
                        <select name="years"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                            <option value="">Select Years</option>
                            @foreach (Years() as $year)
                                <option value="{{ $year }}"@selected(request('years') == $year)>{{ $year }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label for="" class="block text-xs font-medium text-gray-500 mb-1.5"> From date</label>
                        <input type="date" value="{{ old('from_date', request('from_date')) }}" name="from_date"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
                    </div>

                    <div>
                        <label for="" class="block text-xs font-medium text-gray-500 mb-1.5"> To date</label>
                        <input type="date" value="{{ old('to_date', request('to_date')) }}" name="to_date"
                            class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 transition">
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

                        <a href="{{ route('view.tracking.list') }}"
                            class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 active:scale-95 text-gray-700 px-6 py-2.5 rounded-xl text-sm font-medium border border-gray-200 shadow-sm transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </a>

                    </div>


                </div>
            </form>
        </div>
        <div class="mb-4" id="resultsCount" style="display:none;">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-primary-900"></div>
                <p class="text-sm text-gray-500">Showing <span id="countNumber"
                        class="font-bold text-primary-900">0</span>
                    results</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

            <!-- Header -->
            <div class="px-6 py-4 border-b bg-gradient-to-r from-primary-800 to-primary-600">
                <h2 class="text-xl font-bold text-white">
                    Teacher Subject Progress Report
                </h2>
                <p class="text-primary-100 text-sm mt-1">
                    School Wise Syllabus Tracking Report
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">
                        <tr class="text-gray-700 uppercase text-xs tracking-wider">
                            <th class="px-6 py-4 text-left">School</th>
                            <th class="px-6 py-4 text-left">Teacher</th>
                            <th class="px-6 py-4 text-left">Subject</th>
                            <th class="px-6 py-4 text-center">Topics</th>
                            <th class="px-6 py-4 text-center">Completed</th>
                            <th class="px-6 py-4 text-center">Ongoing</th>
                            <th class="px-6 py-4 text-center">Pending</th>
                            <th class="px-6 py-4 text-center">Progress</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($finalReport ?? [] as $school)
                            @foreach ($school['teachers'] as $teacher)
                                @foreach ($teacher['subjects'] as $subject)
                                    <tr class="hover:bg-blue-50 transition duration-200 even:bg-gray-50">

                                        <!-- School -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">



                                                <div>
                                                    <h4 class="font-semibold text-gray-800">
                                                        {{ $school['school_name'] }}
                                                    </h4>

                                                    <p class="text-xs text-gray-500">
                                                        School
                                                    </p>
                                                </div>

                                            </div>
                                        </td>

                                        <!-- Teacher -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="h-10 w-10 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold">
                                                    {{ strtoupper(substr($teacher['teacher_name'], 0, 1)) }}
                                                </div>

                                                <div>
                                                    <div class="font-medium text-gray-800">
                                                        {{ $teacher['teacher_name'] }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        Teacher
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        <!-- Subject -->
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-medium">
                                                {{ $subject['subject'] }}
                                            </span>
                                        </td>

                                        <!-- Total Topics -->
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 font-bold text-gray-700">
                                                {{ $subject['total_topics'] }}
                                            </span>
                                        </td>

                                        <!-- Completed -->
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                                                {{ $subject['completed'] }}
                                            </span>
                                        </td>

                                        <!-- Ongoing -->
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                                {{ $subject['ongoing'] }}
                                            </span>
                                        </td>

                                        <!-- Pending -->
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                                                {{ $subject['pending'] }}
                                            </span>
                                        </td>

                                        <!-- Progress -->
                                        <td class="px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                <div class="w-full bg-gray-200 rounded-full h-3">

                                                    <div class="bg-green-500 h-3 rounded-full"
                                                        style="width: {{ $subject['percentage'] }}%">
                                                    </div>

                                                </div>

                                                <span class="font-semibold text-gray-700 w-14 text-right">
                                                    {{ $subject['percentage'] }}%
                                                </span>

                                            </div>

                                        </td>

                                        <td class="px-6 py-4 text-center">

                                            <a href="{{ route('all.info', [
                                                'school_id' => encrypt($school['school_id']),
                                                'teacher_id' => encrypt($teacher['teacher_id']),
                                                'subject' => encrypt($subject['subject']),
                                                'class_name' => encrypt($teacher['class_name']),
                                            ]) }}"
                                                class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-white text-sm font-medium hover:bg-primary-700 transition">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12H9m12 0c-1.8 4-5.5 7-9 7s-7.2-3-9-7c1.8-4 5.5-7 9-7s7.2 3 9 7z" />
                                                </svg>

                                                View
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach

                        @empty

                            <tr>
                                <td colspan="8" class="py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 17v-2a4 4 0 014-4h6m0 0l-3-3m3 3l-3 3M5 7h10M5 12h5m-5 5h3" />
                                        </svg>

                                        <h3 class="text-lg font-semibold text-gray-700">
                                            No Data Found
                                        </h3>

                                        <p class="text-gray-500 mt-2">
                                            There is no syllabus tracking report available.
                                        </p>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

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
    <script>
        function resetform() {
            const form = document.getElementById("filterForm");
            form.reset();
            window.location.href = window.location.pathname;
        }

        $(document).ready(function() {
            var allschool = $("#school_id");
            const selectedSchoolId = "{{ request('school_id') }}";
            $("#district").on('change', function() {
                var value = $(this).val();

                $.ajax({
                    url: "{{ url('admin/get/school') }}/" + value,
                    type: "GET",
                    success: function(res) {

                        var datas = res.data;
                        var options = `<option value="">Select School</option>`;


                        $.each(datas, function(key, school) {


                            let selected = selectedSchoolId == school.id ? 'selected' :
                                '';
                            options += `
                                <option value="${school.id}" ${selected}>
                                    ${school.school_name}
                                </option>
                            `;
                        });
                        var html = `
                    class="h-11 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    ${options}
                `;

                        $("#school_id").html(html);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection

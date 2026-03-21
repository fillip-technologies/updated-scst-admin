@extends('layouts.app')

@section('content')

<!-- Page Header -->
<div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 mb-10">

    <!-- Left -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 tracking-tight">
            School Monitoring
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Real-time status of daily reporting from all 91 schools.
        </p>
    </div>

    <!-- Right Controls -->
    <div class="flex items-center gap-4">

        <input type="text"
            placeholder="Search school..."
            class="w-72 px-4 py-2.5 rounded-xl border border-gray-300 text-sm 
                   focus:outline-none focus:ring-2 focus:ring-primary-600">

        <button
            class="px-5 py-2.5 rounded-xl border border-gray-300 text-sm 
                   hover:bg-gray-50 transition">
            Filter
        </button>

    </div>

</div>


<!-- Main Grid -->
<div class="grid grid-cols-12 gap-8">

    <!-- LEFT CARD -->
    <div class="col-span-12 lg:col-span-4">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 h-full">

            <h2 class="text-lg font-semibold text-gray-800 mb-8">
                Reporting Status Today
            </h2>

            <!-- Chart Placeholder -->
            <div class="flex justify-center mb-8">
                <div class="w-56 h-56 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                    Donut Chart
                </div>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-8 text-sm mb-8">

                <div class="flex items-center gap-2 text-green-600">
                    <span class="w-3 h-3 bg-green-600 rounded-sm"></span>
                    Reporting On Time
                </div>

                <div class="flex items-center gap-2 text-yellow-600">
                    <span class="w-3 h-3 bg-yellow-500 rounded-sm"></span>
                    Delayed
                </div>

                <div class="flex items-center gap-2 text-red-500">
                    <span class="w-3 h-3 bg-red-500 rounded-sm"></span>
                    Not Reported
                </div>

            </div>

            <!-- Total -->
            <div class="text-center">
                <p class="text-3xl font-semibold text-gray-900">
                    91
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Total Schools
                </p>
            </div>

        </div>

    </div>


    <!-- RIGHT CARD -->
    <div class="col-span-12 lg:col-span-8">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            <!-- Header -->
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-800">
                    Live Reporting Feed
                </h2>

                <div class="flex items-center gap-2 text-sm text-green-600">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    Live
                </div>

            </div>

            <!-- Feed -->
            <div class="divide-y divide-gray-100">

                @for ($i = 0; $i < 5; $i++)
                    <div class="flex items-center justify-between px-8 py-5 hover:bg-gray-50 transition">

                    <div>
                        <p class="font-medium text-gray-900">
                            Dr. B.R. Ambedkar Residential School
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Patna • Reported: 09:45 AM
                        </p>
                    </div>

                    <span class="text-xs bg-red-100 text-red-600 px-3 py-1.5 rounded-full font-medium">
                        1 Issue
                    </span>

            </div>
            @endfor

        </div>

        <!-- Footer -->
        <div class="text-center px-8 py-5 border-t border-gray-200">
            <button class="text-primary-700 font-medium hover:underline">
                View All 91 Schools
            </button>
        </div>

    </div>

</div>

</div>

@endsection
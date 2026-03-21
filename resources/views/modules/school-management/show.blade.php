@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Top Header -->
    <div class="flex justify-between items-start">

        <div>
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-arrow-left text-gray-500 cursor-pointer"></i>

                <h1 class="text-2xl font-semibold text-gray-900">
                 {{ $showschool->school_name}}
                </h1>
            </div>

            <div class="text-sm text-gray-500 mt-2 flex items-center gap-2">
                <span>{{ $showschool->school_code }}</span>
                <span>•</span>
                <span>{{ $showschool->district }}</span>
                <span>•</span>
                <span class="text-green-600 font-medium">{{ ucfirst($showschool->account_status) }}</span>
            </div>
        </div>

        <a href="{{ route('edit.school',encrypt($showschool->id)) }}"
            class="border border-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">
            <i class="fa-regular fa-pen-to-square mr-2"></i>
            Edit School
        </a>

    </div>


    <!-- Main Grid Layout -->
    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT SIDE -->
        <div class="col-span-2 space-y-6">

            <!-- School Banner Card -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="h-48 bg-gradient-to-r from-gray-400 to-gray-600 relative flex items-center px-6 text-white">
                    <div>
                        <h2 class="text-lg font-semibold">
                               {{ $showschool->school_name}}
                        </h2>
                        <p class="text-sm mt-1">
                            {{ $showschool->district }}{{-- Bailey Road, Patna, Bihar 800001 --}}
                        </p>
                    </div>
                </div>

                <div class="p-6 grid grid-cols-2 gap-8">

                    <!-- Admin Details -->
                    <div>
                        <h3 class="font-semibold mb-4">Administrative Details</h3>

                        <div class="text-sm space-y-2 text-gray-600">
                            <p><strong>Category:</strong> {{ $showschool->category }}</p>
                            <p><strong>Established:</strong> {{ $showschool->establishment_year }}</p>
                            <p><strong>Principal:</strong> {{ $showschool->principle_name }}</p>
                            <p><strong>Principal Contact:</strong> +91{{ $showschool->principle_contact }}</p>
                        </div>
                    </div>

                    <!-- Infrastructure Snapshot -->
                    <div>
                        <h3 class="font-semibold mb-4">Infrastructure Snapshot</h3>

                        <div class="grid grid-cols-2 gap-4">

                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $showschool->total_students_enrolled }}</p>
                                <p class="text-xs text-gray-500">Students</p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $showschool->total_teachers_sanctioned }}</p>
                                <p class="text-xs text-gray-500">Teachers</p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $showschool->total_classrooms }}</p>
                                <p class="text-xs text-gray-500">Classrooms</p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-xl font-bold text-gray-900">{{ $showschool->hostel_capacity }}</p>
                                <p class="text-xs text-gray-500">Hostel Cap.</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Recent Daily Reports -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                <h3 class="font-semibold mb-6">Recent Daily Reports</h3>

                <div class="space-y-4">

                    <!-- Report Item -->
                    <div class="flex justify-between items-center border border-gray-100 rounded-xl p-4 hover:bg-gray-50">

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg">
                                <i class="fa-regular fa-file-lines text-sm"></i>
                            </div>

                            <div>
                                <p class="font-medium text-gray-800">
                                    Daily Activity Report
                                </p>
                                <p class="text-xs text-gray-500">
                                    Submitted by Principal • Today
                                </p>
                            </div>
                        </div>

                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">
                            Approved
                        </span>

                    </div>


                    <!-- Report Item -->
                    <div class="flex justify-between items-center border border-gray-100 rounded-xl p-4 hover:bg-gray-50">

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg">
                                <i class="fa-regular fa-file-lines text-sm"></i>
                            </div>

                            <div>
                                <p class="font-medium text-gray-800">
                                    Daily Activity Report
                                </p>
                                <p class="text-xs text-gray-500">
                                    Submitted by Principal • Yesterday
                                </p>
                            </div>
                        </div>

                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">
                            Approved
                        </span>

                    </div>


                    <!-- Report Item -->
                    <div class="flex justify-between items-center border border-gray-100 rounded-xl p-4 hover:bg-gray-50">

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg">
                                <i class="fa-regular fa-file-lines text-sm"></i>
                            </div>

                            <div>
                                <p class="font-medium text-gray-800">
                                    Daily Activity Report
                                </p>
                                <p class="text-xs text-gray-500">
                                    Submitted by Principal • 2 days ago
                                </p>
                            </div>
                        </div>

                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">
                            Approved
                        </span>

                    </div>

                </div>

            </div>

            <!-- Performance Overview -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                <h3 class="font-semibold mb-6">Performance Overview</h3>

                <div class="grid grid-cols-3 gap-6">

                    <!-- Score -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">Performance Score</p>
                        <p class="text-2xl font-bold mt-1">88 <span class="text-sm font-normal">/100</span></p>
                        <div class="w-full bg-gray-200 h-2 rounded mt-3">
                            <div class="bg-blue-600 h-2 rounded w-[88%]"></div>
                        </div>
                    </div>

                    <!-- Attendance -->
                    <div class="bg-green-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">Attendance Rate</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">92%</p>
                        <div class="w-full bg-green-200 h-2 rounded mt-3">
                            <div class="bg-green-600 h-2 rounded w-[92%]"></div>
                        </div>
                    </div>

                    <!-- Reporting -->
                    <div class="bg-orange-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500">Reporting Compliance</p>
                        <p class="text-2xl font-bold text-orange-600 mt-1">98%</p>
                        <div class="w-full bg-orange-200 h-2 rounded mt-3">
                            <div class="bg-orange-600 h-2 rounded w-[98%]"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="space-y-6">

            <!-- Current Status -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                <h3 class="font-semibold mb-4">Current Status</h3>

                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                    <p class="text-green-700 font-medium">Operational</p>
                    <p class="text-sm text-green-600 mt-1">
                        School is fully active and reporting daily data.
                    </p>
                </div>

                <div class="text-sm text-gray-600 mt-4 space-y-1">
                    <p><strong>Last Report:</strong> Today, 10:30 AM</p>
                    <p><strong>Current Grade:</strong> A</p>
                </div>

            </div>


            <!-- Audit Timeline -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                <h3 class="font-semibold mb-4">Audit Timeline</h3>

                <ul class="space-y-4 text-sm text-gray-600">
                    <li>Daily Report Submitted</li>
                    <li>Student Attendance Updated</li>
                    <li>Infrastructure Details Updated</li>
                    <li>System Login</li>
                </ul>

                <div class="text-blue-600 text-sm mt-4 cursor-pointer hover:underline">
                    View Full Logs
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

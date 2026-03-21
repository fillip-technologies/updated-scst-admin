@extends('layouts.app')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">
            School Reports
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Download and manage your school’s data reports.
        </p>
    </div>


    <div class="grid lg:grid-cols-12 gap-6">

        <!-- LEFT SIDE -->
        <div class="lg:col-span-8 bg-white rounded-xl shadow-sm p-6">

            <div class="flex items-center gap-2 mb-6">
                <i class="fa-solid fa-filter text-gray-500"></i>
                <h2 class="font-semibold text-gray-700">
                    Generate Report
                </h2>
            </div>

            <!-- Report Category -->
            <label class="text-sm text-gray-600">
                Select Report Category
            </label>

            <div class="grid md:grid-cols-2 gap-4 mt-3 mb-6">

                <button onclick="selectCategory(this)"
                    class="report-btn border-2 border-primary-900 bg-primary-50 rounded-lg p-4 text-left">

                    <p class="font-medium text-primary-900">
                        Student Attendance
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Daily class-wise attendance records
                    </p>
                </button>

                <button onclick="selectCategory(this)"
                    class="report-btn border rounded-lg p-4 text-left hover:border-primary-900">

                    <p class="font-medium">
                        Mid-Day Meal Logs
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Daily menu and quality reports
                    </p>
                </button>

                <button onclick="selectCategory(this)"
                    class="report-btn border rounded-lg p-4 text-left hover:border-primary-900">

                    <p class="font-medium">
                        Exam Results
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Term-wise student performance
                    </p>
                </button>

                <button onclick="selectCategory(this)"
                    class="report-btn border rounded-lg p-4 text-left hover:border-primary-900">

                    <p class="font-medium">
                        Health Checkups
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        Medical camp records
                    </p>
                </button>

            </div>


            <!-- Filters Row -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">

                <!-- Date Range -->
                <div>
                    <label class="text-sm text-gray-600">
                        Date Range
                    </label>
                    <select class="mt-2 w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-primary-900">
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                        <option>This Month</option>
                        <option>Custom Range</option>
                    </select>
                </div>

                <!-- Format -->
                <div>
                    <label class="text-sm text-gray-600">
                        Format
                    </label>
                    <select class="mt-2 w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-primary-900">
                        <option>PDF Document</option>
                        <option>Excel (XLSX)</option>
                        <option>CSV File</option>
                    </select>
                </div>

            </div>


            <!-- Download Button -->
            <button
                class="w-full bg-primary-900 hover:bg-primary-800 text-white py-3 rounded-lg text-sm font-medium flex items-center justify-center gap-2">

                <i class="fa-solid fa-download text-xs"></i>
                Download Report
            </button>

        </div>



        <!-- RIGHT SIDE -->
        <div class="lg:col-span-4 bg-white rounded-xl shadow-sm p-6">

            <h2 class="font-semibold text-gray-700 mb-6">
                Recent Downloads
            </h2>

            <div class="space-y-5 text-sm">

                <div class="flex gap-3 items-start">
                    <div class="w-9 h-9 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-file-pdf text-sm"></i>
                    </div>
                    <div>
                        <p class="font-medium">
                            Attendance Report - Oct 2023
                        </p>
                        <p class="text-xs text-gray-500">
                            Oct 28, 2023 • 1.2 MB
                        </p>
                    </div>
                </div>

                <div class="flex gap-3 items-start">
                    <div class="w-9 h-9 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-file-excel text-sm"></i>
                    </div>
                    <div>
                        <p class="font-medium">
                            Meal Quality Audit - Q3
                        </p>
                        <p class="text-xs text-gray-500">
                            Oct 25, 2023 • 850 KB
                        </p>
                    </div>
                </div>

                <div class="flex gap-3 items-start">
                    <div class="w-9 h-9 bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-file-pdf text-sm"></i>
                    </div>
                    <div>
                        <p class="font-medium">
                            Half Yearly Results - Class 10
                        </p>
                        <p class="text-xs text-gray-500">
                            Oct 20, 2023 • 2.4 MB
                        </p>
                    </div>
                </div>

            </div>

            <button class="mt-6 text-primary-900 text-sm">
                View All History →
            </button>

        </div>

    </div>

</div>


<script>
    function selectCategory(button) {

        document.querySelectorAll('.report-btn').forEach(btn => {
            btn.classList.remove('border-2', 'border-primary-900', 'bg-primary-50');
            btn.classList.add('border');
        });

        button.classList.remove('border');
        button.classList.add('border-2', 'border-primary-900', 'bg-primary-50');
    }
</script>

@endsection
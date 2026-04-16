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

                <form action="{{ route('report.download') }}" method="POST">
                    @csrf
                    <!-- Hidden Input -->
                    <input type="hidden" name="category" id="categoryInput">

                    <!-- Report Category -->
                    <label class="text-sm text-gray-600">
                        Select Report Category
                    </label>

                    <div class="grid md:grid-cols-2 gap-4 mt-3 mb-6">

                        <!-- Button 1 -->
                        <button type="button" onclick="selectCategory(this, 'attendance')"
                            class="report-btn border rounded-lg p-4 text-left transition">
                            <p class="font-medium">Student Attendance</p>
                        </button>
                        <button type="button" onclick="selectCategory(this, 'teacher_attendance')"
                            class="report-btn border rounded-lg p-4 text-left transition">
                            <p class="font-medium">Teacher Attendance</p>
                        </button>

                        <!-- Button 2 -->
                        <button type="button" onclick="selectCategory(this, 'meal')"
                            class="report-btn border rounded-lg p-4 text-left transition">
                            <p class="font-medium">Mid-Day Meal Logs</p>
                        </button>

                        <!-- Button 3 -->
                        <button type="button" onclick="selectCategory(this, 'exam')"
                            class="report-btn border rounded-lg p-4 text-left transition">
                            <p class="font-medium">Exam Results</p>
                        </button>



                    </div>

                    <!-- Dynamic Section -->
                    <div id="hidden_section" class="mb-6"></div>

                    <!-- Filters -->
                    <div class="grid md:grid-cols-2 gap-6 mb-6">

                        <!-- Date Range -->
                        <div>
                            <label class="text-sm text-gray-600">Date Range</label>
                            <select name="date_range" class="mt-2 w-full border rounded-lg px-4 py-2 text-sm">
                                <option value="">Select Range</option>
                                @foreach (dateRange() as $key => $d)
                                    <option value="{{ $key }}">{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Format -->
                        <div>
                            <label class="text-sm text-gray-600">Format</label>
                            <input name="format" class="mt-2 w-full border rounded-lg px-4 py-2 text-sm" value="excel"
                                readonly>
                        </div>

                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-primary-900 hover:bg-primary-800 text-white py-3 rounded-lg text-sm font-medium flex items-center justify-center gap-2">
                        <i class="fa-solid fa-download text-xs"></i>
                        Download Report
                    </button>

                </form>


                <!-- JS -->
                <script>
                    function selectCategory(button, category) {

                        // 1. Set hidden input value
                        document.getElementById('categoryInput').value = category;

                        // 2. Remove active class from all buttons
                        document.querySelectorAll('.report-btn').forEach(btn => {
                            btn.classList.remove('border-blue-900', 'bg-primary-50', 'border-2');
                        });

                        // 3. Add active class to selected
                        button.classList.add('border-2', 'border-blue-900', 'bg-primary-50');
                        // 4. Dynamic Section Content
                        let html = '';

                        if (category === 'attendance') {
                            html = `
                <label class="text-sm text-gray-600">Select Class</label>
                <select name="class"
                    class="mt-2 w-full border rounded-lg px-4 py-2 text-sm">
                    <option>Select Class</option>
                    @foreach (getClass() as $class)
                     <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            `;
                        }


                        if (category === 'exam') {
                            html = `
                <label class="text-sm text-gray-600">Exam Type</label>
                <input type="text" name="exam_type" placeholder="Enter exam"
                    class="mt-2 w-full border rounded-lg px-4 py-2 text-sm">

                     <label class="text-sm text-gray-600">Select Class</label>
                <select name="class"
                    class="mt-2 w-full border rounded-lg px-4 py-2 text-sm">
                    <option>Select Class</option>
                    @foreach (getClass() as $class)
                     <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            `;


                        }

                        if (category === 'health') {
                            html = `
                <label class="text-sm text-gray-600">Health Type</label>
                <input type="text" name="health_type" placeholder="Enter type"
                    class="mt-2 w-full border rounded-lg px-4 py-2 text-sm">
            `;
                        }

                        document.getElementById('hidden_section').innerHTML = html;
                    }
                </script>
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
                            <p class="font-medium">Attendance Report - Oct 2023</p>
                            <p class="text-xs text-gray-500">Oct 28, 2023 • 1.2 MB</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

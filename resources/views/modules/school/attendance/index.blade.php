@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `
                <ul style="text-align:center;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    <div class="p-8 bg-gray-100 min-h-screen">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Student Attendance</h1>
                <p class="text-sm text-gray-500">Mark and manage daily student attendance records.</p>
            </div>

            {{-- <input type="date" class="border rounded-lg px-3 py-2 text-sm"> --}}
        </div>

        <div class="grid grid-cols-12 gap-6">

            <!-- LEFT SIDE CLASS LIST -->
            <div class="col-span-3 bg-white rounded-xl shadow-sm p-4">

                <h2 class="text-sm font-semibold text-gray-600 mb-4">Select Class</h2>

                <form id="classForm" action="{{ route('class.filter') }}" method="GET">

                    <input type="hidden" name="class" id="selectedClass">
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">


                    @php
                        $activeClass = session('selected_class') ?? $classes->first()->id;
                    @endphp

                    <div class="space-y-2">
                        @foreach ($classes as $class)
                            <div onclick="selectClass('{{ $class->id }}')"
                                class="class-item px-4 py-2 rounded-lg cursor-pointer
        {{ $activeClass == $class->id ? 'bg-primary-900 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
                                {{ $class->name }}
                            </div>
                        @endforeach
                    </div>
                </form>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-span-9 space-y-6">
                @php
                    $activeClass = session('selected_class') ?? (request('class') ?? $classes->first()->id);
                @endphp
                <!-- Top Summary -->
                @php
                    $total = $studentdata->count();
                    $present = $studentdata
                        ->filter(fn($s) => optional($s->attendance->first())->status == 'present')
                        ->count();
                    $absent = $studentdata
                        ->filter(fn($s) => optional($s->attendance->first())->status == 'absent')
                        ->count();
                @endphp

                <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">

                    <div class="flex gap-8 text-sm">
                        <div>
                            <p class="text-gray-500">TOTAL STUDENTS</p>
                            <h3 class="font-semibold text-gray-800">{{ $total }}</h3>
                        </div>

                        <div>
                            <p class="text-gray-500">PRESENT</p>
                            <h3 class="font-semibold text-green-600">{{ $present }}</h3>
                        </div>

                        <div>
                            <p class="text-gray-500">ABSENT</p>
                            <h3 class="font-semibold text-red-500">{{ $absent }}</h3>
                        </div>

                    </div>
                    <div class="flex items-center gap-3">
                        <button onclick="openModal()"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                            📤 Upload Report
                        </button>

                        <button onclick="history.back()"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                            ← Back
                        </button>
                    </div>
                </div>

                <!-- Attendance Table -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-100">
                    <div id="uploadModal" class="fixed inset-0 hidden flex items-center justify-end me-5 mt-5 z-50">

                        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative ml-4">

                            <!-- Close Button -->
                            <button onclick="closeModal()"
                                class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-lg">
                                ✖
                            </button>

                            <h2 class="text-lg font-semibold mb-4">Upload Report</h2>

                            <!-- Form -->
                            <form action="{{ route('report.save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                                <input type="hidden" name="district" value="{{ SchoolLogin()->district }}">
                                <div class="mb-3">
                                    <label class="block text-sm mb-1">Report Type</label>
                                    <select name="report_type" id="report_type"
                                        class="w-full border rounded-lg px-3 py-2 text-sm">
                                        <option value="">Select Report Type</option>
                                        @foreach (academicType() as $academic)
                                            <option value="{{ $academic }}">{{ $academic }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="block text-sm mb-1">Upload File</label>
                                    <input type="file" name="report_img"
                                        class="w-full border rounded-lg px-3 py-2 text-sm">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm mb-1">Date</label>
                                    <input type="date" name="date" class="w-full border rounded-lg px-3 py-2 text-sm">
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg">
                                    Submit
                                </button>
                            </form>

                        </div>
                    </div>
                    <div class="flex justify-between items-center px-6 py-4 border-b">
                        <h2 class="font-semibold text-lg text-gray-700">
                            📚 Class Attendance List
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">

                            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="py-3 px-6 text-left">Roll No</th>
                                    <th class="py-3 px-6 text-left">Student Name</th>
                                    <th class="py-3 px-6 text-left">Status</th>
                                    <th class="py-3 px-6 text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody id="attendanceBody" class="divide-y">

                                @foreach ($studentdata as $student)
                                    @php
                                        $attendance = $student->attendance->first();
                                        $status = $attendance->status ?? null;
                                    @endphp

                                    <tr class="hover:bg-gray-50">

                                        <!-- Roll -->
                                        <td class="py-3 px-6 font-medium text-gray-700">
                                            {{ $student->roll_number }}
                                        </td>

                                        <!-- Name -->
                                        <td class="py-3 px-6 text-gray-600 student-name">
                                            {{ $student->name }}
                                        </td>

                                        <!-- Status -->
                                        <td class="py-3 px-6">
                                            <span
                                                class="
                                            px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($status == 'present') bg-green-100 text-green-700
                                            @elseif($status == 'absent') bg-red-100 text-red-700
                                            @elseif($status == 'late') bg-yellow-100 text-yellow-700
                                            @elseif($status == 'excused') bg-blue-100 text-blue-700
                                            @else bg-gray-100 text-gray-600 @endif
                                        ">
                                                {{ ucfirst($status ?? 'N/A') }}
                                            </span>
                                        </td>

                                        <!-- Action -->
                                        <td class="py-3 px-6">
                                            <form action="{{ route('attendance.status.update') }}" method="POST">
                                                @csrf

                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <input type="hidden" name="class_id" value="{{ $student->class_id }}">
                                                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                                                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">

                                                <select name="status" onchange="this.form.submit()"
                                                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm">

                                                    <option value="present" {{ $status == 'present' ? 'selected' : '' }}>✅
                                                        Present</option>
                                                    <option value="absent" {{ $status == 'absent' ? 'selected' : '' }}>❌
                                                        Absent</option>
                                                    <option value="late" {{ $status == 'late' ? 'selected' : '' }}>⏰
                                                        Late
                                                    </option>
                                                    <option value="excused" {{ $status == 'excused' ? 'selected' : '' }}>
                                                        📄
                                                        Excused</option>

                                                </select>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="mt-4">
                    {{ $studentdata->links() }}
                </div>
            </div>

        </div>

    </div>

    <!-- JS -->
    <script>
        function searchStudent() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("#attendanceBody tr");

            rows.forEach(row => {
                let name = row.querySelector(".student-name").innerText.toLowerCase();
                row.style.display = name.includes(input) ? "" : "none";
            });
        }

        function selectClass(classId) {
            document.getElementById('selectedClass').value = classId;
            document.getElementById('classForm').submit();
        }

        function openModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('uploadModal').classList.remove('flex');
        }
    </script>
@endsection

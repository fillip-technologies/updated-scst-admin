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
    <div class="p-6 max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Upload Student Results
            </h1>
            <p class="text-gray-500 text-sm">
                Select term and enter subject-wise marks
            </p>
        </div>

        <!-- TERM SELECT -->
        <form action="{{ route('staff.get.result') }}" method="GET">
            <div class="bg-white rounded-2xl shadow p-6 mb-6 flex items-center justify-between gap-5">
                <input type="hidden" name="teacher_id" value="{{ TeacherLog()->staff_id ?? SchoolLogin()->id }}">
                <input type="hidden" name="school_id" value="{{ TeacherLog()->school_id ?? SchoolLogin()->id }}">
                <!-- LEFT SIDE (Filters) -->
                <div class="flex gap-4">

                    <!-- Term Select -->
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Select Term</p>
                        <select name="term" class="border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 w-70">
                            <option value="">Choose Term</option>
                            <option value="half">Half Yearly</option>
                            <option value="third">Third Terminal</option>
                            <option value="final">Final</option>
                        </select>
                    </div>

                    <!-- Class Select -->
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Select Class</p>

                        <select name="class_id" class="border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 w-70">

                            <option value="">Choose Class</option>

                            @foreach (getClass() as $class)
                                <option value="{{ $class->id }}" @selected(getClassID() == $class->id)>
                                    {{ $class->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <!-- RIGHT SIDE (Filter Button) -->
                <div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl shadow hover:bg-blue-700 transition">
                        Filter
                    </button>
                    <a href="{{ TeacherLog() ? route('staff.school.manage-result') : route('school.manage-result') }}"
                        class="bg-orange-500 text-white px-6 py-2 rounded-xl shadow hover:bg-orange-700 transition">Refresh
                    </a>
                </div>

            </div>
        </form>


        <!-- STUDENTS -->
        <form id="resultForm" action="{{ route('staff.result.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="studentSection" class="space-y-6">

                @foreach ($studentdata ?? [] as $student)
                    <div class="bg-white rounded-2xl shadow p-6">

                        <!-- HEADER -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="font-semibold text-lg text-gray-800">
                                👨‍🎓 {{ $student->name }}
                            </h2>

                            <div class="flex items-center gap-3">
                                <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                                    Roll No: {{ $student->roll_no }}
                                </span>

                                <a href="#" class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs">
                                    Edit
                                </a>
                            </div>
                        </div>

                        <!-- SUBJECTS -->
                        <div class="grid md:grid-cols-3 gap-5">

                            @foreach ($subjectdata ?? [] as $subject)
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">

                                    <!-- SUBJECT HEADER -->
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="font-medium text-gray-700">
                                            {{ $subject->subjects }}
                                        </p>

                                        <label class="text-xs flex items-center gap-1 cursor-pointer">
                                            <input type="checkbox"
                                                name="results[{{ $student->id }}][{{ $subject->id }}][absent]">
                                            Absent
                                        </label>
                                    </div>

                                    <!-- MARKS -->
                                    <input type="number" name="results[{{ $student->id }}][{{ $subject->id }}][marks]"
                                        placeholder="Enter Marks" class="w-full border rounded-lg px-3 py-2 mb-3"
                                        min="0" max="100">

                                    <!-- FILE -->
                                    <label
                                        class="flex justify-between items-center border border-dashed rounded-lg px-3 py-2 cursor-pointer">
                                        <span class="text-sm text-gray-500">
                                            Upload Copy
                                        </span>

                                        <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                                            Choose
                                        </span>

                                        <input type="file"
                                            name="results[{{ $student->id }}][{{ $subject->id }}][file]" class="hidden">
                                    </label>

                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach

                <!-- SAVE -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700">
                        Save Results
                    </button>
                </div>

            </div>
        </form>

    </div>
@endsection

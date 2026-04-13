@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">
        <form action="{{ route('filter.result') }}" method="GET">
            <input type="hidden" name="school_id" value="{{ TeacherLog()->school_id ?? SchoolLogin()->id }}">
            <input type="hidden" name="teacher_id" value="{{ TeacherLog()->staff_id ?? SchoolLogin()->id }}">
            <div class="bg-white shadow rounded-2xl p-5 flex flex-wrap gap-4 items-end">

                <!-- Term -->
                <div class="flex flex-col">
                    <label class="text-sm text-gray-500 mb-1">Select Term</label>
                    <select name="term" class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 w-52"
                        required>
                        <option value="">Choose Term</option>
                        @foreach (ExamType() as $key => $exam)
                            <option value="{{ $key }}">{{ $exam }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Class -->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Select Class</p>

                    <select class="border rounded px-4 py-2 w-70" disabled>
                        @foreach (getClass() as $class)
                            <option value="{{ $class->id }}" @selected(getClassID() == $class->id)>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="hidden" name="class_id" value="{{ getClassID() }}">
                </div>

                <!-- Button -->
                <div>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                        Apply
                    </button>

                    <a href="{{ route('staff.result.list') }}"
                        class="bg-green-500 px-6 py-2 text-white hover:bg-green-700 border-0 rounded-lg">Reset</a>
                </div>

            </div>

        </form>
        <!-- FILTER SECTION -->


        <!-- RESULTS -->
        @foreach ($results as $studentId => $studentResults)
            @php
                $data = $studentResults['data'];
                $student = $data->first();

                $totalMarks = $studentResults['total_marks'];
                $totalSubjects = $studentResults['total_subjects'];

                $percentage = $totalSubjects > 0 ? ($totalMarks / ($totalSubjects * 100)) * 100 : 0;

                $status = $percentage >= 33 ? 'Pass' : 'Fail';
            @endphp

            <div class="bg-white shadow-lg rounded-2xl p-6 border">

                <!-- HEADER -->
                <div class="flex flex-wrap justify-between items-center mb-4 gap-2">
                    <h2 class="text-lg font-semibold text-gray-800">
                        👨‍🎓 {{ $student->student->name ?? '' }}
                    </h2>

                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        Roll: {{ $student->student->id ?? '' }}
                    </span>
                </div>

                <!-- SUMMARY CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

                    <div class="bg-green-50 p-3 rounded-xl text-center">
                        <p class="text-xs text-gray-500">Total Marks</p>
                        <p class="text-lg font-bold text-green-600">{{ $totalMarks }}</p>
                    </div>

                    <div class="bg-purple-50 p-3 rounded-xl text-center">
                        <p class="text-xs text-gray-500">Percentage</p>
                        <p class="text-lg font-bold text-purple-600">
                            {{ number_format($percentage, 2) }}%
                        </p>
                    </div>

                    <div
                        class="p-3 rounded-xl text-center
                    {{ $status == 'Pass' ? 'bg-green-50' : 'bg-red-50' }}">
                        <p class="text-xs text-gray-500">Result</p>
                        <p
                            class="text-lg font-bold
                        {{ $status == 'Pass' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $status }}
                        </p>
                    </div>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto rounded-xl border">
                    <table class="w-full text-sm">

                        <thead class="bg-gray-100 text-gray-600">
                            <tr>
                                <th class="py-2 px-3 text-left">Subject</th>
                                <th class="py-2 px-3 text-left">Marks</th>
                                <th class="py-2 px-3 text-left">Status</th>
                                <th class="py-2 px-3 text-left">File</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $result)
                                <tr class="border-t hover:bg-gray-50 transition">

                                    <td class="py-2 px-3">
                                        {{ $result->subject->subjects ?? '' }}
                                    </td>

                                    <td class="py-2 px-3 font-medium">
                                        {{ $result->is_absent ? '-' : $result->marks }}
                                    </td>

                                    <td class="py-2 px-3">
                                        @if ($result->is_absent)
                                            <span class="text-red-500 text-xs font-semibold">Absent</span>
                                        @else
                                            <span class="text-green-600 text-xs font-semibold">Present</span>
                                        @endif
                                    </td>

                                    <td class="py-2 px-3">
                                        @if ($result->file)
                                            <a href="{{ asset('uploads/results/' . $result->file) }}" target="_blank"
                                                class="text-blue-600 text-xs font-semibold underline hover:text-blue-800">
                                                View
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs">N/A</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        @endforeach

    </div>
    <div class="mt-4">
        {{ $results->links() }}
    </div>
@endsection

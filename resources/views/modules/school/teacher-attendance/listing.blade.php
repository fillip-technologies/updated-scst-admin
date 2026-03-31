@extends('layouts.app')

@section('content')
    @php
        $attendanceData = [
            [
                'id' => 1,
                'teacher_name' => 'Teacher A',
                'total_days' => 30,
                'present' => 30,
                'absent' => 0,
                'status' => 'Present',
                'reason' => null,
            ],
            [
                'id' => 2,
                'teacher_name' => 'Teacher B',
                'total_days' => 30,
                'present' => 28,
                'absent' => 2,
                'status' => 'Absent',
                'reason' => 'Sick Leave',
            ],
            [
                'id' => 3,
                'teacher_name' => 'Teacher C',
                'total_days' => 30,
                'present' => 29,
                'absent' => 1,
                'status' => 'Absent',
                'reason' => 'Casual Leave',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-gray-100 p-6 md:p-8">
        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Teacher Attendance</h1>
                <p class="mt-1 text-sm text-gray-500">Track daily attendance status for teaching staff in a clean summary view.</p>
            </div>

            <div class="w-full max-w-xs">
                <label for="attendance_date" class="mb-2 block text-sm font-medium text-gray-600">Select Date</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        📅
                    </span>
                    <input
                        id="attendance_date"
                        type="date"
                        value="{{ now()->format('Y-m-d') }}"
                        class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-10 pr-4 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                </div>
            </div>
        </div>

        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Total Teachers</p>
                <h2 class="mt-2 text-2xl font-semibold text-gray-800">{{ count($attendanceData) }}</h2>
            </div>
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Present Today</p>
                <h2 class="mt-2 text-2xl font-semibold text-green-600">
                    {{ collect($attendanceData)->where('status', 'Present')->count() }}
                </h2>
            </div>
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Absent Today</p>
                <h2 class="mt-2 text-2xl font-semibold text-red-500">
                    {{ collect($attendanceData)->where('status', 'Absent')->count() }}
                </h2>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Attendance Register</h2>
                    <p class="mt-1 text-sm text-gray-500">Static preview for the teacher attendance management module.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-6 py-4">Teacher Name</th>
                            <th class="px-6 py-4">Total Days</th>
                            <th class="px-6 py-4">Present</th>
                            <th class="px-6 py-4">Absent</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Reason</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($attendanceData as $teacher)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100 text-sm font-semibold text-primary-900">
                                            {{ substr($teacher['teacher_name'], -1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $teacher['teacher_name'] }}</p>
                                            <p class="text-xs text-gray-400">Teaching Staff</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-700">{{ $teacher['total_days'] }}</td>
                                <td class="px-6 py-4 font-medium text-green-600">{{ $teacher['present'] }}</td>
                                <td class="px-6 py-4 font-medium text-red-500">{{ $teacher['absent'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $teacher['status'] === 'Present' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $teacher['status'] === 'Present' ? 'Present' : 'Absent' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $teacher['status'] === 'Absent' ? $teacher['reason'] : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('school.teacher.attendance.edit', $teacher['id']) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-primary-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-primary-800">
                                        ✏️ Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

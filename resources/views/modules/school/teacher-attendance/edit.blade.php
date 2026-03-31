@extends('layouts.app')

@section('content')
    @php
        $teacher = [
            'id' => 2,
            'teacher_name' => 'Teacher B',
            'date' => now()->format('Y-m-d'),
            'status' => 'Absent',
            'reason' => 'Sick Leave',
        ];
    @endphp

    <div class="min-h-screen bg-gray-100 p-6 md:p-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Edit Teacher Attendance</h1>
                <p class="mt-1 text-sm text-gray-500">Update teacher attendance status with a simple static form preview.</p>
            </div>

            <a href="{{ route('school.teacher.attendance') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                Back
            </a>
        </div>

        <div class="mx-auto max-w-4xl rounded-2xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="border-b border-gray-100 pb-4">
                <h2 class="text-lg font-semibold text-gray-800">Attendance Details</h2>
                <p class="mt-1 text-sm text-gray-500">Change the status and reason without leaving the page.</p>
            </div>

            <form class="mt-6 space-y-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="teacher_name" class="mb-2 block text-sm font-medium text-gray-600">Teacher Name</label>
                        <input
                            id="teacher_name"
                            type="text"
                            value="{{ $teacher['teacher_name'] }}"
                            readonly
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none">
                    </div>

                    <div>
                        <label for="attendance_date" class="mb-2 block text-sm font-medium text-gray-600">Date</label>
                        <input
                            id="attendance_date"
                            type="date"
                            value="{{ $teacher['date'] }}"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                    </div>

                    <div>
                        <label for="status" class="mb-2 block text-sm font-medium text-gray-600">Status</label>
                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                            <option value="Present" @selected($teacher['status'] === 'Present')>Present</option>
                            <option value="Absent" @selected($teacher['status'] === 'Absent')>Absent</option>
                        </select>
                    </div>

                    <div id="reason_wrapper">
                        <label for="reason" class="mb-2 block text-sm font-medium text-gray-600">Reason</label>
                        <select
                            id="reason"
                            name="reason"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                            <option value="">Select Reason</option>
                            <option value="Sick Leave" @selected($teacher['reason'] === 'Sick Leave')>Sick Leave</option>
                            <option value="Casual Leave" @selected($teacher['reason'] === 'Casual Leave')>Casual Leave</option>
                            <option value="Personal Work" @selected($teacher['reason'] === 'Personal Work')>Personal Work</option>
                            <option value="Other" @selected($teacher['reason'] === 'Other')>Other</option>
                        </select>
                    </div>
                </div>

                <div class="rounded-2xl bg-gray-50 p-4">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Current Status Preview</p>
                            <p class="mt-1 text-sm text-gray-500">Absent status will keep the reason field visible.</p>
                        </div>

                        <span id="status_badge" class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                            Absent
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row">
                    <button
                        type="button"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-900 px-5 py-3 text-sm font-medium text-white transition hover:bg-primary-800">
                        Update
                    </button>

                    <a href="{{ route('school.teacher.attendance') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const statusField = document.getElementById('status');
        const reasonWrapper = document.getElementById('reason_wrapper');
        const reasonField = document.getElementById('reason');
        const statusBadge = document.getElementById('status_badge');

        function toggleReasonField() {
            const isAbsent = statusField.value === 'Absent';

            reasonWrapper.style.display = isAbsent ? 'block' : 'none';
            reasonField.disabled = !isAbsent;

            statusBadge.textContent = statusField.value;
            statusBadge.className = isAbsent ?
                'inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700' :
                'inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700';

            if (!isAbsent) {
                reasonField.value = '';
            }
        }

        statusField.addEventListener('change', toggleReasonField);
        toggleReasonField();
    </script>
@endsection

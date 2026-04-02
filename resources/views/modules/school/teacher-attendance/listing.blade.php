@extends('layouts.app')

@section('content')
@php
$teachers = [
(object) [
'teacher_name' => 'Teacher A',
'status' => 'present',
'reason' => null,
],
(object) [
'teacher_name' => 'Teacher B',
'status' => 'absent',
'reason' => 'Sick Leave',
],
(object) [
'teacher_name' => 'Teacher C',
'status' => 'present',
'reason' => null,
],
(object) [
'teacher_name' => 'Teacher D',
'status' => 'absent',
'reason' => 'Casual Leave',
],
];

$teacherRows = collect($teachers);
$total = $teacherRows->count();
$present = $teacherRows->where('status', 'present')->count();
$absent = $teacherRows->where('status', 'absent')->count();
@endphp


<div class="p-8 bg-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6">

        <!-- Left -->
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Teacher Attendance</h1>
            <p class="text-sm text-gray-500">
                Mark and manage daily teacher attendance records.
            </p>
        </div>

        <!-- Right Button -->
        <a href="{{ route('teacher.create') }}"
            class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow-sm">

            <span class="text-lg">+</span>
            <span>Add Teacher</span>

        </a>

    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">
            <div class="flex gap-8 text-sm">
                <div>
                    <p class="text-gray-500">TOTAL TEACHERS</p>
                    <h3 class="font-semibold text-gray-800">{{ $total }}</h3>
                </div>

                <div>
                    <p class="text-gray-500">PRESENT</p>
                    <h3 id="presentCount" class="font-semibold text-green-600">{{ $present }}</h3>
                </div>

                <div>
                    <p class="text-gray-500">ABSENT</p>
                    <h3 id="absentCount" class="font-semibold text-red-500">{{ $absent }}</h3>
                </div>
            </div>

            <button onclick="history.back()"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                ← Back
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100">
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 class="font-semibold text-lg text-gray-700">👩‍🏫 Teacher Attendance List</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-6 text-left">Teacher Name</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody id="teacherAttendanceBody" class="divide-y">
                        @foreach ($teacherRows as $teacher)
                        <tr class="teacher-row transition hover:bg-gray-50"
                            data-teacher-name="{{ $teacher->teacher_name }}"
                            data-initial-status="{{ $teacher->status }}"
                            data-initial-reason="{{ $teacher->reason ?? '' }}">
                            <td class="py-4 px-6 text-gray-700 font-medium whitespace-nowrap">
                                {{ $teacher->teacher_name }}
                            </td>

                            <td class="py-4 px-6">
                                <span
                                    class="status-badge inline-flex px-3 py-1 rounded-full text-xs font-semibold w-fit {{ $teacher->status === 'present' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3 flex-wrap md:flex-nowrap">
                                    <select
                                        class="status-select border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white min-w-[150px] focus:ring-2 focus:ring-primary-100 focus:border-primary-900 outline-none">
                                        <option value="present" {{ $teacher->status === 'present' ? 'selected' : '' }}>
                                            ✅ Present
                                        </option>
                                        <option value="absent" {{ $teacher->status === 'absent' ? 'selected' : '' }}>
                                            ❌ Absent
                                        </option>
                                    </select>

                                    <div class="reason-wrap {{ $teacher->status === 'absent' ? '' : 'hidden' }}">
                                        <select
                                            class="reason-select border border-red-300 bg-red-50 rounded-lg px-3 py-2 text-sm min-w-[180px] focus:ring-2 focus:ring-red-100 focus:border-red-400 outline-none">
                                            <option value="">Select Reason</option>
                                            <option value="Sick Leave" {{ $teacher->reason === 'Sick Leave' ? 'selected' : '' }}>
                                                Sick Leave
                                            </option>
                                            <option value="Casual Leave" {{ $teacher->reason === 'Casual Leave' ? 'selected' : '' }}>
                                                Casual Leave
                                            </option>
                                            <option value="Personal Work" {{ $teacher->reason === 'Personal Work' ? 'selected' : '' }}>
                                                Personal Work
                                            </option>
                                            <option value="Other" {{ $teacher->reason === 'Other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>
                                    </div>

                                    <span class="reason-placeholder inline-flex items-center text-sm text-gray-400 {{ $teacher->status === 'absent' ? 'hidden' : '' }}">
                                        —
                                    </span>

                                    <button type="button"
                                        class="save-button inline-flex items-center gap-1 bg-primary-900 hover:bg-primary-800 text-white px-3 py-2 rounded-lg text-sm disabled:bg-gray-300 disabled:cursor-not-allowed whitespace-nowrap">
                                        ✔ Save
                                    </button>

                                    <span class="unsaved-indicator hidden text-xs font-medium text-amber-600 whitespace-nowrap">
                                        Unsaved changes
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const teacherRows = document.querySelectorAll('.teacher-row');
    const presentCountElement = document.getElementById('presentCount');
    const absentCountElement = document.getElementById('absentCount');

    function updateCounts() {
        let present = 0;
        let absent = 0;

        teacherRows.forEach((row) => {
            const status = row.querySelector('.status-select').value;

            if (status === 'present') {
                present += 1;
            } else if (status === 'absent') {
                absent += 1;
            }
        });

        presentCountElement.textContent = present;
        absentCountElement.textContent = absent;
    }

    function updateRowUI(row) {
        const statusSelect = row.querySelector('.status-select');
        const reasonWrap = row.querySelector('.reason-wrap');
        const reasonSelect = row.querySelector('.reason-select');
        const reasonPlaceholder = row.querySelector('.reason-placeholder');
        const statusBadge = row.querySelector('.status-badge');
        const saveButton = row.querySelector('.save-button');
        const unsavedIndicator = row.querySelector('.unsaved-indicator');

        const currentStatus = statusSelect.value;
        const isAbsent = currentStatus === 'absent';

        if (isAbsent) {
            reasonWrap.classList.remove('hidden');
            reasonPlaceholder.classList.add('hidden');
            reasonSelect.disabled = false;
            reasonSelect.className =
                'reason-select border border-red-300 bg-red-50 rounded-lg px-3 py-2 text-sm min-w-[180px] focus:ring-2 focus:ring-red-100 focus:border-red-400 outline-none';
            statusBadge.className =
                'status-badge inline-flex px-3 py-1 rounded-full text-xs font-semibold w-fit bg-red-100 text-red-700';
            statusBadge.textContent = 'Absent';
        } else {
            reasonWrap.classList.add('hidden');
            reasonPlaceholder.classList.remove('hidden');
            reasonSelect.value = '';
            reasonSelect.disabled = true;
            reasonSelect.className =
                'reason-select border border-gray-200 bg-gray-50 rounded-lg px-3 py-2 text-sm min-w-[180px] focus:ring-2 focus:ring-red-100 focus:border-red-400 outline-none';
            statusBadge.className =
                'status-badge inline-flex px-3 py-1 rounded-full text-xs font-semibold w-fit bg-green-100 text-green-700';
            statusBadge.textContent = 'Present';
        }

        const currentReason = isAbsent ? reasonSelect.value : '';
        const isChanged = row.dataset.initialStatus !== currentStatus || row.dataset.initialReason !== currentReason;

        row.classList.toggle('bg-amber-50', isChanged);
        unsavedIndicator.classList.toggle('hidden', !isChanged);
        saveButton.disabled = !isChanged;

        updateCounts();
    }

    teacherRows.forEach((row) => {
        const statusSelect = row.querySelector('.status-select');
        const reasonSelect = row.querySelector('.reason-select');
        const saveButton = row.querySelector('.save-button');

        statusSelect.addEventListener('change', () => updateRowUI(row));
        reasonSelect.addEventListener('change', () => updateRowUI(row));

        saveButton.addEventListener('click', () => {
            const status = statusSelect.value;
            const reason = status === 'absent' ? reasonSelect.value : '';

            console.log('Teacher attendance saved', {
                teacher_name: row.dataset.teacherName,
                status: status,
                reason: reason
            });

            row.dataset.initialStatus = status;
            row.dataset.initialReason = reason;
            updateRowUI(row);
        });

        updateRowUI(row);
    });
</script>
@endsection
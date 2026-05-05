@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    {{-- @php
        $teacherRows = collect($teachers)->where('school_id', SchoolLogin()->id);

        $total = $teacherRows->count();
        $present = $teacherRows->where('status', 'present')->count();
        $absent = $teacherRows->where('status', 'absent')->count();
    @endphp --}}


    <div class="p-8 bg-gray-100 min-h-screen">
        <div class="flex flex-col gap-6 mb-6">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">Assing Subjects</h1>
                    <p class="text-sm text-gray-500">Mark and manage daily syllabus records.</p>
                </div>
               
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl shadow-sm border p-5">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">School & Teacher Details</h2>
                    <div class="space-y-2 text-sm text-gray-600">
                        <div><span class="font-semibold text-gray-800">Name:</span> {{ $teacher->name ?? '-' }}</div>
                        <div><span class="font-semibold text-gray-800">School Name:</span>
                            {{ $teacher->school->school_name ?? '-' }}</div>
                        <div><span class="font-semibold text-gray-800">Phone Number:</span>
                            {{ $teacher->staff->phone ?? '-' }}</div>
                        <div><span class="font-semibold text-gray-800">Email:</span> {{ $teacher->staff->email ?? '-' }}
                        </div>
                        {{-- <div><span class="font-semibold text-gray-800">Phone:</span> {{ $school->school_phone ?? '-' }}</div>  --}}
                    </div>
                </div>
                {{-- <div class="bg-white rounded-2xl shadow-sm border p-5">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Assigned Syllabus</h2>
                    <div class="text-sm text-gray-600 space-y-2">
                        <div><span class="font-semibold text-gray-800">Total Assignments:</span> {{ $records->count() }}</div>
                        <div><span class="font-semibold text-gray-800">Teachers:</span> {{ $records->pluck('teacher.name')->unique()->filter()->count() }}</div>
                        <div><span class="font-semibold text-gray-800">Classes:</span> {{ $records->pluck('class.name')->unique()->filter()->count() }}</div>
                        <div><span class="font-semibold text-gray-800">Subjects:</span> {{ $records->pluck('subject.subject_name')->unique()->filter()->count() }}</div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="space-y-6">
            {{-- <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">
                <div class="flex gap-8 text-sm">
                    <div>
                        <p class="text-gray-500">TOTAL TEACHERS</p>
                        <h3 class="font-semibold text-gray-800"></h3>
                    </div>

                    <div>
                        <p class="text-gray-500">Subject</p>
                        <h3 id="presentCount" class="font-semibold text-green-600"></h3>
                    </div>

                    <div>
                        <p class="text-gray-500"></p>
                        <h3 id="absentCount" class="font-semibold text-red-500"></h3>
                    </div>
                </div>
                <div class="flex gap-4">

                    <button onclick="history.back()"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                        ← Back
                    </button>
                </div>

            </div> --}}

            <div class="bg-white rounded-2xl shadow-md border border-gray-100">
                <div class="flex justify-between items-center px-6 py-4 border-b">
                    <h2 class="font-semibold text-lg text-gray-700">👩‍🏫 Syllabus List</h2>
                </div>

                <div class="overflow-x-auto bg-white rounded-xl shadow">

                    <table class="w-full text-sm">

                        <!-- Head -->
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="py-3 px-6 text-left">Teacher</th>
                                <th class="py-3 px-6 text-left">Subjects</th>
                                <th class="py-3 px-6 text-left">Topics</th>
                                <th class="py-3 px-6 text-left">Class</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($records as $record)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="py-4 px-6 text-left">
                                        {{ $record->teacher->name ?? 'N/A' }}
                                        <div class="text-xs text-gray-500 mt-1">{{ $record->teacher->designation ?? '' }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-left">
                                        {{ $record->subject->subject_name ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6 text-left">
                                        @if ($record->topic && is_array($record->topic->topics))
                                            {{ implode(', ', $record->topic->topics) }}
                                        @else
                                            {{ $record->topic->topics ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-left">
                                        {{ $record->class->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6 text-left">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $record->status ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($record->status ?? '') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm text-gray-500">
                                        <form action="{{ route('subject.status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="sublist_id" value="{{ $record->sublist_id }}">
                                            <input type="hidden" name="teacher_id" value="{{ TeacherLog()->staff_id ?? "" }}">
                                            <select name="status" id="" class="w-full border rounded p-2" onchange="submit()">
                                                <option value="">---Select Status---</option>
                                                <option value="pending" @selected($record->status === 'pending')>Pending</option>
                                                <option value="completed" @selected($record->status === 'completed')>Completed</option>
                                            </select>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 px-6 text-center text-sm text-gray-500">
                                        No syllabus assignments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
            <div>

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

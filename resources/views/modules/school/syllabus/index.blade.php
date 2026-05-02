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
        <div class="flex justify-between items-center mb-6">

            <!-- Left -->
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Syllabus Managements</h1>
                <p class="text-sm text-gray-500">
                    Mark and manage daily Syllabus  records.
                </p>
            </div>

            <!-- Right Button -->
            <a href="{{ route('create.syllabus') }}"
                class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow-sm">
                <span>+Add Syllabus</span>
            </a>

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
                    <h2 class="font-semibold text-lg text-gray-700">👩‍🏫 Syllabus  List</h2>
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

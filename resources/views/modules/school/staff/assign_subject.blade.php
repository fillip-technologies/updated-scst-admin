@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
                showConfirmButton: true
            })
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}",
                showConfirmButton: true
            })
        </script>
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div class="syl-card bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-blue-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-indigo-100">
                        <i class="fa-solid fa-chalkboard-user text-indigo-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800 text-lg">My Syllabus</h2>
                        <p class="text-sm text-gray-500">
                            <i class="fa-solid fa-graduation-cap mr-1"></i> Class: {{ $class }} |
                            <i class="fa-solid fa-book-open mr-1"></i> Subject: {{ $subjectname }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">

                @forelse($groupedData as $className => $records)
                    <details class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
                        <summary
                            class="cursor-pointer px-5 py-4 bg-indigo-50 font-semibold text-indigo-700 flex justify-between items-center">
                            <span>
                                <i class="fa-solid fa-graduation-cap mr-2"></i>
                                {{ $className }}
                            </span>
                        </summary>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left">S.No</th>
                                        <th class="px-4 py-3 text-left">Subject</th>
                                        <th class="px-4 py-3 text-left">Topic</th>
                                        <th class="px-4 py-3 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($records as $topic)
                                        <tr class="border-t hover:bg-gray-50">

                                            <td class="px-4 py-3">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <span
                                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                                                    {{ $topic->subject_name }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $topic->topics_name }}
                                            </td>



                                            <td class="px-4 py-3 text-center">
                                                <button
                                                    onclick="openRemarkModal('{{ TeacherLog()->staff_id ?? 0 }}',
                                        '{{ TeacherLog()->school_id ?? 0 }}',
                                        '{{ $topic->subject_name }}',
                                        '{{ $className }}',
                                        '{{ $topic->topics_name }}')"
                                                    class="text-indigo-600 hover:text-indigo-800">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </details>

                @empty
                    <div class="text-center py-10 text-gray-500">
                        No syllabus data found
                    </div>
                @endforelse

            </div>

            <!-- Footer -->
            <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-xs text-gray-500">
                        <i class="fa-regular fa-clock mr-1"></i> Last updated: {{ now()->format('d M Y, h:i A') }}
                    </div>
                    <div class="flex gap-2">
                        <span class="text-xs text-gray-500">Total Topics:
                            {{ $groupedData->sum(function ($records) {return $records->count();}) }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200 ">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Class</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Subject</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Topic</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>

                        <th class="px-4 py-3 text-left text-sm font-semibold">Remarks</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach ($viewstatus as $item)
                        <tr class=" border-b hover:bg-blue-50 transition ">
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $item->class_name }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $item->subject }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $item->topic_name }}
                            </td>

                            <td class="px-4 py-3">
                                @if ($item->status == 'completed')
                                    <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                        Completed
                                    </span>
                                @elseif($item->status == 'ongoing')
                                    <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                        Ongoing
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                        Pending
                                    </span>
                                @endif
                            </td>



                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $item->remarks ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Remark Modal -->
    <div id="remarkModal" class="fixed inset-0 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fa-solid fa-pen-to-square text-indigo-500 mr-2"></i>
                    Update Status & Remark
                </h3>
                <button onclick="closeRemarkModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
            <form action="{{ route('subject.status.update') }}" method="POST">
                @csrf
                <input type="hidden" id="schoolID" name="school_id">
                <input type="hidden" id="teacherID" name="teacher_id">
                <input type="hidden" id="subject_name" name="subject">
                <input type="hidden" id="class_name" name="class_name">
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-tag text-indigo-500 mr-1"></i> Topic
                        </label>
                        <input type="text" name="topic_name" id="topic" readonly
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-flag-checkered text-indigo-500 mr-1"></i> Status
                        </label>
                        <select id="modalStatus" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="pending">🔴 Pending</option>
                            <option value="ongoing">🟡 Ongoing</option>
                            <option value="completed">🟢 Completed</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-comment text-indigo-500 mr-1"></i> Remark
                        </label>
                        <textarea id="modalRemark" rows="4" name="remarks"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Enter your remark here..."></textarea>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                    <button onclick="closeRemarkModal()"
                        class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white hover:from-indigo-600 hover:to-indigo-700 transition-all shadow-md">
                        <i class="fa-solid fa-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openRemarkModal(teacherID, schoolID, subject, class_name, topic) {
            document.getElementById('teacherID').value = teacherID;
            document.getElementById('schoolID').value = schoolID;
            document.getElementById('subject_name').value = subject;
            document.getElementById('class_name').value = class_name;
            document.getElementById('topic').value = topic;
            document.getElementById('remarkModal').classList.remove('hidden');
            document.getElementById('remarkModal').classList.add('flex');
        }

        function closeRemarkModal() {
            document.getElementById('remarkModal').classList.add('hidden');
            document.getElementById('remarkModal').classList.remove('flex');
        }

        // function saveRemark() {
        //     const status = document.getElementById('modalStatus').value;
        //     const remark = document.getElementById('modalRemark').value;

        //     // AJAX call to update status and remark
        //     fetch('', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         body: JSON.stringify({
        //             id: currentTopicId,
        //             topic_name: currentTopicName,
        //             status: status,
        //             remark: remark
        //         })
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         if(data.success) {
        //             alert('Updated successfully!');
        //             location.reload();
        //         } else {
        //             alert('Error updating: ' + data.message);
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //         alert('Updated successfully! (Demo mode)');
        //         closeRemarkModal();
        //         // location.reload();
        //     });
        // }

        // Close modal when clicking outside
        document.getElementById('remarkModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRemarkModal();
            }
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

@endsection

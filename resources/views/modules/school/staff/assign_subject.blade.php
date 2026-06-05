@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-700">
                <tr class="border-b border-gray-200">
                    <th class="px-6 py-3 text-left font-semibold w-16">S.No</th>
                    <th class="px-6 py-3 text-left font-semibold">Topics / Syllabus</th>
                    <th class="px-6 py-3 text-center font-semibold w-32">Status</th>
                    <th class="px-6 py-3 text-left font-semibold w-64">Remark</th>
                    <th class="px-6 py-3 text-center font-semibold w-24">Action</th>
                </tr>
            </thead>
            <tbody id="syllabusBody" class="divide-y divide-gray-100">
                @forelse($groupedData as $className => $records)
                    @foreach($records as $index => $topic)
                        @php
                            $status = $topic->status ?? 'pending';
                            $statusColor = $status == 'completed' ? 'green' : ($status == 'ongoing' ? 'yellow' : 'red');
                            $statusText = $status == 'completed' ? 'Completed' : ($status == 'ongoing' ? 'Ongoing' : 'Pending');
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 text-gray-700 font-medium">{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <i class="fa-regular fa-file-lines text-indigo-500"></i>
                                    <span class="text-gray-800">{{ $topic->topics_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if($status == 'completed') bg-green-100 text-green-800
                                    @elseif($status == 'ongoing') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <span class="text-sm text-gray-600 line-clamp-2">{{ $topic->remark ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <button onclick="openRemarkModal('{{ $topic->topics_name }}', '{{ $status }}', '{{ $topic->remark ?? '' }}', {{ $topic->id }})"
                                        class="text-indigo-500 hover:text-indigo-700 transition-colors">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
                            No topics found for this subject
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-xs text-gray-500">
                <i class="fa-regular fa-clock mr-1"></i> Last updated: {{ now()->format('d M Y, h:i A') }}
            </div>
            <div class="flex gap-2">
                <span class="text-xs text-gray-500">Total Topics: {{ $groupedData->sum(function($records) { return $records->count(); }) }}</span>
            </div>
        </div>
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

        <div class="px-6 py-4">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fa-solid fa-tag text-indigo-500 mr-1"></i> Topic
                </label>
                <input type="text" id="modalTopic" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fa-solid fa-flag-checkered text-indigo-500 mr-1"></i> Status
                </label>
                <select id="modalStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="pending">🔴 Pending</option>
                    <option value="ongoing">🟡 Ongoing</option>
                    <option value="completed">🟢 Completed</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fa-solid fa-comment text-indigo-500 mr-1"></i> Remark
                </label>
                <textarea id="modalRemark" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your remark here..."></textarea>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
            <button onclick="closeRemarkModal()" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
                Cancel
            </button>
            <button onclick="saveRemark()" class="px-4 py-2 rounded-lg bg-gradient-to-r from-indigo-500 to-indigo-600 text-white hover:from-indigo-600 hover:to-indigo-700 transition-all shadow-md">
                <i class="fa-solid fa-save mr-1"></i> Save Changes
            </button>
        </div>
    </div>
</div>

<script>
    let currentTopicId = null;
    let currentTopicName = '';

    function openRemarkModal(topicName, status, remark, topicId) {
        currentTopicId = topicId;
        currentTopicName = topicName;

        document.getElementById('modalTopic').value = topicName;
        document.getElementById('modalStatus').value = status;
        document.getElementById('modalRemark').value = remark;

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

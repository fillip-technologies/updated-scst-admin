@extends('layouts.app')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Academic Activities
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage student performance, exam results, and academic records.
            </p>
        </div>

        <button class="bg-primary-900 text-white px-5 py-2.5 rounded-lg text-sm">
            Upload Result Sheet
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-8 border-b mb-8 text-sm font-medium">
        <button onclick="switchTab('exam')" id="examTab"
            class="text-primary-900 border-b-2 border-primary-900 pb-3">
            Exam Results
        </button>

        <button onclick="switchTab('progress')" id="progressTab"
            class="text-gray-500 pb-3">
            Student Progress
        </button>
    </div>

    <!-- Include Files -->
    <div id="examSection">
        @include('modules.school.academics.exam-results')
    </div>

    <div id="progressSection" class="hidden">
        @include('modules.school.academics.student-progress')
    </div>

</div>

<script>
    function switchTab(tab) {
        document.getElementById('examSection').classList.toggle('hidden', tab !== 'exam');
        document.getElementById('progressSection').classList.toggle('hidden', tab !== 'progress');

        document.getElementById('examTab').classList.toggle('text-primary-900', tab === 'exam');
        document.getElementById('progressTab').classList.toggle('text-primary-900', tab === 'progress');
    }
</script>

@endsection
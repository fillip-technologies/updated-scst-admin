@extends('layouts.app')

@section('content')
{{-- Main Wrapper --}}
<div class="p-3 sm:p-4 lg:p-6 bg-gray-100 min-h-screen overflow-x-hidden">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                📘 Syllabus Tracking
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Track and monitor syllabus completion across schools, classes, and subjects.
            </p>
        </div>
    </div>

    {{-- Filter Section --}}
    <form action="{{ route('tracking.syllabus.serach') }}" method="GET">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-5 mb-5">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-700">
                    🔍 Filter Options
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                {{-- District --}}
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        District
                    </label>

                    <select id="filterDistrict" name="district"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">Select District</option>

                        @foreach (getDisc() as $dist)
                            <option value="{{ $dist->district }}">
                                {{ $dist->district }}
                            </option>
                        @endforeach

                    </select>

                    @error('district')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- School --}}
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        School
                    </label>

                    <select id="filterSchool" name="school"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">Select School</option>

                    </select>

                    @error('school')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Class --}}
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Class
                    </label>

                    <select id="filterClass" name="class"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">Select Class</option>

                    </select>

                    @error('class')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Subject --}}
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Subject
                    </label>

                    <select id="filterSubject" name="subject"
                        class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <option value="">Select Subject</option>

                    </select>

                    @error('subject')
                        <span class="text-red-500 text-xs">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex flex-wrap gap-3 mt-5">

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-sm">

                    🔍 Show

                </button>

                <a href="{{ url('admin/syllabusTraking') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2.5 rounded-xl text-sm font-medium transition">

                    ↻ Reset

                </a>

            </div>

        </div>

    </form>

    {{-- Result Table --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">

        {{-- Table Header --}}
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 px-4 sm:px-6 py-4 border-b bg-gray-50">

            <h2 class="text-lg font-semibold text-gray-700">
                📋 Syllabus Tracking Report
            </h2>

            <span class="text-sm text-gray-500">
                Total Records :
                <strong>{{ count($records ?? []) }}</strong>
            </span>

        </div>

        {{-- Responsive Table --}}
        <div class="overflow-x-auto w-full">

            <table class="min-w-[1100px] w-full text-sm">

                {{-- Head --}}
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">

                    <tr>

                        <th class="px-4 py-3 text-left whitespace-nowrap">
                            #
                        </th>

                        <th class="px-4 py-3 text-left whitespace-nowrap">
                            School
                        </th>

                        <th class="px-4 py-3 text-left whitespace-nowrap">
                            Teacher
                        </th>

                        <th class="px-4 py-3 text-left whitespace-nowrap">
                            Subject
                        </th>

                        <th class="px-4 py-3 text-left whitespace-nowrap">
                            Topics
                        </th>

                        <!--<th class="px-4 py-3 text-center whitespace-nowrap">-->
                        <!--    Progress-->
                        <!--</th>-->

                        <th class="px-4 py-3 text-center whitespace-nowrap">
                            Status
                        </th>

                        <th class="px-4 py-3 text-center whitespace-nowrap">
                            Action
                        </th>

                    </tr>

                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse ($records ?? [] as $index => $item)

                        @php

                            $progressPercent = $item->persantege ?? 0;

                            if ($progressPercent >= 80) {
                                $progressColor = 'bg-green-500';
                                $status = 'Completed';
                                $statusClass = 'bg-green-100 text-green-700';
                                $statusIcon = '✅';
                            } elseif ($progressPercent >= 40) {
                                $progressColor = 'bg-yellow-500';
                                $status = 'Ongoing';
                                $statusClass = 'bg-yellow-100 text-yellow-700';
                                $statusIcon = '⏳';
                            } else {
                                $progressColor = 'bg-red-500';
                                $status = 'Pending';
                                $statusClass = 'bg-red-100 text-red-700';
                                $statusIcon = '❌';
                            }

                        @endphp

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Index --}}
                            <td class="px-4 py-4 font-medium text-gray-600">
                                {{ $index + 1 }}
                            </td>

                            {{-- School --}}
                            <td class="px-4 py-4">

                                <div class="space-y-1">

                                    <p class="font-semibold text-gray-800 whitespace-nowrap">
                                        {{ $item->school->school_name ?? 'N/A' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->school->district ?? 'N/A' }}
                                    </p>

                                </div>

                            </td>

                            {{-- Teacher --}}
                            <td class="px-4 py-4">

                                <div class="space-y-1">

                                    <p class="font-medium text-gray-800 whitespace-nowrap">
                                        {{ $item->teacher->name ?? 'N/A' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->teacher->email ?? 'N/A' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->teacher->phone ?? 'N/A' }}
                                    </p>

                                </div>

                            </td>

                            {{-- Subject --}}
                            <td class="px-4 py-4">

                                <div class="space-y-1">

                                    <p class="font-medium text-gray-800">
                                        {{ $item->subject->subject_name ?? 'N/A' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Class :
                                        {{ $item->class->name ?? 'N/A' }}
                                    </p>

                                </div>

                            </td>

                            {{-- Topics --}}
                            <td class="px-4 py-4 min-w-[250px]">

                                <select
                                    class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                    <option value="">
                                        Select Topic
                                    </option>

                                    @foreach (json_decode($item->topic->topics) ?? [] as $topic)
                                        <option>
                                            {{ $topic }}
                                        </option>
                                    @endforeach

                                </select>

                               <p class="text-xs text-gray-500 mt-2">
    Created At :
    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
</p>

<p class="text-xs text-gray-500">
    Completion Time :
    {{ $item->completion_time }} Days
</p>

                            </td>

                            {{-- Progress --}}
                            <!--<td class="px-4 py-4 text-center min-w-[160px]">-->

                            <!--    <div class="flex items-center gap-2 justify-center">-->

                            <!--        <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">-->

                            <!--            <div class="{{ $progressColor }} h-full rounded-full"-->
                            <!--                style="width: {{ $progressPercent }}%">-->
                            <!--            </div>-->

                            <!--        </div>-->

                            <!--        <span class="text-xs font-semibold text-gray-700">-->
                            <!--            {{ $progressPercent }}%-->
                            <!--        </span>-->

                            <!--    </div>-->

                            <!--</td>-->

                            {{-- Status --}}
                            <td class="px-4 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap {{ $statusClass }}">

                                    {{ $statusIcon }}
                                    {{ $status }}

                                </span>

                            </td>

                            {{-- Action --}}
                            <td class="px-4 py-4 text-center">

                                <button onclick="openMailModal('{{ $item->teacher->email ?? '' }}')"
                                    class="bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 px-4 py-2 rounded-xl text-xs font-medium whitespace-nowrap transition">

                                    ✉️ Send Mail

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-14">

                                <div class="text-6xl mb-3">
                                    📚
                                </div>

                                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                                    Display Data Here
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Select filters and click
                                    <strong>"Show"</strong>
                                    to view syllabus tracking data.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

    <div id="mailModal" class="fixed inset-0  bg-opacity-50 hidden justify-center items-center z-50">

        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">

            <div class="flex justify-between items-center mb-4">

                <h2 class="text-lg font-semibold text-gray-700">
                    Send Mail
                </h2>

                <button onclick="closeMailModal()" class="text-gray-400 hover:text-red-500 text-xl">

                    ×

                </button>

            </div>

            <form action="" method="POST">

                @csrf

                <input type="hidden" name="email" id="teacherEmail">

                <div class="mb-4">

                    <label class="block text-sm font-medium text-gray-600 mb-1">

                        Subject

                    </label>

                    <input type="text" name="subject"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 outline-none" required>

                </div>

                <div class="mb-4">

                    <label class="block text-sm font-medium text-gray-600 mb-1">

                        Message

                    </label>

                    <textarea name="message" rows="4"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 outline-none" required></textarea>

                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium">

                    Send Mail

                </button>

            </form>

        </div>

    </div>

    <script>
        // school data
        $(document).ready(function() {
            var allschool = $("#filterSchool");

            $("#filterDistrict").on('change', function() {
                var value = $(this).val();

                $.ajax({
                    url: "get/school/" + value,
                    type: "GET",
                    success: function(res) {

                        var datas = res.data;
                        var options = `<option value="">Select School</option>`;


                        $.each(datas, function(key, school) {
                            options +=
                                `<option value="${school.id}">${school.school_name}</option>`;
                        });

                        allschool.html(options);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

        // get classs data
        $(document).ready(function() {
            var classroom = $("#filterClass");

            $("#filterSchool").on('change', function() {
                var value = $(this).val();
                $.ajax({
                    url: "get/class/data/" + value,
                    type: "GET",
                    success: function(res) {

                        var datas = res.data;
                        var options = `<option value="">Select Class</option>`;


                        $.each(datas, function(key, classdata) {
                            options +=
                                `<option value="${classdata.id}">${classdata.name}</option>`;
                        });

                        classroom.html(options);
                    },
                    error: function(error) {
                        console.log(error.message);
                    }
                });
            });
        });

        // subject data
        $(document).ready(function() {
            var allsubject = $("#filterSubject");

            $("#filterSchool").on('change', function() {
                var value = $(this).val();
                $.ajax({
                    url: "get/subject/data/" + value,
                    type: "GET",
                    success: function(res) {


                        var datas = res.data;
                        var options = `<option value="">Select Subject</option>`;


                        $.each(datas, function(key, subject) {
                            options +=
                                `<option value="${subject.id}">${subject.subject_name}</option>`;
                        });

                        allsubject.html(options);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });



        function openMailModal(email) {

            document.getElementById('teacherEmail').value = email;

            document.getElementById('mailModal').classList.remove('hidden');

            document.getElementById('mailModal').classList.add('flex');
        }

        function closeMailModal() {

            document.getElementById('mailModal').classList.add('hidden');

            document.getElementById('mailModal').classList.remove('flex');
        }
    </script>


@endsection

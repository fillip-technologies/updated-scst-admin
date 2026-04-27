@extends('layouts.app')

@section('content')
<style>
    .dataTables_wrapper {
        padding-top: 10px;
    }

    .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 6px 10px;
        margin-left: 5px;

    }

    .dataTables_length select {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        width: 200px;
        margin-bottom: 10px;
        padding: 5px;
    }

    .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        padding: 5px 10px !important;
        margin: 2px;
    }
</style>


<div class="p-6 bg-white rounded-2xl shadow border border-gray-200">

    <!-- Title -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
            School Report List
        </h2>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="reportTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

            <!-- Header -->
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">District</th>
                    <th class="px-4 py-3 text-left">School Code</th>
                    <th class="px-4 py-3 text-left">School Name</th>
                    <th class="px-4 py-3 text-left">Total Students</th>
                    <th class="px-4 py-3 text-left">Dropouts</th>
                    <th class="px-4 py-3 text-left">Current Students</th>
                    <th class="px-4 py-3 text-left">Attendance %</th>
                    <th class="px-4 py-3 text-left">Board Passed</th>
                    <th class="px-4 py-3 text-left">Competency Tested</th>
                    <th class="px-4 py-3 text-left">Coaching</th>
                    <th class="px-4 py-3 text-left">Appearing Exams</th>
                    <th class="px-4 py-3 text-left">Skill Exposure</th>
                    <th class="px-4 py-3 text-left">Created</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-sm text-gray-700 divide-y">

                @forelse($reports as $report)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3">{{ $report->district ?? '-' }}</td>

                        <td class="px-4 py-3">{{ $report->school_code ?? '-' }}</td>

                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ $report->school_name ?? '-' }}
                        </td>

                        <!-- ❗ FIX: double underscore removed -->
                        <td class="px-4 py-3">
                            {{ $report->total_enrolled_students ?? '-' }}
                        </td>

                        <td class="px-4 py-3 text-red-600">
                            {{ $report->dropouts_students ?? '0' }}
                        </td>

                        <td class="px-4 py-3 text-green-600">
                            {{ $report->current_students_enrolled ?? '-' }}
                        </td>

                        <!-- ✅ Attendance FIX -->
                        <td class="px-4 py-3">
                            @if($report->student_attendance_percentage !== null)
                                {{ $report->student_attendance_percentage > 1
                                    ? number_format($report->student_attendance_percentage, 2)
                                    : number_format($report->student_attendance_percentage * 100, 2) }}%
                            @else
                                -
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_passed_board_exams ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_tested_competency ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_enrolled_coaching == 'NA' ? '-' : $report->students_enrolled_coaching }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_appearing_exams ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_skill_exposure ?? '-' }}
                        </td>

                        <td class="px-4 py-3 text-gray-500 text-xs">
                            {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y') }}
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="13" class="text-center py-6 text-gray-500">
                            No Data Found
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>


<script>
    $(document).ready(function () {
        $('#reportTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            lengthChange: true,
            responsive: true,
            autoWidth: false,
            language: {
                search: "🔍 Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ records",
                paginate: {
                    next: "Next",
                    previous: "Prev"
                }
            }

        });

        
    });
</script>

<!-- ✅ Tailwind Friendly Styling -->


@endsection

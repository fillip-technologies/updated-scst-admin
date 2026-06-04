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

    /* Proper border + overflow fix */
    .table-container {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-scroll {
        overflow-x: auto;
    }
</style>

<div class="p-6 bg-white rounded-2xl shadow border border-gray-200">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
            School Report List
        </h2>
    </div>

    <div class="table-container">
        <div class="table-scroll">

            <table id="reportTable" class="min-w-full w-full text-sm">

                <!-- ✅ 13 columns -->
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th>District</th>
                        <th>School Code</th>
                        <th>School Name</th>
                        <th>Total Students</th>
                        <th>Dropouts</th>
                        <th>Current Students</th>
                        <th>Attendance %</th>
                        <th>Board Passed</th>
                        <th>Competency Tested</th>
                        <th>Coaching</th>
                        <th>Appearing Exams</th>
                        <th>Skill Exposure</th>
                        <th>Created</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reports as $report)
                        <tr class="border-t">

                            <td>{{ $report->district ?? '-' }}</td>
                            <td>{{ $report->school_code ?? '-' }}</td>
                            <td class="font-medium">{{ $report->school_name ?? '-' }}</td>

                            <td>{{ $report->total_enrolled_students ?? '-' }}</td>

                            <td class="text-red-600">
                                {{ $report->dropouts_students ?? 0 }}
                            </td>

                            <td class="text-green-600">
                                {{ $report->current_students_enrolled ?? '-' }}
                            </td>

                            <td>
                                @if($report->student_attendance_percentage !== null)
                                    {{ $report->student_attendance_percentage > 1
                                        ? number_format($report->student_attendance_percentage, 2)
                                        : number_format($report->student_attendance_percentage * 100, 2) }}%
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $report->students_passed_board_exams ?? '-' }}</td>
                            <td>{{ $report->students_tested_competency ?? '-' }}</td>

                            <td>
                                {{ $report->students_enrolled_coaching == 'NA'
                                    ? '-'
                                    : $report->students_enrolled_coaching }}
                            </td>

                            <td>{{ $report->students_appearing_exams ?? '-' }}</td>
                            <td>{{ $report->students_skill_exposure ?? '-' }}</td>

                            <td class="text-xs text-gray-500">
                                {{ $report->created_at
                                    ? \Carbon\Carbon::parse($report->created_at)->format('d M Y')
                                    : '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <!-- ✅ MUST MATCH 13 -->
                            <td colspan="13" class="text-center py-6 text-gray-500">
                                No Data Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

<script>
$(document).ready(function () {

    // ✅ HARD FIX: remove old instance completely
    if ($.fn.DataTable.isDataTable('#reportTable')) {
        $('#reportTable').DataTable().clear().destroy();
    }

    // ✅ Fresh initialization
    $('#reportTable').DataTable({
        pageLength: 10,
        ordering: true,
        searching: true,
        lengthChange: true,
        responsive: true,
        autoWidth: false,
        destroy: true,
        deferRender: true,
        language: {
            search: "🔍 Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ records",
            zeroRecords: "No matching records found",
            paginate: {
                next: "Next",
                previous: "Prev"
            }
        }
    });

});
</script>

@endsection
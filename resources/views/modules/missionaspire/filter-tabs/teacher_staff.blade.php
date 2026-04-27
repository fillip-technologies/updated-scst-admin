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

    /* Fix overflow on small screens */
    /* .table-wrapper {
        overflow-x: auto;
    } */
</style>

<div class="p-6 bg-white rounded-2xl shadow border border-gray-200">

    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold text-gray-800">
            Teacher & Staff Report
        </h2>
    </div>

    <!-- Table Wrapper -->
    <div class="table-wrapper">
        <table id="reportTable" class="min-w-full w-full border border-gray-200 rounded-xl">

            <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">School</th>
                    <th class="px-4 py-3 text-left">District</th>
                    <th class="px-4 py-3 text-left">Sanctioned</th>
                    <th class="px-4 py-3 text-left">Dept</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Vacant</th>
                    <th class="px-4 py-3 text-left">Left</th>
                    <th class="px-4 py-3 text-left">Attendance</th>
                    <th class="px-4 py-3 text-left">Satisfaction</th>
                    <th class="px-4 py-3 text-left">Training</th>
                    <th class="px-4 py-3 text-left">Accommodation</th>
                    <th class="px-4 py-3 text-left">Award</th>
                    <th class="px-4 py-3 text-left">Exposure</th>
                    <th class="px-4 py-3 text-left">NT Sanctioned</th>
                    <th class="px-4 py-3 text-left">NT Filled</th>
                    <th class="px-4 py-3 text-left">NT Vacant</th>
                    <th class="px-4 py-3 text-left">Code</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($reports as $report)
                    <tr class="border-t">

                        <td class="px-4 py-3 font-medium text-gray-900">{{ $report->school_name ?? '-' }}</td>
                        <td>{{ $report->district ?? '-' }}</td>

                        <td>{{ $report->sanctioned_teacher_posts ?? '-' }}</td>
                        <td>{{ $report->teachers_posted_departmental ?? '-' }}</td>

                        <td class="text-green-600 font-medium">
                            {{ $report->teachers_posted_total ?? '-' }}
                        </td>

                        <td class="text-red-600 font-medium">
                            {{ $report->vacant_teacher_posts ?? 0 }}
                        </td>

                        <td>{{ $report->teachers_left_last_year ?? 0 }}</td>

                        <td>
                            {{ $report->teacher_attendance_percentage !== null
                                ? number_format($report->teacher_attendance_percentage * 100, 1) . '%'
                                : '-' }}
                        </td>

                        <td>
                            {{ $report->teacher_satisfaction_score
                                ? $report->teacher_satisfaction_score . '/10'
                                : '-' }}
                        </td>

                        <td>{{ $report->teacher_training_conducted ?? 0 }}</td>
                        <td>{{ $report->teacher_accommodation_available ?? '-' }}</td>
                        <td>{{ $report->best_teacher_award_given ?? '-' }}</td>
                        <td>{{ $report->exposure_visit_conducted ?? 0 }}</td>

                        <td>{{ $report->sanctioned_non_teaching_posts ?? '-' }}</td>

                        <td class="text-green-600 font-medium">
                            {{ $report->filled_non_teaching_posts ?? '-' }}
                        </td>

                        <td class="text-red-600 font-medium">
                            {{ $report->vacant_non_teaching_posts ?? 0 }}
                        </td>

                        <td class="text-xs text-gray-400">
                            {{ $report->school_code ?? '-' }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="17" class="text-center py-4 text-gray-500">
                            No data available
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

{{-- IMPORTANT: Make sure these are loaded in your layout --}}
{{-- jQuery + DataTables CSS/JS required --}}
<script>
    $(document).ready(function () {
        $('#reportTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            lengthChange: true,
            responsive: true,
            autoWidth: false,
            destroy: true, // prevents reinitialization error
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

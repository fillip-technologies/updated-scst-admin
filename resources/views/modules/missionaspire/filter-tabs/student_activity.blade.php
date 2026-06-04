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

    /* Border + overflow hidden (outer) */
    .table-container {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    /* Scroll inside */
    .table-scroll {
        overflow-x: auto;
    }
</style>

<div class="p-6 bg-white rounded-2xl shadow border border-gray-200">

    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold text-gray-800">
            Student Activity Report
        </h2>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-scroll">
            <table id="studentTable" class="min-w-full w-full text-sm">

                <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                    <tr>
                        <th>School</th>
                        <th>District</th>
                        <th>Total</th>
                        <th>Co-curricular</th>
                        <th>Sports</th>
                        <th>Dist/State Sports</th>
                        <th>Career Sessions</th>
                        <th>Voc Eligible</th>
                        <th>Voc Enrolled</th>
                        <th>Comp Eligible</th>
                        <th>Comp Enrolled</th>
                        <th>Appearing</th>
                        <th>Festival</th>
                        <th>Debates</th>
                        <th>Code</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reports as $report)
                        <tr class="border-t">

                            <td class="px-4 py-3 font-medium text-gray-900">{{ $report->school_name ?? '-' }}</td>
                            <td>{{ $report->district ?? '-' }}</td>

                            <td class="font-medium">
                                {{ $report->total_students ?? 0 }}
                            </td>

                            <td>{{ $report->students_cocurricular ?? 0 }}</td>
                            <td>{{ $report->students_sports ?? 0 }}</td>

                            <td class="text-green-600">
                                {{ $report->students_district_state_sports ?? 0 }}
                            </td>

                            <td>{{ $report->career_guidance_sessions ?? 0 }}</td>

                            <td>{{ $report->eligible_vocational_students ?? 0 }}</td>
                            <td class="text-blue-600">
                                {{ $report->enrolled_vocational_students ?? 0 }}
                            </td>

                            <td>{{ $report->eligible_competitive_students ?? 0 }}</td>
                            <td class="text-blue-600">
                                {{ $report->enrolled_competitive_students ?? 0 }}
                            </td>

                            <td class="text-green-600 font-medium">
                                {{ $report->students_appearing_competitive ?? 0 }}
                            </td>

                            <td>{{ $report->annual_talent_festival ?? '-' }}</td>
                            <td>{{ $report->debate_events_count ?? 0 }}</td>

                            <td class="text-xs text-gray-400">
                                {{ $report->school_code ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center py-4 text-gray-500">
                                No data available
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
        $('#studentTable').DataTable({
            pageLength: 10,
            responsive: true,
            autoWidth: false,
            destroy: true,
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

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

    /* Proper border + overflow */
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

    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold text-gray-800">
            PTM & Parent Engagement Report
        </h2>
    </div>

    <div class="table-container">
        <div class="table-scroll">

            <table id="ptmTable" class="min-w-full w-full text-sm">

                <!-- ✅ 10 columns -->
                <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                    <tr>
                        <th>School</th>
                        <th>District</th>
                        <th>PTM</th>
                        <th>Invited</th>
                        <th>Attended</th>
                        <th>Reports</th>
                        <th>Grievances</th>
                        <th>Resolved</th>
                        <th>Committee</th>
                        <th>Code</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reports as $report)
                        <tr class="border-t">

                            <!-- 1 -->
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $report->school_name ?? '-' }}</td>

                            <!-- 2 -->
                            <td>{{ $report->district ?? '-' }}</td>

                            <!-- 3 -->
                            <td>{{ $report->ptm_conducted_count ?? 0 }}</td>

                            <!-- 4 -->
                            <td>{{ $report->parents_invited_last_ptm ?? 0 }}</td>

                            <!-- 5 -->
                            <td class="text-green-600 font-medium">
                                {{ $report->parents_attended_last_ptm ?? 0 }}
                            </td>

                            <!-- 6 -->
                            <td>{{ $report->progress_reports_shared ?? 0 }}</td>

                            <!-- 7 -->
                            <td class="text-red-600">
                                {{ $report->grievances_received ?? 0 }}
                            </td>

                            <!-- 8 -->
                            <td class="text-green-600">
                                {{ $report->grievances_resolved ?? 0 }}
                            </td>

                            <!-- 9 -->
                            <td>{{ $report->committee_active ?? '-' }}</td>

                            <!-- 10 -->
                            <td class="text-xs text-gray-400">
                                {{ $report->school_code ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <!-- ✅ MUST be 10 -->
                            <td colspan="10" class="text-center py-4 text-gray-500">
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
        $('#ptmTable').DataTable({
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

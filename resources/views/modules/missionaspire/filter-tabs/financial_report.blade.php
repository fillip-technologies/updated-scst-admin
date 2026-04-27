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

    <h2 class="text-xl font-semibold text-gray-800 mb-5">
        Finance & Reporting Status
    </h2>

    <div class="table-container">
        <div class="table-scroll">

            <table id="financeTable" class="min-w-full w-full text-sm">

                <!-- ✅ EXACT 9 COLUMNS -->
                <thead class="bg-gray-100 text-xs uppercase text-gray-700">
                    <tr>
                        <th>Code</th>
                        <th>District</th>
                        <th>Allocated</th>
                        <th>Utilised</th>
                        <th>Audit</th>
                        <th>Reports Due</th>
                        <th>On Time</th>
                        <th>Last Date</th>
                        <th>Dashboard</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reports as $report)
                        <tr class="border-t">

                            <!-- 1 -->
                            <td class="text-xs text-gray-500">
                                {{ $report->school_code ?? '-' }}
                            </td>

                            <!-- 2 -->
                            <td>{{ $report->district ?? '-' }}</td>

                            <!-- 3 -->
                            <td class="font-medium">
                                {{ $report->budget_allocated ?? 0 }}
                            </td>

                            <!-- 4 -->
                            <td class="text-green-600 font-medium">
                                {{ $report->budget_utilised ?? 0 }}
                            </td>

                            <!-- 5 -->
                            <td>{{ $report->audit_status ?? '-' }}</td>

                            <!-- 6 -->
                            <td>{{ $report->reports_due ?? 0 }}</td>

                            <!-- 7 -->
                            <td class="text-green-600">
                                {{ $report->reports_submitted_on_time ?? 0 }}
                            </td>

                            <!-- 8 -->
                            <td>
                                {{ $report->last_submission_date ?? '-' }}
                            </td>

                            <!-- 9 -->
                            <td class="text-blue-600">
                                {{ $report->dashboard_updated ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <!-- ✅ colspan MUST = 9 -->
                            <td colspan="9" class="text-center py-4 text-gray-500">
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
    $('#financeTable').DataTable({
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

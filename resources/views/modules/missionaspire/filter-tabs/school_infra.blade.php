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

    /* IMPORTANT: overflow hidden + rounded border */
    .table-container {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    /* horizontal scroll inside */
    .table-scroll {
        overflow-x: auto;
    }
</style>

<div class="p-6 bg-white rounded-2xl shadow border border-gray-200">

    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold text-gray-800">
            Infrastructure Report
        </h2>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-scroll">
            <table id="infraTable" class="min-w-full w-full text-sm">

                <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                    <tr>
                        <th>School</th>
                        <th>District</th>
                        <th>Classrooms</th>
                        <th>Hostel</th>
                        <th>Toilets</th>
                        <th>Kitchen</th>
                        <th>Dining Hall</th>
                        <th>Water</th>
                        <th>Electricity</th>
                        <th>Hours</th>
                        <th>Library</th>
                        <th>Playground</th>
                        <th>Boundary</th>
                        <th>CCTV</th>
                        <th>Internet</th>
                        <th>Smart Class</th>
                        <th>Audit</th>
                        <th>Code</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reports as $report)
                        <tr class="border-t">

                            <td class="px-4 py-3 font-medium text-gray-900">{{ $report->school_name ?? '-' }}</td>
                            <td>{{ $report->district ?? '-' }}</td>

                            <td>{{ $report->adequate_classrooms ?? '-' }}</td>
                            <td>{{ $report->functional_hostel_rooms ?? '-' }}</td>
                            <td>{{ $report->functional_toilets ?? '-' }}</td>
                            <td>{{ $report->functional_kitchen ?? '-' }}</td>
                            <td>{{ $report->dining_hall_available ?? '-' }}</td>

                            <td class="text-green-600">
                                {{ $report->safe_drinking_water ?? '-' }}
                            </td>

                            <td>{{ $report->electricity_backup ?? '-' }}</td>
                            <td>{{ $report->avg_electricity_hours ?? '-' }}</td>

                            <td>{{ $report->library_functional ?? '-' }}</td>
                            <td>{{ $report->playground_available ?? '-' }}</td>
                            <td>{{ $report->boundary_wall_intact ?? '-' }}</td>
                            <td>{{ $report->cctv_functional ?? '-' }}</td>
                            <td>{{ $report->internet_available ?? '-' }}</td>
                            <td>{{ $report->smart_classroom_operational ?? '-' }}</td>

                            <td class="text-blue-600">
                                {{ $report->infrastructure_audit_completed ?? '-' }}
                            </td>

                            <td class="text-xs text-gray-400">
                                {{ $report->school_code ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="18" class="text-center py-4 text-gray-500">
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
        $('#infraTable').DataTable({
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

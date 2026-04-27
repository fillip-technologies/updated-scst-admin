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

    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold text-gray-800">
            Health & Nutrition Report
        </h2>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="reportTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

            <!-- Table Head -->
            <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">District</th>
                    <th class="px-4 py-3 text-left">School</th>
                    <th class="px-4 py-3 text-left">Anaemia Tested</th>
                    <th class="px-4 py-3 text-left">Anaemic Found</th>
                    <th class="px-4 py-3 text-left">BMI Measured</th>
                    <th class="px-4 py-3 text-left">Normal BMI</th>
                    <th class="px-4 py-3 text-left">Health Screening</th>
                    <th class="px-4 py-3 text-left">Hospital Visits</th>
                    <th class="px-4 py-3 text-left">Menu Issues</th>
                    <th class="px-4 py-3 text-left">Food Delay</th>
                    <th class="px-4 py-3 text-left">Water</th>
                    <th class="px-4 py-3 text-left">Hygiene</th>
                    <th class="px-4 py-3 text-left">Mental Health</th>
                    <th class="px-4 py-3 text-left">Created</th>
                </tr>
            </thead>

            <tbody class="text-sm text-gray-700 divide-y">

                @foreach($reports as $report)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-4 py-3 font-medium">
                            {{ $report->district ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="px-4 py-3 font-medium text-gray-900">
                                {{ $report->school_name ?? '-' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                Code: {{ $report->school_code ?? '-' }}
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_tested_anaemia ?? '-' }}
                        </td>

                        <td class="px-4 py-3 text-red-600">
                            {{ $report->anaemic_students_found ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->students_bmi_measured ?? '-' }}
                        </td>

                        <td class="px-4 py-3 text-green-600">
                            {{ $report->students_normal_bmi ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->health_screening_covered ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->hospital_visits ?? '0' }}
                        </td>

                        <td class="px-4 py-3 text-yellow-600">
                            {{ $report->menu_not_followed_count ?? '0' }}
                        </td>

                        <td class="px-4 py-3 text-orange-600">
                            {{ $report->food_not_on_time_count ?? '0' }}
                        </td>

                        <td class="px-4 py-3">
                            @if($report->safe_drinking_water == 'Yes')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Yes</span>
                            @elseif($report->safe_drinking_water == 'No')
                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">No</span>
                            @else
                                -
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            @if($report->kitchen_hygiene_score)
                                <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-700">
                                    {{ $report->kitchen_hygiene_score }}/100
                                </span>
                            @else
                                -
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            {{ $report->mental_health_sessions ?? '0' }}
                        </td>

                        <!-- Date -->
                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y') }}
                        </td>

                    </tr>
                @endforeach

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
@endsection

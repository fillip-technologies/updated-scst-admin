@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6">

        {{-- Header --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Infrastructure Reports</h2>
                <p class="text-sm text-gray-500">View all infrastructure details</p>
            </div>

            <div>
                <a href="{{ route('school.infra.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-primary-900 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-primary-800 transition">

                    ➕ Add Infrastructure

                </a>
            </div>

        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    {{-- Table Head --}}
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">#</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">District</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">School</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">Toilet</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">Electricity</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">Drinking Water</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">Building Safety</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">Network</th>
                            <th class="px-5 py-3 text-left font-semibold text-gray-600">Action</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y">

                        @forelse ($infrReports as $key => $report)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-5 py-4">
                                    {{ $key + 1 }}
                                </td>

                                <td class="px-5 py-4 text-gray-700">
                                    {{ $report->district }}
                                </td>

                                <td class="px-5 py-4 text-gray-700">
                                    {{ optional($report->school)->school_name ?? 'N/A' }}
                                </td>

                                <td class="px-5 py-4 text-gray-700">
                                    {{ $report->toilet }}
                                </td>

                                {{-- Status Badges --}}
                                <td class="px-5 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                    {{ $report->electricity == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $report->electricity }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                    {{ $report->drinking_water == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $report->drinking_water }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                    {{ $report->building_safety == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $report->building_safety }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full
                                    {{ $report->network_availability == 'Yes' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $report->network_availability }}
                                    </span>
                                </td>

                                {{-- Action --}}
                                <td class="px-5 py-4">
                                    <a href="{{ route('school.infra.edit',$report->id ) }}"
                                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        Edit
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-6 text-gray-500">
                                    No records found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            {{-- <div class="p-4 border-t">
            {{ $infrReports->links() }}
        </div> --}}

        </div>

    </div>
@endsection

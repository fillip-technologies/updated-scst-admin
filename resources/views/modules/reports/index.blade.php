@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold">
                District Monitoring Report
            </h1>
            <p class="text-gray-500 text-sm">
                Consolidated Master Sheet Performance Overview (2025-26)
            </p>
        </div>

        <button class="bg-blue-800 text-white px-4 py-2 rounded-lg">
            Export Master Report
        </button>
    </div>

    @include('modules.reports.partials.summary-cards')
    @include('modules.reports.partials.filter-bar')
    @include('modules.reports.partials.district-table')
    @include('modules.reports.partials.hostel-section')

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Approvals & Requests
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Manage pending requests from schools.
        </p>
    </div>

    <!-- Tabs -->
    <div class="flex gap-8 border-b border-gray-200 mb-6">
        <button class="pb-3 text-blue-700 font-medium border-b-2 border-blue-700">
            Pending Requests
        </button>
        <button class="pb-3 text-gray-500 hover:text-gray-700">
            Approved Requests
        </button>
        <button class="pb-3 text-gray-500 hover:text-gray-700">
            Rejected Requests
        </button>
    </div>

    <!-- Cards Wrapper -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 divide-y">

        {{-- CARD 1 --}}
        @include('modules.approvals.partials.request-card', [
        'category' => 'INFRASTRUCTURE',
        'priority' => 'High',
        'title' => 'Roof Repair Request - Hostel Block B',
        'school' => 'Dr. B.R. Ambedkar School, Patna',
        'date' => 'Oct 24, 2023',
        'amount' => '₹45,000',
        'color' => 'orange'
        ])

        {{-- CARD 2 --}}
        @include('modules.approvals.partials.request-card', [
        'category' => 'LEAVE',
        'priority' => 'Medium',
        'title' => 'Medical Leave - Principal',
        'school' => 'Dr. B.R. Ambedkar School, Gaya',
        'date' => 'Oct 25, 2023',
        'amount' => null,
        'color' => 'blue'
        ])

        {{-- CARD 3 --}}
        @include('modules.approvals.partials.request-card', [
        'category' => 'BUDGET',
        'priority' => 'Low',
        'title' => 'Additional Funds for Sports Equipment',
        'school' => 'Dr. B.R. Ambedkar School, Muzaffarpur',
        'date' => 'Oct 26, 2023',
        'amount' => '₹12,000',
        'color' => 'green'
        ])

        {{-- CARD 4 --}}
        @include('modules.approvals.partials.request-card', [
        'category' => 'REPORT',
        'priority' => 'Medium',
        'title' => 'Monthly Meal Audit Report Approval',
        'school' => 'Dr. B.R. Ambedkar School, Nalanda',
        'date' => 'Oct 26, 2023',
        'amount' => null,
        'color' => 'indigo'
        ])

    </div>

</div>

@endsection
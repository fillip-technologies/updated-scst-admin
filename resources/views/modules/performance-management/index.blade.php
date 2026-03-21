@extends('layouts.app')

@section('content')

<div x-data="{ tab: 'overview' }" class="max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-semibold">Schools Performance Report</h1>
        <p class="text-sm text-gray-500">
            Comprehensive analytics and performance metrics
        </p>
    </div>

    <!-- Tabs -->
    <div class="flex gap-8 border-b text-sm font-medium">

        <button @click="tab='overview'"
            :class="tab==='overview' ? 'border-b-2 border-primary-700 text-primary-700 pb-3' : 'text-gray-500 pb-3'">
            Overview Performance
        </button>

        <button @click="tab='academic'"
            :class="tab==='academic' ? 'border-b-2 border-primary-700 text-primary-700 pb-3' : 'text-gray-500 pb-3'">
            Academic Performance
        </button>

        <button @click="tab='admin'"
            :class="tab==='admin' ? 'border-b-2 border-primary-700 text-primary-700 pb-3' : 'text-gray-500 pb-3'">
            Admin Performance
        </button>

        <button @click="tab='hostel'"
            :class="tab==='hostel' ? 'border-b-2 border-primary-700 text-primary-700 pb-3' : 'text-gray-500 pb-3'">
            Hostel Performance
        </button>

        <button @click="tab='infra'"
            :class="tab==='infra' ? 'border-b-2 border-primary-700 text-primary-700 pb-3' : 'text-gray-500 pb-3'">
            Infra Performance
        </button>

    </div>

    <!-- Tab Content -->
    <div class="pt-6">

        <div x-show="tab==='overview'">
            @include('modules.performance-management.tabs.overview')
        </div>

        <div x-show="tab==='academic'">
            @include('modules.performance-management.tabs.academic')
        </div>

        <div x-show="tab==='admin'">
            @include('modules.performance-management.tabs.admin')
        </div>

        <div x-show="tab==='hostel'">
            @include('modules.performance-management.tabs.hostel')
        </div>

        <div x-show="tab==='infra'">
            @include('modules.performance-management.tabs.infra')
        </div>

    </div>

</div>

@endsection
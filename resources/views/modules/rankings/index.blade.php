@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold">School Rankings</h2>
            <p class="text-sm text-gray-500">
                Monthly performance leaderboard based on composite scores.
            </p>
        </div>

        <button class="px-4 py-2 bg-primary-700 text-white rounded-lg text-sm">
            <i class="fa-solid fa-download mr-2"></i> Export List
        </button>
    </div>

    @include('modules.rankings.partials.top-three')
    @include('modules.rankings.partials.filter-bar')
    @include('modules.rankings.partials.ranking-table')

</div>

@endsection
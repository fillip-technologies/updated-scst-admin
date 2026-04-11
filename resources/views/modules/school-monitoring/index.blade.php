@extends('layouts.app')

@section('content')

    <div id="school-monitoring-page"
        data-school-monitoring
        {{-- data-schools='@json($schools)' --}}
        class="space-y-6">

        @include('modules.school-monitoring.components.header')
         @include('modules.school-monitoring.components.stats-cards')
         @include('modules.school-monitoring.components.alerts-strip')
        @include('modules.school-monitoring.components.chart-section')
        @include('modules.school-monitoring.components.school-list',["schools"=>$schools])
        @include('modules.school-monitoring.components.drawer')
    </div>

    <script src="{{ asset('js/monitoring.js') }}"></script>
@endsection

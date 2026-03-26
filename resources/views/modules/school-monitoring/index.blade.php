@extends('layouts.app')

@section('content')
    <div id="school-monitoring-page"
        data-school-monitoring
        data-schools='@json($schools)'
        class="space-y-6">

        @include('modules.school-monitoring.components.header')
        @include('modules.school-monitoring.components.stats-cards')
        @include('modules.school-monitoring.components.alerts-strip')
        @include('modules.school-monitoring.components.chart-section')
        @include('modules.school-monitoring.components.school-list')
        @include('modules.school-monitoring.components.drawer')
    </div>

    <script>
        @php echo file_get_contents(resource_path('views/modules/school-monitoring/js/monitoring.js')); @endphp
    </script>
@endsection

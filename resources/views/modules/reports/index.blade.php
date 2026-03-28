@extends('layouts.app')

@section('content')
    @php
        $schools = [
            ['id' => 'sch-101', 'name' => 'Birsa Munda Residential School', 'district' => 'Alipurduar'],
            ['id' => 'sch-102', 'name' => 'Netaji Subhash Model School', 'district' => 'Bankura'],
            ['id' => 'sch-103', 'name' => 'Rabindra Vidyapith', 'district' => 'Darjeeling'],
            ['id' => 'sch-104', 'name' => 'Vivekananda Mission School', 'district' => 'Jalpaiguri'],
            ['id' => 'sch-105', 'name' => 'Purulia Model Residential School', 'district' => 'Purulia'],
        ];

        $reportGroups = [
            'academic' => [
                'label' => 'Academic Reports',
                'description' => 'Track participation, learning continuity, and attendance outcomes across monitored schools.',
                'reports' => [
                    ['key' => 'student_attendance', 'label' => 'Student Attendance', 'icon' => 'fa-user-check'],
                    ['key' => 'student_marks', 'label' => 'Student Marks', 'icon' => 'fa-chart-column'],
                    ['key' => 'student_leave', 'label' => 'Student Leave', 'icon' => 'fa-calendar-minus'],
                    ['key' => 'teacher_attendance', 'label' => 'Teacher Attendance', 'icon' => 'fa-chalkboard-user'],
                    ['key' => 'dropout_rate', 'label' => 'Dropout Rate', 'icon' => 'fa-arrow-trend-down'],
                    ['key' => 'meal_attendance', 'label' => 'Meal Attendance', 'icon' => 'fa-bowl-food'],
                ],
            ],
            'infrastructure' => [
                'label' => 'Infrastructure Reports',
                'description' => 'Review essential school facilities and operational readiness at the district level.',
                'reports' => [
                    ['key' => 'electricity', 'label' => 'Electricity', 'icon' => 'fa-bolt'],
                    ['key' => 'toilets', 'label' => 'Toilets', 'icon' => 'fa-restroom'],
                    ['key' => 'drinking_water', 'label' => 'Drinking Water', 'icon' => 'fa-faucet-drip'],
                    ['key' => 'building_safety', 'label' => 'Building Safety', 'icon' => 'fa-shield-halved'],
                    ['key' => 'network', 'label' => 'Network', 'icon' => 'fa-tower-cell'],
                ],
            ],
        ];
    @endphp

    <div class="space-y-6" x-data="reportsDashboard()" x-init="init()">
        @include('modules.reports.partials.filter-bar')

        <section class="grid grid-cols-1 gap-6 xl:grid-cols-[320px_minmax(0,1fr)]">
            @include('modules.reports.partials.report-selector')
            @include('modules.reports.partials.report-display')
        </section>
    </div>

    <script>
        function reportsDashboard() {
            return {
                activeGroup: 'academic',
                selectedReport: '',
                selectedReportLabel: '',
                isLoading: false,
                hasLoaded: false,
                tableRows: [],
                filters: {
                    district: '',
                    school_id: '',
                },
                init() {
                    this.tableRows = [];
                },
                selectReport(reportType, label) {
                    this.selectedReport = reportType;
                    this.selectedReportLabel = label;
                },
                prettify(value) {
                    return value
                        .replaceAll('_', ' ')
                        .replaceAll('-', ' ')
                        .replace(/\b\w/g, (char) => char.toUpperCase());
                },
                selectedSchoolLabel() {
                    if (!this.filters.school_id) {
                        return 'School: Not selected';
                    }

                    const option = document.querySelector(`#school_id option[value="${this.filters.school_id}"]`);
                    return option ? `School: ${option.textContent}` : 'School: Selected';
                },
                async fetchReportData() {
                    if (!this.filters.district || !this.filters.school_id || !this.selectedReport) {
                        this.hasLoaded = false;
                        return;
                    }

                    this.isLoading = true;

                    const params = new URLSearchParams({
                        district: this.filters.district,
                        school_id: this.filters.school_id,
                        report_type: this.selectedReport,
                    });

                    try {
                        const response = await fetch(`{{ route('reports.data') }}?${params.toString()}`, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                        });

                        const result = await response.json();

                        this.tableRows = result.rows || [];
                        this.hasLoaded = true;
                    } catch (error) {
                        console.error('Failed to load report data.', error);
                        this.tableRows = [];
                        this.hasLoaded = false;
                    } finally {
                        this.isLoading = false;
                    }
                },
            };
        }
    </script>
@endsection

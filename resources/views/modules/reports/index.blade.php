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

    @endphp

    <div class="space-y-6" x-data="reportsDashboard()" x-init="init()">
        @include('modules.reports.partials.filter-bar', [
            'schools' => $allSchools ?? null,
            'allReports' => $reportData ?? null,
            'infrReports'=> $infrReports ?? null,
        ])

        <section>
            @include('modules.reports.partials.report-display', [
                'allReports' => $reports ?? null,
                'schools' => $allSchools ?? null,
                'infrReports'=> $infrReports ?? null,
            ])
        </section>
    </div>

    <script>
        function reportsDashboard() {
            return {
                selectedCategory: '',
                selectedReport: '',
                isLoading: false,
                hasLoaded: false,
                tableRows: [],
                reportOptions: {
                    academic: [{
                            value: 'Student Attendance',
                            label: 'Student Attendance'
                        },
                        {
                            value:'Student Marks',
                            label: 'Student Marks'
                        },
                        {
                            value: 'Student Leave',
                            label: 'Student Leave'
                        },
                        {
                            value: 'Teacher Attendance',
                            label: 'Teacher Attendance'
                        },
                        {
                            value: 'Dropout Rate',
                            label: 'Dropout Rate'
                        },
                        {
                            value: 'Meal Attendance',
                            label: 'Meal Attendance'
                        },
                    ],
                    infrastructure: [{
                            value: 'Electricity',
                            label: 'Electricity'
                        },
                        {
                            value: 'Toilets',
                            label: 'Toilets'
                        },
                        {
                            value: 'Drinking Water',
                            label: 'Drinking Water'
                        },
                        {
                            value: 'Building Safety',
                            label: 'Building Safety'
                        },
                        {
                            value: 'Network',
                            label: 'Network'
                        },
                    ],
                },
                filters: {
                    district: '',
                    school_id: '',
                },
                init() {
                    this.tableRows = [];
                },
                availableReports() {
                    return this.reportOptions[this.selectedCategory] || [];
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

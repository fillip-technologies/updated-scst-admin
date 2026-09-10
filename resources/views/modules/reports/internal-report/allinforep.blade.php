@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- ===== MAIN CARD ===== -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl border border-white/40 overflow-hidden transition-all hover:shadow-indigo-200/50">

        <!-- ===== HEADER : School ===== -->
        <div class="relative px-8 pt-8 pb-6 bg-primary-900">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-purple-400/20 rounded-full blur-2xl -ml-10 -mb-10"></div>

            <div class="relative z-10 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-white/90">
                    <i class="fas fa-graduation-cap text-3xl text-white/80"></i>
                    <div>
                        <h2 class="text-xl font-bold text-white tracking-tight">
                            {{ $datas->school->school_name ?? 'School Name' }}
                        </h2>
                        <p class="text-xs text-indigo-100 flex items-center gap-2">
                            <i class="fas fa-map-pin"></i>
                            {{ $datas->school->district ?? 'District' }} ·
                            {{ $datas->school->school_code ?? 'Code' }}
                            <span class="w-px h-4 bg-white/20 mx-1"></span>
                            <i class="far fa-calendar-alt"></i>
                            {{ date('Y') }}
                        </p>
                    </div>
                </div>
                <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-4 py-2 rounded-full border border-white/30 flex items-center gap-2 shadow-sm">
                    <i class="fas fa-circle text-emerald-300 text-[6px]"></i>
                    {{ ucfirst($datas->school->account_status ?? 'Active') }}
                </span>
            </div>
        </div>
        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-center gap-6 pb-8 border-b border-slate-200/60">
                <div class="flex items-center gap-5">
                    <div class="relative">
                        @if (!empty($datas->teacher->photo))
                            <img src="{{ asset($datas->teacher->photo) }}"
                                alt="{{ $datas->teacher->name }}"
                                class="w-24 h-24 rounded-full object-cover shadow-lg ring-4 ring-white/80">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-700 text-4xl font-bold shadow-lg ring-4 ring-white/80">
                                {{ strtoupper(substr($datas->teacher->name, 0, 2)) }}
                            </div>
                        @endif
                        <span class="absolute -bottom-1 -right-1 bg-emerald-400 border-2 border-white rounded-full w-5 h-5 flex items-center justify-center shadow-sm">
                            <i class="fas fa-check text-[8px] text-white"></i>
                        </span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-800 flex items-center gap-3 flex-wrap">
                            {{ $datas->teacher->name }}
                            <span class="text-xs font-medium bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full border border-emerald-200 shadow-sm">
                                {{ $datas->class_name ?? 'N/A' }}th Grade
                            </span>
                        </h1>
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-1 text-sm text-slate-500 mt-0.5">
                            <span><i class="fas fa-chalkboard-teacher text-primary-900 w-4"></i> {{ $datas->subject ?? 'Subject' }}</span>
                            @if(!empty($datas->teacher->joining_date))
                            <span><i class="fas fa-briefcase text-primary-900 w-4"></i>
                                {{ \Carbon\Carbon::parse($datas->teacher->joining_date)->format('d M Y') }}
                            </span>
                            @endif
                            <span><i class="fas fa-user-graduate text-primary-900 w-4"></i> {{ $datas->teacher->students_count ?? 'N/A' }} students</span>
                        </div>
                    </div>
                </div>
                <div class="md:ml-auto flex flex-wrap items-center gap-2">
                    <span class="bg-indigo-50 text-primary-900 text-xs font-medium px-4 py-2 rounded-full border border-indigo-100 shadow-sm flex items-center gap-1.5">
                        <i class="fas fa-flag"></i> {{ $pendingAssignments ?? 0 }} pending
                    </span>
                    <span class="bg-slate-50 text-primary-900 text-xs font-medium px-4 py-2 rounded-full border border-slate-200 shadow-sm flex items-center gap-1.5">
                        <i class="fas fa-clock"></i> {{ $nextSession ?? 'Not scheduled' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 pt-8">
                <div class="lg:col-span-3 space-y-6">
                    <div class="bg-slate-50/70 rounded-2xl p-5 border border-slate-200/60 shadow-sm hover:shadow-md transition">
                        <div class="flex items-center gap-2 text-primary-900 mb-3">
                            <i class="fas fa-book-open text-lg"></i>
                            <h3 class="font-semibold text-slate-700">Subject Overview</h3>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span class="text-slate-400 text-xs">Subject</span><br/>
                                <span class="font-medium text-slate-700">{{ $datas->subject ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-xs">Grade</span><br/>
                                <span class="font-medium text-slate-700">{{ $datas->class_name ?? 'N/A' }}th</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-xs">Total topics</span><br/>
                                <span class="font-medium text-slate-700">{{ $totalTopics ?? 0 }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-xs">Completed</span><br/>
                                <span class="font-medium text-emerald-600">{{ $percentage ?? 0 }}%</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="flex justify-between text-xs text-slate-500 mb-1">
                                <span>Progress</span>
                                <span>{{ $percentage ?? 0 }}%</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2.5">
                                <div class="bg-primary-900 h-2.5 rounded-full transition-all duration-1000"
                                     style="width: {{ $percentage ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>


                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold text-slate-700 flex items-center gap-2">
                                <i class="fas fa-list-check text-primary-900"></i> All Topics
                            </h3>
                            <span class="text-xs bg-white px-3 py-1 rounded-full border border-slate-200 text-slate-500 shadow-sm">
                                {{ $totalTopics ?? 0 }} topics
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($subjectdata ?? [] as $index => $items)
                                @php

                                    $isCompleted = $index < $completed;

                                @endphp
                                <span class="{{ $isCompleted ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-slate-50 text-slate-500 border-slate-200' }}
                                             text-sm px-4 py-2 rounded-xl border flex items-center gap-1.5 shadow-sm">
                                    @if($isCompleted)
                                        <i class="fas fa-check-circle text-emerald-500 text-xs"></i>
                                    @else
                                        <i class="far fa-circle text-slate-400 text-xs"></i>
                                    @endif
                                    {{ $items->topics_name ?? $items }}
                                </span>
                            @empty
                                <span class="text-slate-400 text-sm">No topics available</span>
                            @endforelse
                        </div>
                    </div>
                </div>


                <div class="lg:col-span-2">
                    <div class="bg-gradient-to-br from-slate-50/90 to-white rounded-2xl p-5 border border-slate-200/60 shadow-sm h-full flex flex-col">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-semibold text-slate-700 flex items-center gap-2">
                                <i class="fas fa-chart-simple text-primary-900"></i> Progress
                            </h3>
                            <span class="text-sm bg-indigo-100 text-primary-900 px-3 py-1 rounded-full font-medium shadow-sm">
                                {{ $percentage ?? 0 }}%
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mb-3">Topics completed vs remaining</p>
                        <div class="flex-1 h-48 w-full">
                            <canvas id="teacherChart"></canvas>
                        </div>
                        <div class="flex items-center justify-center gap-6 mt-3 text-xs text-slate-500">
                            <span class="flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-primary-900"></span>
                                Done ({{ $completed ?? 0 }})
                            </span>
                            <span class="flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-slate-300"></span>
                                Left ({{ $totalTopics - $completed ?? 0 }})
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ---- Footer ---- -->
            <div class="mt-8 pt-4 border-t border-slate-200/60 flex flex-wrap justify-between items-center text-xs text-slate-400">
                <span><i class="far fa-calendar-alt mr-1"></i> Updated: {{ now()->format('d M Y, h:i A') }}</span>
                <span class="flex items-center gap-4">
                    <span><i class="fas fa-tasks mr-1"></i> {{ $pendingAssignments ?? 0 }} assignments pending</span>
                    <span><i class="fas fa-clock mr-1"></i> Next session: {{ $nextSession ?? 'Not scheduled' }}</span>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ===== CHART SCRIPT WITH DYNAMIC DATA ===== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('teacherChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');

        // Get data from Blade variables
        const completed = {{ $completed ?? 0 }};
        const totalTopics = {{ $totalTopics ?? 1 }};
        const remaining = Math.max(0, totalTopics - completed);
        const percentage = {{ $percentage ?? 0 }};

        // Destroy existing chart if any
        if (window.teacherChartInstance) {
            window.teacherChartInstance.destroy();
        }

        window.teacherChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Completed', 'Remaining'],
                datasets: [{
                    label: 'Topics',
                    data: [completed, remaining],
                    backgroundColor: ['#1E3A8A', '#cbd5e1'],
                    borderColor: ['#3730a3', '#94a3b8'],
                    borderWidth: 1.5,
                    borderRadius: 8,
                    barPercentage: 0.55,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                return ctx.raw + ' topics';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.max(totalTopics, 5),
                        grid: {
                            color: '#e9edf2'
                        },
                        ticks: {
                            stepSize: Math.ceil(Math.max(totalTopics, 5) / 6),
                            font: {
                                size: 10
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection

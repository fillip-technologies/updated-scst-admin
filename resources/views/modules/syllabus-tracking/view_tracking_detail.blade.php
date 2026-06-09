@extends('layouts.app')

@section('content')
    <div class="p-3 sm:p-4 lg:p-8 bg-gray-50 min-h-screen">
        <div>

            {{-- <div class="mb-5">
                <a href=""
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-primary-900 text-sm font-medium transition group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Syllabus Tracking
                </a>
            </div> --}}


            <div class="bg-primary-900 text-white rounded-2xl p-6 sm:p-8 mb-6 shadow-lg relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div class="absolute bottom-0 left-20 w-24 h-24 bg-white/5 rounded-full translate-y-1/2"></div>

                <div class="relative z-10">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div class="flex-1">
                            <h1 class="text-xl sm:text-2xl font-bold leading-tight" id="detailSchoolName">
                                {{ $trackingdetails->school->school_name ?? 'School Name' }}</h1>
                            <div class="flex items-center gap-1.5 mt-2">
                                {{-- <svg class="w-3.5 h-3.5 text-white/50" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg> --}}
                                <span class="text-sm text-white/60" id="detailDistrict">District,
                                    {{ $trackingdetails->school->district ?? 'District' }}</span>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold border" id="detailStatusBadge">-</span>
                    </div>

                    <div class="flex flex-wrap gap-5 mt-6">
                        <div class="bg-white/10 rounded-xl px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-white/50 text-[11px] uppercase tracking-wider font-medium">Students</span>
                            <p class="font-bold text-xl mt-0.5" id="detailStudents">
                                {{ $trackingdetails->school->student->count() ?? '0' }}</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-white/50 text-[11px] uppercase tracking-wider font-medium">Teachers</span>
                            <p class="font-bold text-xl mt-0.5" id="detailTeachers">
                                {{ $trackingdetails->school->teacher->count() ?? '0' }}</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-white/50 text-[11px] uppercase tracking-wider font-medium">Last Updated</span>
                            <p class="font-bold text-xl mt-0.5" id="detailLastUpdated">
                              {{-- {{ $tracking->created_at ? \Carbon\Carbon::parse($tracking->created_at)->format('d-m-Y') : '' }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-sm">
                    <p class="text-xs text-slate-500">Total Topics</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ $totalTopics }}
                    </h3>
                </div>

                <div class="bg-green-50 rounded-2xl border border-green-200 p-4 shadow-sm">
                    <p class="text-xs text-green-600">Completed</p>
                    <h3 class="text-2xl font-bold text-green-700 mt-1">
                        {{ $completedTopics }}
                    </h3>
                </div>

                <div class="bg-yellow-50 rounded-2xl border border-yellow-200 p-4 shadow-sm">
                    <p class="text-xs text-yellow-600">Ongoing</p>
                    <h3 class="text-2xl font-bold text-yellow-700 mt-1">
                        {{ $ongoingTopics }}
                    </h3>
                </div>

                <div class="bg-red-50 rounded-2xl border border-red-200 p-4 shadow-sm">
                    <p class="text-xs text-red-600">Pending</p>
                    <h3 class="text-2xl font-bold text-red-700 mt-1">
                        {{ $pendingTopics }}
                    </h3>
                </div>

                {{-- <div class="bg-blue-50 rounded-2xl border border-blue-200 p-4 shadow-sm">
                    <p class="text-xs text-blue-600">Progress</p>
                    <h3 class="text-2xl font-bold text-blue-700 mt-1">
                        {{ $completionPercentage }}%
                    </h3>
                </div> --}}

            </div>
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Left Column (2 cols wide) -->
                <div class="lg:col-span-2 space-y-5">

                    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">

                        <div class="flex items-center gap-2.5 mb-5">
                            <div class="w-8 h-8 rounded-lg bg-primary-700 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">
                                Teacher Details
                            </h3>
                        </div>

                        <div class="flex items-center gap-4 mb-5">

                            @if (!empty($trackingdetails->teacher->photo))
                                <img src="{{ asset($trackingdetails->teacher->photo) }}"
                                    class="w-14 h-14 rounded-full object-cover border-2 border-primary-100">
                            @else
                                <div
                                    class="w-14 h-14 rounded-full bg-primary-900 text-white flex items-center justify-center font-bold text-lg">
                                    {{ strtoupper(substr($trackingdetails->teacher->name ?? 'T', 0, 1)) }}
                                </div>
                            @endif

                            <div>
                                <h4 class="font-semibold text-gray-800 text-base">
                                    {{ $trackingdetails->teacher->name ?? 'N/A' }}
                                </h4>

                                <p class="text-sm text-gray-500">
                                    {{ $trackingdetails->teacher->email ?? 'N/A' }}
                                </p>
                            </div>

                        </div>

                        <div class="grid grid-cols-2 gap-3">

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-[11px] text-gray-400 uppercase">
                                    Phone
                                </p>
                                <p class="font-semibold text-gray-700 mt-1">
                                    {{ $trackingdetails->teacher->phone ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-[11px] text-gray-400 uppercase">
                                    Subject
                                </p>
                                <p class="font-semibold text-gray-700 mt-1">
                                    {{ $trackingdetails->teacher->subject ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-[11px] text-gray-400 uppercase">
                                    Class
                                </p>
                                <p class="font-semibold text-gray-700 mt-1">
                                    {{ $trackingdetails->teacher->addclass->class ?? ($trackingdetails->class_name ?? 'N/A') }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-[11px] text-gray-400 uppercase">
                                    Total Topics
                                </p>
                                <p class="font-semibold text-blue-700 mt-1">
                                    {{ $totalTopics }}
                                </p>
                            </div>

                            <div class="bg-green-50 rounded-xl p-3">
                                <p class="text-[11px] text-green-600 uppercase">
                                    Completed
                                </p>
                                <p class="font-semibold text-green-700 mt-1">
                                    {{ $completedTopics }}
                                </p>
                            </div>

                            <div class="bg-red-50 rounded-xl p-3">
                                <p class="text-[11px] text-red-600 uppercase">
                                    Pending
                                </p>
                                <p class="font-semibold text-red-700 mt-1">
                                    {{ $pendingTopics }}
                                </p>
                            </div>

                        </div>



                    </div>

                    <!-- Daily Remarks Section -->

                </div>

                <div class="space-y-5">
                    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                        <div class="flex items-center gap-2.5 mb-5">
                            <div class="w-8 h-8 rounded-lg bg-primary-600 flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">Subject & Syllabus</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-gray-50 rounded-xl px-3 py-2.5">
                                    <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-0.5">
                                        Subject</p>
                                    <p class="text-sm font-semibold text-gray-700" id="detailSubject">
                                        {{ $trackingdetails->subject ?? 'subject' }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl px-3 py-2.5">
                                    <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-0.5">
                                        Class</p>
                                    <p class="text-sm font-semibold text-gray-700" id="detailClass">
                                        {{ $trackingdetails->class_name ?? 'class' }}</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl px-3 py-2.5">
                                <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-2">
                                    Topic
                                </p>

                                <div id="detailTopic" class="flex flex-wrap gap-2">
                                    <!-- Topics Checkbox Here -->
                                </div>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes remarkFadeIn {
            from {
                opacity: 0;
                transform: translateX(-8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .remark-animate {
            animation: remarkFadeIn 0.3s ease forwards;
        }
    </style>

    <script>
        let completedTopics = @json($dailyUpdates->pluck('topic_name')->toArray());
        let topics = @json($topics);

        let topicHtml = '';

        topics.forEach(topic => {

            const checked = completedTopics.includes(topic);

            topicHtml += `
        <label class="inline-flex items-center gap-2 px-3 py-2 bg-blue-50 border border-blue-200 rounded-lg">

            <input
                type="checkbox"
                ${checked ? 'checked' : ''}
                disabled
                class="w-4 h-4 text-green-600 rounded">

            <span class="text-sm text-gray-700">
                ${topic}
            </span>

        </label>
    `;
        });

        document.getElementById('detailTopic').innerHTML = topicHtml;
    </script>
@endsection

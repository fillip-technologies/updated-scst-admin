@extends('layouts.app')

@section('content')
    <div class="p-3 sm:p-4 lg:p-8 bg-gray-50 min-h-screen">

        {{-- <!-- Loading State -->
        <div id="loadingState" class="flex items-center justify-center py-20">
            <div class="text-center">
                <div
                    class="inline-block w-10 h-10 border-4 border-primary-900/20 border-t-primary-900 rounded-full animate-spin mb-4">
                </div>
                <p class="text-sm text-gray-400">Loading details...</p>
            </div>
        </div> --}}

        <!-- Detail Content -->
        <div>

            <!-- Back Button -->
            <div class="mb-5">
                <a href=""
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-primary-900 text-sm font-medium transition group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Syllabus Tracking
                </a>
            </div>

            <!-- Detail Header Card -->
            <div class="bg-primary-900 text-white rounded-2xl p-6 sm:p-8 mb-6 shadow-lg relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div class="absolute bottom-0 left-20 w-24 h-24 bg-white/5 rounded-full translate-y-1/2"></div>

                <div class="relative z-10">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div class="flex-1">
                            <h1 class="text-xl sm:text-2xl font-bold leading-tight" id="detailSchoolName">{{ $trackingdetails->school->school_name ?? "School Name" }}</h1>
                            <div class="flex items-center gap-1.5 mt-2">
                                <svg class="w-3.5 h-3.5 text-white/50" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm text-white/60" id="detailDistrict">District, {{ $trackingdetails->school->district ?? "District" }}</span>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold border" id="detailStatusBadge">-</span>
                    </div>

                    <div class="flex flex-wrap gap-5 mt-6">
                        <div class="bg-white/10 rounded-xl px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-white/50 text-[11px] uppercase tracking-wider font-medium">Students</span>
                            <p class="font-bold text-xl mt-0.5" id="detailStudents">{{ $trackingdetails->school->student->count() ?? "0" }}</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-white/50 text-[11px] uppercase tracking-wider font-medium">Teachers</span>
                            <p class="font-bold text-xl mt-0.5" id="detailTeachers">0</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-4 py-2.5 backdrop-blur-sm">
                            <span class="text-white/50 text-[11px] uppercase tracking-wider font-medium">Last Updated</span>
                            <p class="font-bold text-xl mt-0.5" id="detailLastUpdated">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Left Column (2 cols wide) -->
                <div class="lg:col-span-2 space-y-5">

                    <!-- School Information -->
                    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
                        <div class="flex items-center gap-2.5 mb-5">
                            <div class="w-8 h-8 rounded-lg bg-primary-900 flex items-center justify-center">
                                <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">School Information</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                            <div>
                                <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-1">School Name
                                </p>
                                <p class="text-sm font-semibold text-gray-700" id="detailSchoolNameInfo">-</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-1">District</p>
                                <p class="text-sm font-semibold text-gray-700" id="detailDistrictInfo">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Teacher & Subject in one card -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Teacher Details -->
                        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                            <div class="flex items-center gap-2.5 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-primary-700 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-800">Teacher Details</h3>
                            </div>
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary-900/10 flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold text-primary-900" id="detailTeacherInitials">-</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700" id="detailTeacherName">-</p>
                                    <p class="text-xs text-gray-400" id="detailTeacherEmail">-</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl px-3 py-2.5">
                                <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-0.5">Phone</p>
                                <p class="text-sm font-semibold text-gray-700" id="detailTeacherPhone">-</p>
                            </div>
                        </div>


                        <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-primary-800 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-800">Daily Remarks</h3>
                                </div>
                                <span class="text-[11px] font-medium text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full"
                                    id="remarksCount">0 remarks</span>
                            </div>


                            <div class="space-y-0" id="remarksTimeline">

                            </div>


                        </div>
                        <!-- Send Mail -->
                        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                            <div class="flex items-center gap-2.5 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-primary-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-accent-500" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-gray-800">Send Mail</h3>
                            </div>
                            <textarea id="detailNoticeText" rows="4"
                                class="w-full border border-gray-200 rounded-xl px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-primary-900/20 focus:border-primary-900 focus:outline-none bg-gray-50 resize-none transition"
                                placeholder="Write your message here..."></textarea>
                            <button onclick="sendFlagNotice()"
                                class="mt-3 w-full bg-primary-900 hover:bg-primary-800 text-white py-3 rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Send Flag Notice
                            </button>
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
                                    <p class="text-sm font-semibold text-gray-700" id="detailSubject">-</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl px-3 py-2.5">
                                    <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-0.5">
                                        Class</p>
                                    <p class="text-sm font-semibold text-gray-700" id="detailClass">-</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-xl px-3 py-2.5">
                                <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium mb-0.5">Topic
                                </p>
                                <p class="text-sm font-semibold text-gray-700" id="detailTopic">-</p>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div id="notFoundState" style="display:none;"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 sm:p-14 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-primary-900/5 flex items-center justify-center">
                <svg class="w-8 h-8 text-primary-900/40" fill="none" stroke="currentColor" stroke-width="1.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3 class="text-base font-semibold text-gray-700 mb-1">Record Not Found</h3>
            <p class="text-sm text-gray-400 mb-5">The syllabus tracking record could not be found.</p>
            <a href=""
                class="inline-flex items-center gap-2 bg-primary-900 hover:bg-primary-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Go Back
            </a>
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

    {{-- <script>
        // ==================== DEMO DATA ====================
        const trackingData = [
            {
                id: 1,
                school: 'Dr. Bhimrao Ambedkar Residential School, Rampur, Forbesganj',
                district: 'Araria',
                schoolEmail: 'ambedkar.school@edu.in',
                students: 30,
                teachers: 14,
                lastUpdated: '3 weeks ago',
                teacher: 'Shailendra Kumar',
                teacherEmail: 'shailendra.k@edu.in',
                teacherPhone: '9876543210',
                subject: 'Mathematics',
                class: '10',
                topic: 'Quadratic Equations',
                chapter: 'Ch-4: Quadratic Equations',
                totalLessons: 12,
                completedLessons: 12,
                status: 'completed',
                remarks: [
                    { text: 'All chapters completed on time. Teacher performance is excellent.', date: '2026-06-05', author: 'Admin' },
                    { text: 'Students scoring above average in unit tests. Keep up the good work.', date: '2026-06-03', author: 'Admin' },
                    { text: 'Chapter 4 revision completed. Students need more practice on word problems.', date: '2026-05-28', author: 'Inspector' }
                ]
            },
            {
                id: 2,
                school: 'SC/ST Welfare School, Forbesganj',
                district: 'Araria',
                schoolEmail: 'forbesganj.school@edu.in',
                students: 45,
                teachers: 10,
                lastUpdated: '1 week ago',
                teacher: 'Krishan Kant',
                teacherEmail: 'krishan.k@edu.in',
                teacherPhone: '9876543212',
                subject: 'English',
                class: '8',
                topic: 'Prose - The Best Christmas Present',
                chapter: 'Ch-1: The Best Christmas Present',
                totalLessons: 8,
                completedLessons: 3,
                status: 'ongoing',
                remarks: [
                    { text: 'Syllabus is behind schedule. Teacher needs to increase pace.', date: '2026-06-04', author: 'Admin' },
                    { text: 'Reading comprehension exercises completed for Chapter 1.', date: '2026-05-30', author: 'Inspector' }
                ]
            },
            {
                id: 3,
                school: 'Patna Central Residential School',
                district: 'Patna',
                schoolEmail: 'patna.central@edu.in',
                students: 120,
                teachers: 22,
                lastUpdated: '2 days ago',
                teacher: 'Amit Verma',
                teacherEmail: 'amit.v@edu.in',
                teacherPhone: '9876543214',
                subject: 'Mathematics',
                class: '9',
                topic: 'Linear Equations in Two Variables',
                chapter: 'Ch-4: Linear Equations',
                totalLessons: 14,
                completedLessons: 5,
                status: 'ongoing',
                remarks: [
                    { text: 'Progress is satisfactory. Need to focus on graphical methods.', date: '2026-06-05', author: 'Admin' }
                ]
            },
            {
                id: 4,
                school: 'Gaya Residential Academy',
                district: 'Gaya',
                schoolEmail: 'gaya.academy@edu.in',
                students: 75,
                teachers: 16,
                lastUpdated: '5 days ago',
                teacher: 'Priya Kumari',
                teacherEmail: 'priya.k@edu.in',
                teacherPhone: '9876543217',
                subject: 'Science',
                class: '10',
                topic: 'Chemical Reactions & Equations',
                chapter: 'Ch-1: Chemical Reactions',
                totalLessons: 10,
                completedLessons: 0,
                status: 'pending',
                remarks: [
                    { text: 'Syllabus has not started yet. Immediate action required.', date: '2026-06-06', author: 'Admin' },
                    { text: 'Lab equipment procurement is pending. Blocking practical sessions.', date: '2026-06-02', author: 'Inspector' },
                    { text: 'Teacher assigned. Awaiting lab setup completion to begin classes.', date: '2026-05-25', author: 'Admin' }
                ]
            }
        ];

        let currentDetailData = null;

        // ==================== ON PAGE LOAD ====================
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const itemId = parseInt(urlParams.get('id'));

            setTimeout(() => {
                const item = trackingData.find(d => d.id === itemId);
                document.getElementById('loadingState').style.display = 'none';

                if (!item) {
                    document.getElementById('notFoundState').style.display = 'block';
                    return;
                }

                currentDetailData = item;
                populateDetails(item);
                document.getElementById('detailContent').style.display = 'block';
            }, 300);
        });

        // ==================== POPULATE DETAILS ====================
        function populateDetails(item) {
            // Header
            document.getElementById('detailSchoolName').textContent = item.school;
            document.getElementById('detailDistrict').textContent = item.district + ', Bihar';
            document.getElementById('detailStudents').textContent = item.students;
            document.getElementById('detailTeachers').textContent = item.teachers;
            document.getElementById('detailLastUpdated').textContent = item.lastUpdated;

            // Status badge in header
            const statusBadge = document.getElementById('detailStatusBadge');
            const statusStyles = {
                'completed': { class: 'bg-green-500/20 text-green-200 border-green-500/30', label: 'Completed' },
                'ongoing': { class: 'bg-yellow-500/20 text-yellow-200 border-yellow-500/30', label: 'In Progress' },
                'pending': { class: 'bg-red-500/20 text-red-200 border-red-500/30', label: 'Not Started' }
            };
            const stHeader = statusStyles[item.status] || statusStyles['pending'];
            statusBadge.className = 'px-3 py-1.5 rounded-full text-xs font-semibold border ' + stHeader.class;
            statusBadge.textContent = stHeader.label;

            // School Info
            document.getElementById('detailSchoolNameInfo').textContent = item.school;
            document.getElementById('detailDistrictInfo').textContent = item.district;

            // Teacher Details
            document.getElementById('detailTeacherName').textContent = item.teacher;
            document.getElementById('detailTeacherEmail').textContent = item.teacherEmail;
            document.getElementById('detailTeacherPhone').textContent = item.teacherPhone;
            document.getElementById('detailTeacherInitials').textContent =
                item.teacher.split(' ').map(n => n[0]).join('');

            // Subject & Syllabus
            document.getElementById('detailSubject').textContent = item.subject;
            document.getElementById('detailClass').textContent = 'Class ' + item.class;
            document.getElementById('detailTopic').textContent = item.topic;
            document.getElementById('detailChapter').textContent = item.chapter;
            document.getElementById('detailLessons').textContent = item.completedLessons + '/' + item.totalLessons;

            const syllabusPercent = item.totalLessons > 0
                ? Math.round((item.completedLessons / item.totalLessons) * 100) : 0;

            // Linear progress bar
            const syllabusBar = document.getElementById('syllabusProgressBar');
            if (syllabusPercent >= 100) syllabusBar.classList.add('bg-green-500');
            else if (syllabusPercent > 0) syllabusBar.classList.add('bg-accent-500');
            else syllabusBar.classList.add('bg-gray-300');
            setTimeout(() => { syllabusBar.style.width = syllabusPercent + '%'; }, 200);

            document.getElementById('syllabusProgressText').textContent =
                item.completedLessons + '/' + item.totalLessons;

            // Circular progress
            const circumference = 2 * Math.PI * 42; // ~263.89
            const offset = circumference - (syllabusPercent / 100) * circumference;
            const circle = document.getElementById('progressCircle');

            if (syllabusPercent >= 100) circle.setAttribute('stroke', '#22c55e');
            else if (syllabusPercent > 0) circle.setAttribute('stroke', '#F4B400');
            else circle.setAttribute('stroke', '#d1d5db');

            setTimeout(() => {
                circle.style.strokeDashoffset = offset;
                document.getElementById('circlePercent').textContent = syllabusPercent + '%';
            }, 300);

            // Status in sidebar
            const statusEl = document.getElementById('detailStatus');
            const statusCardStyles = {
                'completed': 'bg-green-100 text-green-700',
                'ongoing': 'bg-yellow-100 text-yellow-700',
                'pending': 'bg-red-100 text-red-600'
            };
            const stLabel = { 'completed': 'Completed', 'ongoing': 'In Progress', 'pending': 'Not Started' };
            statusEl.className = 'text-xs font-semibold rounded-full px-2 py-0.5 ' + (statusCardStyles[item.status] || '');
            statusEl.textContent = stLabel[item.status] || '-';

            // Remarks
            renderRemarks(item.remarks || []);
        }

        // ==================== REMARKS ====================
        function renderRemarks(remarks) {
            const timeline = document.getElementById('remarksTimeline');
            document.getElementById('remarksCount').textContent = remarks.length + ' remark' + (remarks.length !== 1 ? 's' : '');

            if (remarks.length === 0) {
                timeline.innerHTML = `
                                                    <div class="text-center py-6">
                                                        <p class="text-sm text-gray-400">No remarks yet</p>
                                                    </div>`;
                return;
            }

            timeline.innerHTML = '';
            remarks.forEach((remark, i) => {
                const isLast = i === remarks.length - 1;
                const dateObj = new Date(remark.date);
                const formattedDate = dateObj.toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' });

                const remarkEl = document.createElement('div');
                remarkEl.className = 'flex gap-3 remark-animate';
                remarkEl.style.animationDelay = `${i * 0.08}s`;
                remarkEl.style.opacity = '0';

                remarkEl.innerHTML = `
                                                    <!-- Timeline dot & line -->
                                                    <div class="flex flex-col items-center flex-shrink-0">
                                                        <div class="w-2.5 h-2.5 rounded-full bg-primary-900 mt-1.5 ring-4 ring-primary-900/10"></div>
                                                        ${!isLast ? '<div class="w-0.5 flex-1 bg-gray-100 my-1"></div>' : '<div class="flex-1"></div>'}
                                                    </div>
                                                    <!-- Content -->
                                                    <div class="${!isLast ? 'pb-5' : 'pb-0'} flex-1 min-w-0">
                                                        <div class="flex items-center gap-2 mb-1">
                                                            <span class="text-[11px] font-semibold text-primary-900 bg-primary-900/5 px-2 py-0.5 rounded">${remark.author}</span>
                                                            <span class="text-[11px] text-gray-400">${formattedDate}</span>
                                                        </div>
                                                        <p class="text-sm text-gray-600 leading-relaxed">${remark.text}</p>
                                                    </div>
                                                `;

                timeline.appendChild(remarkEl);
            });
        }



        // ==================== SEND NOTICE ====================
        function sendFlagNotice() {
            if (!currentDetailData) return;
            const notice = document.getElementById('detailNoticeText').value.trim();

            Swal.fire({
                icon: 'success',
                title: 'Notice Sent!',
                html: 'Flag notice sent successfully to <strong>' + currentDetailData.school + '</strong>' +
                    (notice ? '<br><small class="text-gray-500">Message: "' + notice.substring(0, 50) + (notice.length > 50 ? '...' : '') + '"</small>' : ''),
                timer: 3000,
                showConfirmButton: false
            });

            document.getElementById('detailNoticeText').value = '';
        }
    </script> --}}
@endsection

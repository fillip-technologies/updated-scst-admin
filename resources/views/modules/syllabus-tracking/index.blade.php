@extends('layouts.app')

@section('content')
    <div class="p-3 sm:p-4 lg:p-8 bg-gray-100 min-h-screen">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-2">
            <div>
                <h1 class="text-lg sm:text-xl font-semibold text-gray-800">📘 Syllabus Tracking</h1>
                <p class="text-sm text-gray-500">
                    Track and monitor syllabus completion across schools, classes, and subjects.
                </p>
            </div>
            <!-- Add Syllabus Button -->
            <a href="{{ route('syllabusTraking') }}" id="btn-add-syllabus"
                class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition-all duration-200 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>

            </a>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 mb-4 sm:mb-6">
            <h2 class="text-sm font-semibold text-gray-600 mb-4">Filter Options</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

                <!-- District -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">District</label>
                    <select id="filterDistrict" onchange="filterSchools()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white">
                        <option value="">Select District</option>
                        <option value="Araria">Araria</option>
                        <option value="Patna">Patna</option>
                        <option value="Gaya">Gaya</option>
                        <option value="Muzaffarpur">Muzaffarpur</option>
                        <option value="Bhagalpur">Bhagalpur</option>
                        <option value="Darbhanga">Darbhanga</option>
                        <option value="Purnia">Purnia</option>
                        <option value="Munger">Munger</option>
                    </select>
                </div>

                <!-- School -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">School</label>
                    <select id="filterSchool"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white">
                        <option value="">Select School</option>
                    </select>
                </div>

                <!-- Class -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Class</label>
                    <select id="filterClass"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white">
                        <option value="">Select Class</option>
                        <option value="1">Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>
                        <option value="4">Class 4</option>
                        <option value="5">Class 5</option>
                        <option value="6">Class 6</option>
                        <option value="7">Class 7</option>
                        <option value="8">Class 8</option>
                        <option value="9">Class 9</option>
                        <option value="10">Class 10</option>
                        <option value="11">Class 11</option>
                        <option value="12">Class 12</option>
                    </select>
                </div>

                <!-- Subject -->
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Subject</label>
                    <select id="filterSubject"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white">
                        <option value="">Select Subject</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Science">Science</option>
                        <option value="English">English</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Social Science">Social Science</option>
                        <option value="Sanskrit">Sanskrit</option>
                        <option value="Computer Science">Computer Science</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 mt-4">
                <button onclick="showResults()"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 sm:px-6 py-2 rounded-lg text-sm font-medium shadow-sm transition">
                    🔍 Show
                </button>
                <button onclick="resetFilters()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 sm:px-6 py-2 rounded-lg text-sm font-medium transition">
                    ↻ Reset
                </button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6" id="summaryCards" style="display: none;">
            <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
                <p class="text-xs text-gray-500 uppercase">Total Topics</p>
                <h3 class="text-xl font-bold text-gray-800" id="totalTopics">0</h3>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
                <p class="text-xs text-gray-500 uppercase">Completed</p>
                <h3 class="text-xl font-bold text-green-600" id="completedCount">0</h3>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
                <p class="text-xs text-gray-500 uppercase">Ongoing</p>
                <h3 class="text-xl font-bold text-yellow-600" id="ongoingCount">0</h3>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
                <p class="text-xs text-gray-500 uppercase">Pending</p>
                <h3 class="text-xl font-bold text-red-500" id="pendingCount">0</h3>
            </div>
        </div>

        <!-- Results Table -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100" id="resultsTable" style="display: none;">
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-4 sm:px-6 py-3 sm:py-4 border-b gap-2">
                <h2 class="font-semibold text-base sm:text-lg text-gray-700">📋 Syllabus Tracking Report</h2>
                <span class="text-xs sm:text-sm text-gray-400" id="resultInfo"></span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="trackingTable">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-left">#</th>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-left">School Details</th>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-left hidden md:table-cell">Teacher Details</th>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-left hidden lg:table-cell">Subject Details</th>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-left">Topic Details</th>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-center">Status</th>
                            <th class="py-2 sm:py-3 px-3 sm:px-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" id="trackingBody">
                        <!-- Rows injected by JS -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 sm:p-12 text-center">
            <div class="text-5xl sm:text-6xl mb-4">📚</div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">No Data to Display</h3>
            <p class="text-sm text-gray-400">Select filters above and click <strong>"Show"</strong> to view syllabus
                tracking data.</p>
        </div>

    </div>



    <!-- Mail Confirmation Modal -->
    <div id="mailModal" class="fixed inset-0 hidden items-center justify-center z-50 p-4">
        <div class="fixed inset-0 bg-black/50" onclick="closeMailModal()"></div>
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-5 sm:p-6 relative z-10">
            <button onclick="closeMailModal()"
                class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-lg">✖</button>

            <h2 class="text-lg font-semibold text-gray-800 mb-1">📧 Send Notification Mail</h2>
            <p class="text-sm text-gray-500 mb-4">Send a reminder to the school and teacher regarding syllabus progress.
            </p>

            <div class="bg-gray-50 rounded-lg p-4 mb-4 space-y-2 text-sm" id="mailDetails">
                <!-- Filled by JS -->
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">Message (Optional)</label>
                <textarea id="mailMessage" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Add a custom message..."></textarea>
            </div>

            <div class="flex gap-3">
                <button onclick="sendMail('school')"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm font-medium transition">
                    📨 Send to School
                </button>
                <button onclick="sendMail('teacher')"
                    class="flex-1 bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium transition">
                    👩‍🏫 Send to Teacher
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-modal {
            animation: modalSlideIn 0.25s ease forwards;
        }
    </style>

    <script>
        // Dummy school data mapped by district
        const schoolsByDistrict = {
            'Araria': [
                'Dr. Bhimrao Ambedkar Residential School, Rampur',
                'SC/ST Welfare School, Forbesganj',
                'Government High School, Araria'
            ],
            'Patna': [
                'Patna Central Residential School',
                'SC/ST Model School, Patna City',
                'Government Senior Secondary, Danapur'
            ],
            'Gaya': [
                'Gaya Residential Academy',
                'SC/ST Welfare School, Bodhgaya',
                'Government High School, Gaya'
            ],
            'Muzaffarpur': [
                'Muzaffarpur Model Residential School',
                'SC/ST Welfare Academy, Muzaffarpur'
            ],
            'Bhagalpur': [
                'Bhagalpur Residential School',
                'Vikramshila SC/ST Academy'
            ],
            'Darbhanga': [
                'Darbhanga Welfare Residential School',
                'Madhubani SC/ST School'
            ],
            'Purnia': [
                'Purnia SC/ST Residential School',
                'Government Model School, Purnia'
            ],
            'Munger': [
                'Munger Residential Academy',
                'SC/ST Welfare School, Munger'
            ]
        };

        // Dummy tracking data
        const dummyData = [
            {
                school: 'Dr. Bhimrao Ambedkar Residential School, Rampur',
                district: 'Araria',
                schoolEmail: 'ambedkar.school@edu.in',
                teacher: 'Shailendra Kumar',
                teacherEmail: 'shailendra.k@edu.in',
                teacherPhone: '9876543210',
                subject: 'Mathematics',
                class: '10',
                topic: 'Quadratic Equations',
                chapter: 'Ch-4: Quadratic Equations',
                totalLessons: 12,
                completedLessons: 12,
                status: 'completed'
            },
            {
                school: 'Dr. Bhimrao Ambedkar Residential School, Rampur',
                district: 'Araria',
                schoolEmail: 'ambedkar.school@edu.in',
                teacher: 'Navneet Kumar',
                teacherEmail: 'navneet.k@edu.in',
                teacherPhone: '9876543211',
                subject: 'Science',
                class: '10',
                topic: 'Chemical Reactions & Equations',
                chapter: 'Ch-1: Chemical Reactions',
                totalLessons: 10,
                completedLessons: 7,
                status: 'ongoing'
            },
            {
                school: 'SC/ST Welfare School, Forbesganj',
                district: 'Araria',
                schoolEmail: 'forbesganj.school@edu.in',
                teacher: 'Krishan Kant',
                teacherEmail: 'krishan.k@edu.in',
                teacherPhone: '9876543212',
                subject: 'English',
                class: '8',
                topic: 'Prose - The Best Christmas Present',
                chapter: 'Ch-1: The Best Christmas Present',
                totalLessons: 8,
                completedLessons: 0,
                status: 'pending'
            },
            {
                school: 'SC/ST Welfare School, Forbesganj',
                district: 'Araria',
                schoolEmail: 'forbesganj.school@edu.in',
                teacher: 'Ravi Shankar Prasad',
                teacherEmail: 'ravi.prasad@edu.in',
                teacherPhone: '9876543213',
                subject: 'Hindi',
                class: '9',
                topic: 'कबीर की साखियाँ',
                chapter: 'Ch-9: साखी',
                totalLessons: 6,
                completedLessons: 6,
                status: 'completed'
            },
            {
                school: 'Patna Central Residential School',
                district: 'Patna',
                schoolEmail: 'patna.central@edu.in',
                teacher: 'Amit Verma',
                teacherEmail: 'amit.v@edu.in',
                teacherPhone: '9876543214',
                subject: 'Mathematics',
                class: '9',
                topic: 'Linear Equations in Two Variables',
                chapter: 'Ch-4: Linear Equations',
                totalLessons: 14,
                completedLessons: 5,
                status: 'ongoing'
            },
            {
                school: 'Patna Central Residential School',
                district: 'Patna',
                schoolEmail: 'patna.central@edu.in',
                teacher: 'Sunita Devi',
                teacherEmail: 'sunita.d@edu.in',
                teacherPhone: '9876543215',
                subject: 'Social Science',
                class: '10',
                topic: 'The Rise of Nationalism in Europe',
                chapter: 'Ch-1: Nationalism in Europe',
                totalLessons: 10,
                completedLessons: 0,
                status: 'pending'
            },
            {
                school: 'SC/ST Model School, Patna City',
                district: 'Patna',
                schoolEmail: 'model.patna@edu.in',
                teacher: 'Rajesh Singh',
                teacherEmail: 'rajesh.s@edu.in',
                teacherPhone: '9876543216',
                subject: 'Science',
                class: '8',
                topic: 'Crop Production and Management',
                chapter: 'Ch-1: Crop Production',
                totalLessons: 8,
                completedLessons: 8,
                status: 'completed'
            },
            {
                school: 'Gaya Residential Academy',
                district: 'Gaya',
                schoolEmail: 'gaya.academy@edu.in',
                teacher: 'Priya Kumari',
                teacherEmail: 'priya.k@edu.in',
                teacherPhone: '9876543217',
                subject: 'English',
                class: '10',
                topic: 'A Letter to God',
                chapter: 'Ch-1: A Letter to God',
                totalLessons: 6,
                completedLessons: 3,
                status: 'ongoing'
            },
            {
                school: 'Gaya Residential Academy',
                district: 'Gaya',
                schoolEmail: 'gaya.academy@edu.in',
                teacher: 'Manish Kumar',
                teacherEmail: 'manish.k@edu.in',
                teacherPhone: '9876543218',
                subject: 'Sanskrit',
                class: '9',
                topic: 'शुचिपर्यावरणम्',
                chapter: 'Ch-1: शुचिपर्यावरणम्',
                totalLessons: 5,
                completedLessons: 0,
                status: 'pending'
            },
            {
                school: 'Muzaffarpur Model Residential School',
                district: 'Muzaffarpur',
                schoolEmail: 'muzaffarpur.model@edu.in',
                teacher: 'Sanjay Gupta',
                teacherEmail: 'sanjay.g@edu.in',
                teacherPhone: '9876543219',
                subject: 'Computer Science',
                class: '11',
                topic: 'Python Programming Basics',
                chapter: 'Ch-5: Introduction to Python',
                totalLessons: 15,
                completedLessons: 10,
                status: 'ongoing'
            },
            {
                school: 'Bhagalpur Residential School',
                district: 'Bhagalpur',
                schoolEmail: 'bhagalpur.school@edu.in',
                teacher: 'Neha Sharma',
                teacherEmail: 'neha.s@edu.in',
                teacherPhone: '9876543220',
                subject: 'Mathematics',
                class: '12',
                topic: 'Matrices and Determinants',
                chapter: 'Ch-3: Matrices',
                totalLessons: 16,
                completedLessons: 16,
                status: 'completed'
            },
            {
                school: 'Darbhanga Welfare Residential School',
                district: 'Darbhanga',
                schoolEmail: 'darbhanga.school@edu.in',
                teacher: 'Vikram Thakur',
                teacherEmail: 'vikram.t@edu.in',
                teacherPhone: '9876543221',
                subject: 'Science',
                class: '7',
                topic: 'Nutrition in Plants',
                chapter: 'Ch-1: Nutrition in Plants',
                totalLessons: 7,
                completedLessons: 2,
                status: 'ongoing'
            },
            {
                school: 'Purnia SC/ST Residential School',
                district: 'Purnia',
                schoolEmail: 'purnia.school@edu.in',
                teacher: 'Rekha Devi',
                teacherEmail: 'rekha.d@edu.in',
                teacherPhone: '9876543222',
                subject: 'Hindi',
                class: '6',
                topic: 'वह चिड़िया जो',
                chapter: 'Ch-1: वह चिड़िया जो',
                totalLessons: 5,
                completedLessons: 0,
                status: 'pending'
            },
            {
                school: 'Munger Residential Academy',
                district: 'Munger',
                schoolEmail: 'munger.academy@edu.in',
                teacher: 'Arun Prasad',
                teacherEmail: 'arun.p@edu.in',
                teacherPhone: '9876543223',
                subject: 'Social Science',
                class: '9',
                topic: 'India – Size and Location',
                chapter: 'Ch-1: India – Size and Location',
                totalLessons: 6,
                completedLessons: 6,
                status: 'completed'
            }
        ];

        let currentMailData = null;

        function filterSchools() {
            const district = document.getElementById('filterDistrict').value;
            const schoolSelect = document.getElementById('filterSchool');
            schoolSelect.innerHTML = '<option value="">Select School</option>';

            if (district && schoolsByDistrict[district]) {
                schoolsByDistrict[district].forEach(school => {
                    const opt = document.createElement('option');
                    opt.value = school;
                    opt.textContent = school;
                    schoolSelect.appendChild(opt);
                });
            }
        }

        function showResults() {
            const district = document.getElementById('filterDistrict').value;
            const school = document.getElementById('filterSchool').value;
            const cls = document.getElementById('filterClass').value;
            const subject = document.getElementById('filterSubject').value;

            let filtered = [...dummyData];

            if (district) filtered = filtered.filter(d => d.district === district);
            if (school) filtered = filtered.filter(d => d.school === school);
            if (cls) filtered = filtered.filter(d => d.class === cls);
            if (subject) filtered = filtered.filter(d => d.subject === subject);

            renderTable(filtered);
        }

        function resetFilters() {
            document.getElementById('filterDistrict').value = '';
            document.getElementById('filterSchool').value = '';
            document.getElementById('filterClass').value = '';
            document.getElementById('filterSubject').value = '';
            document.getElementById('filterSchool').innerHTML = '<option value="">Select School</option>';

            document.getElementById('resultsTable').style.display = 'none';
            document.getElementById('summaryCards').style.display = 'none';
            document.getElementById('emptyState').style.display = 'block';
        }

        function renderTable(data) {
            const tbody = document.getElementById('trackingBody');
            const emptyState = document.getElementById('emptyState');
            const resultsTable = document.getElementById('resultsTable');
            const summaryCards = document.getElementById('summaryCards');

            if (data.length === 0) {
                resultsTable.style.display = 'none';
                summaryCards.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            resultsTable.style.display = 'block';
            summaryCards.style.display = 'grid';

            // Update summary counts
            const completed = data.filter(d => d.status === 'completed').length;
            const ongoing = data.filter(d => d.status === 'ongoing').length;
            const pending = data.filter(d => d.status === 'pending').length;

            document.getElementById('totalTopics').textContent = data.length;
            document.getElementById('completedCount').textContent = completed;
            document.getElementById('ongoingCount').textContent = ongoing;
            document.getElementById('pendingCount').textContent = pending;
            document.getElementById('resultInfo').textContent = `${data.length} records found`;

            tbody.innerHTML = '';

            data.forEach((item, index) => {
                const statusClasses = {
                    'completed': 'bg-green-100 text-green-700',
                    'ongoing': 'bg-yellow-100 text-yellow-700',
                    'pending': 'bg-red-100 text-red-700'
                };

                const statusIcons = {
                    'completed': '✅',
                    'ongoing': '🔄',
                    'pending': '⏳'
                };

                const progressPercent = item.totalLessons > 0 ? Math.round((item.completedLessons / item.totalLessons) * 100) : 0;
                const progressColor = progressPercent >= 100 ? 'bg-green-500' : progressPercent > 0 ? 'bg-yellow-500' : 'bg-gray-300';

                const row = document.createElement('tr');
                row.className = 'hover:bg-blue-50/50 transition duration-150';
                row.innerHTML = `
                                    <td class="py-2 sm:py-3 px-3 sm:px-4 text-gray-500 text-xs sm:text-sm font-medium">${index + 1}</td>

                                    <!-- School Details -->
                                    <td class="py-2 sm:py-3 px-3 sm:px-4">
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-800 text-xs sm:text-sm truncate max-w-[180px] sm:max-w-none">${item.school}</p>
                                            <p class="text-[10px] sm:text-xs text-gray-400">${item.district}</p>
                                            <p class="text-[10px] sm:text-xs text-gray-400 md:hidden mt-0.5">👩‍🏫 ${item.teacher}</p>
                                        </div>
                                    </td>

                                    <!-- Teacher Details (hidden on mobile) -->
                                    <td class="py-2 sm:py-3 px-3 sm:px-4 hidden md:table-cell">
                                        <div>
                                            <p class="font-medium text-gray-800 text-sm">${item.teacher}</p>
                                            <p class="text-xs text-gray-400">${item.teacherEmail}</p>
                                            <p class="text-xs text-gray-400">${item.teacherPhone}</p>
                                        </div>
                                    </td>

                                    <!-- Subject Details (hidden on mobile/tablet) -->
                                    <td class="py-2 sm:py-3 px-3 sm:px-4 hidden lg:table-cell">
                                        <div>
                                            <p class="font-medium text-gray-800 text-sm">${item.subject}</p>
                                            <p class="text-xs text-gray-400">Class ${item.class}</p>
                                        </div>
                                    </td>

                                    <!-- Topic Details -->
                                    <td class="py-2 sm:py-3 px-3 sm:px-4">
                                        <div class="min-w-[120px]">
                                            <p class="font-medium text-gray-800 text-xs sm:text-sm">${item.topic}</p>
                                            <p class="text-[10px] sm:text-xs text-gray-400">${item.chapter}</p>
                                            <p class="text-[10px] sm:text-xs text-gray-400 lg:hidden">${item.subject} • Class ${item.class}</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <div class="w-16 sm:w-20 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                                    <div class="${progressColor} h-full rounded-full" style="width: ${progressPercent}%"></div>
                                                </div>
                                                <span class="text-[10px] text-gray-400">${item.completedLessons}/${item.totalLessons}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td class="py-2 sm:py-3 px-3 sm:px-4 text-center">
                                        <span class="px-2 sm:px-3 py-1 text-[10px] sm:text-xs font-semibold rounded-full whitespace-nowrap ${statusClasses[item.status]}">
                                            ${statusIcons[item.status]} ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                        </span>
                                    </td>

                                    <!-- Action -->
                                    <td class="py-2 sm:py-3 px-3 sm:px-4 text-center">
                                        <button onclick='openMailModal(${JSON.stringify(item).replace(/'/g, "\\'")})'
                                            class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-medium transition whitespace-nowrap border border-blue-200">
                                            ✉️ <span class="hidden sm:inline">Send</span> Mail
                                        </button>
                                    </td>
                                `;

                tbody.appendChild(row);
            });
        }

        function openMailModal(item) {
            currentMailData = item;
            document.getElementById('mailDetails').innerHTML = `
                                <div class="flex justify-between"><span class="text-gray-500">School:</span> <span class="font-medium text-gray-700 text-right">${item.school}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Teacher:</span> <span class="font-medium text-gray-700">${item.teacher}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Subject:</span> <span class="font-medium text-gray-700">${item.subject} (Class ${item.class})</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Topic:</span> <span class="font-medium text-gray-700">${item.topic}</span></div>
                                <div class="flex justify-between"><span class="text-gray-500">Status:</span> <span class="font-semibold ${item.status === 'completed' ? 'text-green-600' : item.status === 'ongoing' ? 'text-yellow-600' : 'text-red-500'}">${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</span></div>
                            `;
            document.getElementById('mailMessage').value = '';
            const modal = document.getElementById('mailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeMailModal() {
            const modal = document.getElementById('mailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentMailData = null;
        }

        function sendMail(target) {
            if (!currentMailData) return;

            const recipient = target === 'school' ? currentMailData.schoolEmail : currentMailData.teacherEmail;
            const recipientName = target === 'school' ? currentMailData.school : currentMailData.teacher;

            Swal.fire({
                icon: 'success',
                title: 'Mail Sent!',
                html: `Notification mail sent successfully to <strong>${recipientName}</strong><br><small class="text-gray-500">${recipient}</small>`,
                timer: 3000,
                showConfirmButton: false
            });

            closeMailModal();
        }

        // -------- Add Syllabus Modal Functions --------
        function openAddSyllabusModal() {
            document.getElementById('addSyllabusForm').reset();
            clearFormErrors();
            const modal = document.getElementById('addSyllabusModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('syllabusCompletionDate').min = today;
        }

        function closeAddSyllabusModal() {
            const modal = document.getElementById('addSyllabusModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function clearFormErrors() {
            ['syllabusSubjectError', 'syllabusClassError', 'syllabusTopicsError',
                'syllabusAssignError', 'syllabusDateError'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add('hidden');
                });
            ['syllabusSubject', 'syllabusClass', 'syllabusTopics',
                'syllabusAssignTo', 'syllabusCompletionDate'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.remove('border-red-400');
                });
        }

        function showFieldError(fieldId, errorId) {
            document.getElementById(fieldId).classList.add('border-red-400');
            document.getElementById(errorId).classList.remove('hidden');
        }

        function submitSyllabusForm(e) {
            e.preventDefault();
            clearFormErrors();

            const subject = document.getElementById('syllabusSubject').value;
            const cls = document.getElementById('syllabusClass').value;
            const topics = document.getElementById('syllabusTopics').value.trim();
            const assign = document.getElementById('syllabusAssignTo').value;
            const date = document.getElementById('syllabusCompletionDate').value;

            let valid = true;

            if (!subject) { showFieldError('syllabusSubject', 'syllabusSubjectError'); valid = false; }
            if (!cls) { showFieldError('syllabusClass', 'syllabusClassError'); valid = false; }
            if (!topics) { showFieldError('syllabusTopics', 'syllabusTopicsError'); valid = false; }
            if (!assign) { showFieldError('syllabusAssignTo', 'syllabusAssignError'); valid = false; }
            if (!date) { showFieldError('syllabusCompletionDate', 'syllabusDateError'); valid = false; }

            if (!valid) return;

            // Simulate save — replace with real AJAX/form submission
            const btn = document.getElementById('saveSyllabusBtn');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `<svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg> Saving...`;
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                closeAddSyllabusModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Syllabus Entry Added!',
                    html: `<strong>${subject}</strong> for Class ${cls} has been assigned to <strong>${assign}</strong>.<br><small class="text-gray-500">Expected completion: ${date}</small>`,
                    timer: 3000,
                    showConfirmButton: false
                });
            }, 900);
        }

        // Load all dummy data on page load
        document.addEventListener('DOMContentLoaded', function () {
            renderTable(dummyData);
        });
    </script>
@endsection

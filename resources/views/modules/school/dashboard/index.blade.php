@extends('layouts.app')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">

        <!-- PAGE TITLE -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                {{ Auth::user()->role === 'school_admin' ? Auth::user()->school->school_name : '' }}
            </h1>
        </div>

        <!-- TOP CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <!-- Attendance -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Totals Teacher's</p>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ App\Models\Teacher::where('school_id', SchoolLogin()->id)->count() }} <span
                            class="text-sm text-gray-400">/ 450</span>
                    </h2>
                </div>
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <!-- Meal Status -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Student's</p>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ App\Models\Student::where('school_id', SchoolLogin()->id)->count() }} <span
                            class="text-sm text-gray-400">/ 450</span>
                    </h2>
                </div>
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <!-- Pending Reports -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Pending Reports</p>
                    <h2 class="text-xl font-bold text-red-500">2</h2>
                    <p class="text-xs text-gray-400">Monthly Infra & Health</p>
                </div>
                <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-file"></i>
                </div>
            </div>

            <!-- Hostel -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Hostel Occupancy</p>
                    <h2 class="text-xl font-bold text-purple-600">98%</h2>
                    <p class="text-xs text-gray-400">440 Beds Occupied</p>
                </div>
                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>

        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT SIDE -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">
                        Class-wise Attendance Entry
                    </h2>
                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                        {{ date('d-m-Y') }}
                    </span>
                </div>

                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-3 text-left px-4">Class</th>
                            <th class="py-3 text-left px-4">Total Students</th>
                            <th class="py-3 text-left px-4">Present</th>
                            <th class="py-3 text-left px-4">Absent</th>
                            <th class="py-3 text-left px-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse ($data as $row)
                            <tr>
                                <td class="py-3 px-4">Class {{ $row['class'] ?? "" }}</td>

                                <td class="py-3 px-4">{{ $row['total'] ?? "" }}</td>

                                <td class="py-3 px-4">
                                    <input type="number" value="{{ $row['present'] ?? "" }}"
                                        class="w-16 border rounded-md px-2 py-1 text-sm">
                                </td>

                                <td class="py-3 px-4 text-red-500">
                                    {{ $row['absent'] ?? "" }}
                                </td>

                                <td class="py-3 px-4 text-blue-600 text-sm cursor-pointer">
                                    Verify
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No Data Found</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                {{-- <div class="flex justify-end gap-4 mt-6">
                    <button class="text-gray-500 text-sm">Reset</button>
                    <button class="bg-primary-700 hover:bg-primary-800 text-white px-5 py-2 rounded-lg text-sm">
                        Save Attendance
                    </button>
                </div> --}}

            </div>

            <!-- RIGHT SIDE -->
            <div class="space-y-6">

                <!-- Meal Reporting -->
                <div class="bg-white rounded-xl shadow-sm p-6">

                    <h2 class="text-lg font-semibold mb-4">Meal Reporting</h2>

                    <div class="space-y-4">

                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                            <span>Breakfast</span>
                            <span class="text-green-600 text-sm">Reported</span>
                        </div>

                        <div class="flex justify-between items-center border border-orange-400 p-3 rounded-lg">
                            <div>
                                <p class="font-medium">Lunch</p>
                                <p class="text-xs text-orange-500">Due: 1:00 PM</p>
                            </div>
                            <button class="bg-orange-500 text-white text-xs px-3 py-1 rounded-md">
                                Mark Served
                            </button>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg opacity-60">
                            <span>Dinner</span>
                            <span class="text-xs">Upcoming</span>
                        </div>

                    </div>

                </div>

                <!-- Weekly Trend -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-sm font-semibold mb-4">WEEKLY ATTENDANCE TREND</h2>
                    <div class="h-52">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Chart.js -->


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');

        // Gradient Fill
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, "#164B68"); // Dark Top
        gradient.addColorStop(1, "#0b3c5d"); // Dark Bottom

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [{
                    label: 'Attendance',
                    data: [85, 90, 92, 88, 87],
                    backgroundColor: gradient,
                    borderRadius: 8,
                    barThickness: 40,
                    hoverBackgroundColor: '#123B52'
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
                        backgroundColor: '#ffffff',
                        titleColor: '#0b3c5d',
                        bodyColor: '#0b3c5d',
                        borderColor: '#e5e7eb',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Attendance : ' + context.raw;
                            }
                        }
                    }
                },

                scales: {
                    y: {
                        display: false,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 12
                            }
                        }
                    }
                },

                animation: {
                    duration: 1800,
                    easing: 'easeOutQuart'
                }
            }
        });
    </script>
@endsection

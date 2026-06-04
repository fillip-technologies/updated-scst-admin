@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <div class="grid grid-cols-4 gap-6">

            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <p class="text-sm text-gray-500">Total Schools</p>
                <h2 class="text-2xl font-semibold text-gray-900 mt-1">{{ AdminLogin() ? $data['school'] : 0 }}</h2>
                <p class="text-xs text-green-500 mt-1">Number Of All Schools</p>
            </div>

            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <p class="text-sm text-gray-500">All Students</p>
                <h2 class="text-2xl font-semibold text-gray-900 mt-1">{{AdminLogin() ?  $data['student'] : 0 }}</h2>
                <p class="text-xs text-red-500 mt-1">Number Of All Students</p>
            </div>

            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <p class="text-sm text-gray-500">Total Teachers</p>
                <h2 class="text-2xl font-semibold text-red-600 mt-1">{{ AdminLogin() ? $data['teacher'] : 0 }}</h2>
                <p class="text-xs text-gray-400 mt-1">Number Of All Teachers </p>
            </div>

            <div class="bg-white border rounded-xl p-5 shadow-sm">
                <p class="text-sm text-gray-500">Today Meals Reports</p>
                <h2 class="text-2xl font-semibold text-yellow-500 mt-1">{{ AdminLogin() ?  $data['meals']  : 0}}</h2>
                <p class="text-xs text-gray-400 mt-1">Meals Reports</p>
            </div>
            <!-- <div class="bg-white border rounded-xl p-5 shadow-sm">-->
            <!--    <p class="text-sm text-gray-500">Today Academics Reports</p>-->
            <!--    <h2 class="text-2xl font-semibold text-yellow-500 mt-1">{{AdminLogin() ? $data['report'] : 0 }}</h2>-->
            <!--    <p class="text-xs text-gray-400 mt-1">Academin and Infrastructure</p>-->
            <!--</div>-->

        </div>



        <div class="grid grid-cols-3 gap-6">

            <div class="col-span-2 bg-white rounded-xl border p-6 shadow-sm">

                <div class="flex justify-between mb-4">
                    <h3 class="font-semibold text-gray-800">
                        Statewide Performance Trends
                    </h3>
                    <select class="text-sm border rounded px-3 py-1">
                        <option>Last 6 Months</option>
                    </select>
                </div>

                <div style="height:300px;">
                    <canvas id="lineChart"></canvas>
                </div>

            </div>


            <div class="bg-white rounded-xl border p-6 shadow-sm space-y-6">

                <div>
                    <h3 class="font-semibold text-red-500 text-sm mb-3">
                        Non-Reporting Schools
                    </h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span>Dr. B.R. Ambedkar Sch...</span>
                            <button class="text-primary-600 text-xs">Remind</button>
                        </div>
                        <div class="flex justify-between">
                            <span>Dr. B.R. Ambedkar Sch...</span>
                            <button class="text-primary-600 text-xs">Remind</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <!-- ===================== BAR GRAPH ===================== -->
        <div class="bg-white rounded-xl border p-6 shadow-sm">

            <div class="flex justify-between mb-4">
                <h3 class="font-semibold text-gray-800">
                    District-wise Compliance
                </h3>
                <a href="#" class="text-sm text-primary-600">
                    View All Districts
                </a>
            </div>

            <div style="height:280px;">
                <canvas id="barChart"></canvas>
            </div>

        </div>

    </div>



    <!-- ===================== CHART JS ===================== -->


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ===== LINE CHART WITH MOTION =====
            const lineCtx = document.getElementById('lineChart').getContext('2d');

            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        data: [65, 70, 78, 74, 82, 90],
                        borderColor: '#0b3c5d',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 0,
                        fill: true,
                        backgroundColor: (context) => {
                            const gradient = context.chart.ctx.createLinearGradient(0, 0, 0,
                                300);
                            gradient.addColorStop(0, 'rgba(11,60,93,0.4)');
                            gradient.addColorStop(1, 'rgba(11,60,93,0)');
                            return gradient;
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuart'
                    },

                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9'
                            }
                        }
                    }
                }
            });



            // ===== BAR CHART =====
            const barCtx = document.getElementById('barChart').getContext('2d');

            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: ['Patna', 'Gaya', 'Muzaffarpur', 'Nalanda', 'Bhagalpur', 'Darbhanga'],
                    datasets: [{
                        data: [95, 85, 70, 98, 80, 90],
                        backgroundColor: '#F4B400',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>
@endsection

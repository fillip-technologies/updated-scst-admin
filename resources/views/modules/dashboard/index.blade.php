@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- ===================== TOP CARDS ===================== -->
    <div class="grid grid-cols-4 gap-6">

        <div class="bg-white border rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Schools Reporting Today</p>
            <h2 class="text-2xl font-semibold text-gray-900 mt-1">76</h2>
            <p class="text-xs text-green-500 mt-1">+4.5% from yesterday</p>
        </div>

        <div class="bg-white border rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Attendance Avg</p>
            <h2 class="text-2xl font-semibold text-gray-900 mt-1">84.5%</h2>
            <p class="text-xs text-red-500 mt-1">-1.2% from last week</p>
        </div>

        <div class="bg-white border rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Critical Issues</p>
            <h2 class="text-2xl font-semibold text-red-600 mt-1">5</h2>
            <p class="text-xs text-gray-400 mt-1">Require immediate attention</p>
        </div>

        <div class="bg-white border rounded-xl p-5 shadow-sm">
            <p class="text-sm text-gray-500">Pending Approvals</p>
            <h2 class="text-2xl font-semibold text-yellow-500 mt-1">12</h2>
            <p class="text-xs text-gray-400 mt-1">Monthly reports & infra</p>
        </div>

    </div>



    <!-- ===================== LINE GRAPH + RIGHT PANEL ===================== -->
    <div class="grid grid-cols-3 gap-6">

        <!-- Line Graph -->
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


        <!-- Right Panel -->
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
                        const gradient = context.chart.ctx.createLinearGradient(0, 0, 0, 300);
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
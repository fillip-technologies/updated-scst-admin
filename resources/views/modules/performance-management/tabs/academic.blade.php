<div class="space-y-8">

    <!-- ================= TOP CHARTS ================= -->
    <div class="grid grid-cols-2 gap-6">

        <!-- Academic Trend -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h3 class="font-semibold mb-4">Academic Performance Trend</h3>
            <canvas id="academicTrendChart" height="220"></canvas>
        </div>

        <!-- District Comparison -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h3 class="font-semibold mb-4">District Comparison</h3>
            <canvas id="districtAcademicChart" height="220"></canvas>
        </div>

    </div>


    <!-- ================= DISTRICT TABLE ================= -->
    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b">
            <h3 class="font-semibold">District Wise Academic Data</h3>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">District</th>
                    <th class="px-6 py-3 text-left">Score</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">

                @php
                $districts = [
                ['Patna',88,'Excellent'],
                ['Gaya',76,'Average'],
                ['Muzaffarpur',82,'Excellent'],
                ['Bhagalpur',79,'Average'],
                ['Darbhanga',85,'Excellent'],
                ['Purnia',81,'Excellent'],
                ['Rohtas',75,'Average'],
                ['Saran',78,'Average'],
                ['Munger',83,'Excellent'],
                ['Nalanda',90,'Excellent'],
                ['Aurangabad',74,'Average'],
                ['Begusarai',80,'Average'],
                ];
                @endphp

                @foreach($districts as $d)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $d[0] }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-blue-600">
                        {{ $d[1] }}%
                    </td>

                    <td class="px-6 py-4">
                        @if($d[2] == 'Excellent')
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                            Excellent
                        </span>
                        @else
                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                            Average
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a href="#" class="text-primary-600 text-sm hover:underline">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>

</div>


<!-- ================= CHART JS ================= -->


<script>
    document.addEventListener("DOMContentLoaded", function() {

        // ================= ACADEMIC TREND =================
        const ctx1 = document.getElementById('academicTrendChart').getContext('2d');

        const gradient = ctx1.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, "rgba(30,58,138,0.6)");
        gradient.addColorStop(1, "rgba(30,58,138,0.05)");

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [75, 78, 76, 82, 85, 90],
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#1e3a8a',
                    tension: 0.4,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // ================= DISTRICT BAR =================
        new Chart(document.getElementById('districtAcademicChart'), {
            type: 'bar',
            data: {
                labels: ['Patna', 'Gaya', 'Muzaffarpur', 'Bhagalpur', 'Darbhanga', 'Purnia', 'Rohtas', 'Saran'],
                datasets: [{
                    label: 'Academic Score',
                    data: [88, 76, 82, 79, 85, 81, 75, 78],
                    backgroundColor: '#f59e0b',
                    borderRadius: 6,
                    barThickness: 10
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

    });
</script>
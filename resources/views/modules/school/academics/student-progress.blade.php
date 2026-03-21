<!-- ================= STUDENT PROGRESS SECTION ================= -->

<div class="grid lg:grid-cols-12 gap-6">

    <!-- Student List -->
    <div class="lg:col-span-4 bg-white rounded-xl shadow-sm p-6">

        <h2 class="font-semibold text-gray-700 mb-6">
            Select Student
        </h2>

        <div class="space-y-3 text-sm">

            @for($i=1;$i<=8;$i++)
                <button onclick="selectStudent('Student {{ $i }}')"
                class="w-full text-left px-4 py-2 rounded-lg hover:bg-primary-50 hover:text-primary-900 transition student-btn {{ $i==1 ? 'bg-primary-50 text-primary-900 font-medium' : '' }}">
                Student {{ $i }}
                </button>
                @endfor

        </div>

    </div>


    <!-- Right Section -->
    <div class="lg:col-span-8 space-y-6">

        <!-- Student Overview Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 id="studentName" class="text-lg font-semibold text-gray-800">
                        Student 1 Performance Overview
                    </h2>
                    <p class="text-sm text-gray-500">
                        Class 10 • Roll No: 101
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-sm text-gray-500">Overall Average</p>
                    <p class="text-2xl font-bold text-primary-900">86%</p>
                </div>
            </div>

            <div class="h-72">
                <canvas id="progressChart"></canvas>
            </div>

        </div>


        <!-- Subject Progress -->
        <div class="bg-white rounded-xl shadow-sm p-6">

            <h2 class="font-semibold text-gray-700 mb-6">
                Subject-wise Performance
            </h2>

            <div class="space-y-5 text-sm">

                <!-- Math -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Math</span>
                        <span class="font-medium">88%</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-primary-900 h-2 rounded-full" style="width:88%"></div>
                    </div>
                </div>

                <!-- Science -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Science</span>
                        <span class="font-medium">82%</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-green-600 h-2 rounded-full" style="width:82%"></div>
                    </div>
                </div>

                <!-- English -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span>English</span>
                        <span class="font-medium">91%</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width:91%"></div>
                    </div>
                </div>

                <!-- Social -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Social Science</span>
                        <span class="font-medium">78%</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-blue-600 h-2 rounded-full" style="width:78%"></div>
                    </div>
                </div>

                <!-- Hindi -->
                <div>
                    <div class="flex justify-between mb-1">
                        <span>Hindi</span>
                        <span class="font-medium">85%</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full">
                        <div class="bg-purple-600 h-2 rounded-full" style="width:85%"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const ctx = document.getElementById('progressChart').getContext('2d');

        const gradientLine = ctx.createLinearGradient(0, 0, 0, 300);
        gradientLine.addColorStop(0, "rgba(22,75,104,0.5)");
        gradientLine.addColorStop(1, "rgba(22,75,104,0.05)");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Monthly Average',
                    data: [75, 80, 78, 85, 88, 86],
                    borderColor: '#164B68',
                    backgroundColor: gradientLine,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#164B68',
                    pointRadius: 5
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
                        backgroundColor: '#111827',
                        padding: 10
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

    });


    function selectStudent(name) {
        document.getElementById('studentName').innerText = name + " Performance Overview";

        document.querySelectorAll('.student-btn').forEach(btn => {
            btn.classList.remove('bg-primary-50', 'text-primary-900', 'font-medium');
        });

        event.target.classList.add('bg-primary-50', 'text-primary-900', 'font-medium');
    }
</script>
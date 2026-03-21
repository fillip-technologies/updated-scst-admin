<!-- ================= EXAM RESULTS SECTION ================= -->

<div class="grid lg:grid-cols-12 gap-6 mb-6">

    <!-- Performance Overview -->
    <div class="lg:col-span-4 bg-white rounded-xl shadow-sm p-6">

        <h2 class="font-semibold text-gray-700 mb-6">
            Class Performance Overview
        </h2>

        <div class="space-y-4 text-sm">

            <div class="flex justify-between">
                <span class="text-gray-500">Selected Class</span>
                <span class="font-medium text-primary-900">Class 10</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Total Students</span>
                <span class="font-medium">45</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Pass Percentage</span>
                <span class="font-medium text-green-600">92%</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Top Scorer</span>
                <span class="font-medium">Amit Kumar (98%)</span>
            </div>

            <div class="pt-4 border-t mt-4">
                <label class="text-gray-500 text-xs">Change Class</label>
                <select class="mt-2 w-full border rounded-lg px-3 py-2 text-sm">
                    <option>Class 10</option>
                    <option>Class 9</option>
                    <option>Class 8</option>
                </select>
            </div>

        </div>
    </div>


    <!-- Subject Chart -->
    <div class="lg:col-span-8 bg-white rounded-xl shadow-sm p-6">

        <h2 class="font-semibold text-gray-700 mb-6">
            Subject-wise Average Score
        </h2>

        <div class="h-80">
            <canvas id="subjectChart"></canvas>
        </div>

    </div>

</div>


<!-- Bottom Row -->
<div class="grid lg:grid-cols-12 gap-6">

    <!-- Upcoming Exams -->
    <div class="lg:col-span-4 bg-white rounded-xl shadow-sm p-6">

        <h2 class="font-semibold text-gray-700 mb-6">
            Upcoming Exams
        </h2>

        <div class="space-y-6 text-sm">

            <div class="flex gap-4 items-start">
                <div class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-2 rounded-lg text-center">
                    OCT<br>25
                </div>
                <div>
                    <p class="font-medium">Unit Test II - Science</p>
                    <p class="text-gray-500 text-xs">
                        Class 10 • 10:00 AM - 11:30 AM
                    </p>
                </div>
            </div>

            <div class="flex gap-4 items-start">
                <div class="bg-purple-100 text-purple-600 text-xs font-semibold px-3 py-2 rounded-lg text-center">
                    NOV<br>10
                </div>
                <div>
                    <p class="font-medium">Half Yearly Exams</p>
                    <p class="text-gray-500 text-xs">
                        All Classes • 09:00 AM - 12:00 PM
                    </p>
                </div>
            </div>

        </div>
    </div>


    <!-- Recent Exam Results -->
    <div class="lg:col-span-8 bg-white rounded-xl shadow-sm">

        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h2 class="font-semibold text-gray-700">
                Recent Exam Results
            </h2>

            <button class="text-primary-900 text-sm">
                View All Records
            </button>
        </div>

        <div class="divide-y">

            @for($i=1;$i<=3;$i++)
                <div class="flex justify-between items-center px-6 py-4 hover:bg-gray-50 transition">

                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-check text-xs"></i>
                    </div>

                    <div>
                        <p class="text-sm font-medium">
                            Unit Test I Results Published
                        </p>
                        <p class="text-xs text-gray-500">
                            Class 10 - Science & Math
                        </p>
                    </div>
                </div>

                <span class="text-xs text-gray-400">
                    2 days ago
                </span>

        </div>
        @endfor

    </div>

</div>

</div>


<!-- Chart Script -->


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const ctx = document.getElementById('subjectChart').getContext('2d');

        const gradientBlue = ctx.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, "#164B68");
        gradientBlue.addColorStop(1, "#0b3c5d");

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Math', 'Science', 'English', 'Social Sci', 'Hindi'],
                datasets: [{
                        label: 'Class Average',
                        data: [75, 82, 90, 70, 88],
                        backgroundColor: gradientBlue,
                        borderRadius: 6
                    },
                    {
                        label: 'School Average',
                        data: [80, 78, 85, 72, 90],
                        backgroundColor: '#F4B400',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        backgroundColor: '#111827',
                        padding: 10,
                        titleColor: '#fff',
                        bodyColor: '#fff'
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
</script>   
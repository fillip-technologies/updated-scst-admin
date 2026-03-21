<div class="space-y-8">

    <!-- ================= Summary Cards ================= -->
    <div class="grid grid-cols-4 gap-6">

        <!-- Avg Attendance -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Avg Attendance</p>
                    <h3 class="text-2xl font-semibold mt-2">88%</h3>
                    <p class="text-xs text-green-600 mt-1">+2.5% vs last month</p>
                </div>
                <div class="text-green-500 text-xl">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
            </div>
        </div>

        <!-- Non Reporting -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Non-Reporting</p>
                    <h3 class="text-2xl font-semibold mt-2">15</h3>
                    <p class="text-xs text-red-500 mt-1">-5 vs last month</p>
                </div>
                <div class="text-red-500 text-xl">
                    <i class="fa-regular fa-circle-xmark"></i>
                </div>
            </div>
        </div>

        <!-- Submission Time -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Submission Time</p>
                    <h3 class="text-2xl font-semibold mt-2">10:30 AM</h3>
                    <p class="text-xs text-green-600 mt-1">On Time vs last month</p>
                </div>
                <div class="text-blue-500 text-xl">
                    <i class="fa-regular fa-clock"></i>
                </div>
            </div>
        </div>

        <!-- Hostel Occupancy -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-gray-500">Hostel Occupancy</p>
                    <h3 class="text-2xl font-semibold mt-2">92%</h3>
                    <p class="text-xs text-green-600 mt-1">+1.2% vs last month</p>
                </div>
                <div class="text-purple-500 text-xl">
                    <i class="fa-solid fa-bed"></i>
                </div>
            </div>
        </div>

    </div>


    <!-- ================= Charts Section ================= -->
    <div class="grid grid-cols-2 gap-6">

        <!-- District-wise Performance -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">District-wise Performance</h3>
                <a href="#" class="text-sm text-primary-600 hover:underline">View All</a>
            </div>

            <!-- Fake Chart Bars -->
            <div class="space-y-3 text-sm">

                <div>
                    <p>Patna</p>
                    <div class="w-full bg-gray-200 h-2 rounded mt-1">
                        <div class="bg-yellow-400 h-2 rounded w-[92%]"></div>
                    </div>
                </div>

                <div>
                    <p>Muzaffarpur</p>
                    <div class="w-full bg-gray-200 h-2 rounded mt-1">
                        <div class="bg-yellow-400 h-2 rounded w-[85%]"></div>
                    </div>
                </div>

                <div>
                    <p>Darbhanga</p>
                    <div class="w-full bg-gray-200 h-2 rounded mt-1">
                        <div class="bg-yellow-400 h-2 rounded w-[88%]"></div>
                    </div>
                </div>

            </div>

        </div>


        <!-- State Average Trend -->
        <div class="bg-white border rounded-2xl p-6 shadow-sm">
            <h3 class="font-semibold mb-4">State Average Performance Trend</h3>

            <div class="h-40 flex items-end space-x-2">
                <div class="bg-primary-700 w-8 h-[70%] rounded-t"></div>
                <div class="bg-primary-700 w-8 h-[75%] rounded-t"></div>
                <div class="bg-primary-700 w-8 h-[73%] rounded-t"></div>
                <div class="bg-primary-700 w-8 h-[80%] rounded-t"></div>
                <div class="bg-primary-700 w-8 h-[85%] rounded-t"></div>
                <div class="bg-primary-700 w-8 h-[88%] rounded-t"></div>
            </div>

            <div class="flex justify-between text-xs text-gray-500 mt-2">
                <span>Jan</span>
                <span>Feb</span>
                <span>Mar</span>
                <span>Apr</span>
                <span>May</span>
                <span>Jun</span>
            </div>

        </div>

    </div>


    <!-- ================= Ranking Table ================= -->
    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">

        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="font-semibold">Top Performing Schools</h3>
            <a href="#" class="text-sm text-primary-600 hover:underline">View Full Rankings</a>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">Rank</th>
                    <th class="px-6 py-3 text-left">School Name</th>
                    <th class="px-6 py-3 text-left">District</th>
                    <th class="px-6 py-3 text-left">Score</th>
                    <th class="px-6 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">

                <tr>
                    <td class="px-6 py-4 font-medium">#1</td>
                    <td class="px-6 py-4">Dr. B.R. Ambedkar Residential School, Patna</td>
                    <td class="px-6 py-4">Patna</td>
                    <td class="px-6 py-4 text-blue-600 font-semibold">94</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                            Good
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="px-6 py-4 font-medium">#2</td>
                    <td class="px-6 py-4">Dr. B.R. Ambedkar Residential School, Nalanda</td>
                    <td class="px-6 py-4">Nalanda</td>
                    <td class="px-6 py-4 text-blue-600 font-semibold">91</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                            Good
                        </span>
                    </td>
                </tr>

            </tbody>
        </table>

    </div>

</div>
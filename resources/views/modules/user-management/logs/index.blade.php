@extends('modules.user-management.index')

@section('user-content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">
            System Access Logs
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Monitor user activities, logins, and system changes in real-time.
        </p>
    </div>

    <button class="flex items-center gap-2 px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
        <i class="fa-solid fa-download"></i>
        Export CSV
    </button>
</div>


<!-- FILTER BAR -->
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 mb-6 flex justify-between items-center">

    <div class="relative w-96">
        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-sm"></i>
        <input type="text"
            placeholder="Search by user, action or IP..."
            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-900">
    </div>

    <div class="flex gap-3">

        <select class="px-4 py-2 text-sm border border-gray-300 rounded-lg">
            <option>All Actions</option>
            <option>Login</option>
            <option>Update</option>
            <option>Create</option>
        </select>

        <input type="date"
            class="px-4 py-2 text-sm border border-gray-300 rounded-lg">

    </div>

</div>



<!-- TABLE -->
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="p-4 text-left">TIMESTAMP</th>
                <th class="p-4 text-left">USER</th>
                <th class="p-4 text-left">ACTION</th>
                <th class="p-4 text-left">MODULE</th>
                <th class="p-4 text-left">DETAILS</th>
                <th class="p-4 text-left">IP ADDRESS</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">

            <!-- ROW 1 -->
            <tr class="hover:bg-gray-50">
                <td class="p-4 text-gray-500">Today, 10:30 AM</td>

                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold">
                            A
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">Amit Kumar</div>
                            <div class="text-xs text-gray-400">Department Admin</div>
                        </div>
                    </div>
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                        School Added
                    </span>
                </td>

                <td class="p-4">School Management</td>
                <td class="p-4 text-gray-600">
                    Added 'Dr. B.R. Ambedkar School, Hajipur'
                </td>
                <td class="p-4 text-gray-500">192.168.1.10</td>
            </tr>


            <!-- ROW 2 -->
            <tr class="hover:bg-gray-50">
                <td class="p-4 text-gray-500">Today, 09:15 AM</td>

                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold">
                            P
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">Priya Sharma</div>
                            <div class="text-xs text-gray-400">Director</div>
                        </div>
                    </div>
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                        Report Approved
                    </span>
                </td>

                <td class="p-4">Approvals</td>
                <td class="p-4 text-gray-600">
                    Approved Monthly Report for Patna District
                </td>
                <td class="p-4 text-gray-500">192.168.1.15</td>
            </tr>


            <!-- ROW 3 -->
            <tr class="hover:bg-gray-50">
                <td class="p-4 text-gray-500">Yesterday, 04:45 PM</td>

                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold">
                            A
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">Amit Kumar</div>
                            <div class="text-xs text-gray-400">Department Admin</div>
                        </div>
                    </div>
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-full">
                        User Created
                    </span>
                </td>

                <td class="p-4">User Management</td>
                <td class="p-4 text-gray-600">
                    Created principal account for Muzaffarpur School
                </td>
                <td class="p-4 text-gray-500">192.168.1.10</td>
            </tr>


            <!-- ROW 4 -->
            <tr class="hover:bg-gray-50">
                <td class="p-4 text-gray-500">Yesterday, 04:00 AM</td>

                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold">
                            S
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">System</div>
                            <div class="text-xs text-gray-400">System</div>
                        </div>
                    </div>
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">
                        System Backup
                    </span>
                </td>

                <td class="p-4">Settings</td>
                <td class="p-4 text-gray-600">
                    Automated daily backup completed
                </td>
                <td class="p-4 text-gray-500">Localhost</td>
            </tr>


            <!-- ROW 5 -->
            <tr class="hover:bg-gray-50">
                <td class="p-4 text-gray-500">2 days ago</td>

                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold">
                            U
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">Unknown</div>
                            <div class="text-xs text-gray-400">-</div>
                        </div>
                    </div>
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded-full">
                        Login Failed
                    </span>
                </td>

                <td class="p-4">Auth</td>
                <td class="p-4 text-gray-600">
                    Multiple failed login attempts
                </td>
                <td class="p-4 text-gray-500">45.12.33.11</td>
            </tr>

        </tbody>

    </table>

    <!-- FOOTER -->
    <div class="flex justify-between items-center p-4 border-t text-sm text-gray-500">
        <div>Showing 6 records</div>

        <div class="flex gap-2">
            <button class="px-3 py-1 border rounded text-gray-400">Previous</button>
            <button class="px-3 py-1 border rounded bg-gray-100">Next</button>
        </div>
    </div>

</div>

@endsection
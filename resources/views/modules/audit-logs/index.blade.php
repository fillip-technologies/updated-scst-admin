@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Audit Logs
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Track system activities and security events.
        </p>
    </div>


    <!-- SEARCH BAR -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 mb-6">

        <div class="relative w-96">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400 text-sm"></i>
            <input type="text"
                placeholder="Search logs..."
                class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-900">
        </div>

    </div>



    <!-- TABLE -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-4 text-left">ACTION</th>
                    <th class="p-4 text-left">DETAIL</th>
                    <th class="p-4 text-left">USER</th>
                    <th class="p-4 text-left">TIME</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium">School Added</td>
                    <td class="p-4 text-gray-600">
                        Added 'Dr. B.R. Ambedkar School, Hajipur'
                    </td>
                    <td class="p-4 text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user text-gray-400"></i>
                            Admin Officer
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">Today, 10:30 AM</td>
                </tr>


                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium">Report Approved</td>
                    <td class="p-4 text-gray-600">
                        Approved Monthly Report for Patna District
                    </td>
                    <td class="p-4 text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user text-gray-400"></i>
                            Director
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">Today, 09:15 AM</td>
                </tr>


                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium">User Created</td>
                    <td class="p-4 text-gray-600">
                        Created principal account for Muzaffarpur School
                    </td>
                    <td class="p-4 text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user text-gray-400"></i>
                            Admin Officer
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">Yesterday, 04:45 PM</td>
                </tr>


                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium">System Backup</td>
                    <td class="p-4 text-gray-600">
                        Automated daily backup completed
                    </td>
                    <td class="p-4 text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user text-gray-400"></i>
                            System
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">Yesterday, 04:00 AM</td>
                </tr>


                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium text-red-600">Login Failed</td>
                    <td class="p-4 text-gray-600">
                        Multiple failed login attempts from IP 192.168.1.1
                    </td>
                    <td class="p-4 text-gray-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user text-gray-400"></i>
                            Unknown
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">2 days ago</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection
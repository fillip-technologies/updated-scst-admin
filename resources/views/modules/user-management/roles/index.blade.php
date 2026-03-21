@extends('modules.user-management.index')

@section('user-content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">
            Role Management
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Define roles and assign permissions across the system.
        </p>
    </div>

    <a href="#"
        class="flex items-center gap-2 bg-primary-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-primary-800 transition">
        <i class="fa-solid fa-plus"></i>
        Create New Role
    </a>
</div>


<!-- ROLE CARDS GRID -->
<div class="grid grid-cols-3 gap-6">

    <!-- DIRECTOR -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-md transition">

        <div class="flex items-start gap-4 mb-4">

            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 text-lg">Director</h3>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                    Monitoring
                </span>
            </div>

        </div>

        <p class="text-sm text-gray-500 mb-6">
            Full read access to all modules, approval authority, cannot delete system configs.
        </p>

        <div class="border-t pt-4 flex justify-between items-center">

            <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U1</div>
            </div>

            <span class="text-sm text-gray-500">1 Users</span>

        </div>

    </div>


    <!-- DEPARTMENT ADMIN -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-md transition">

        <div class="flex items-start gap-4 mb-4">

            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 text-lg">Department Admin</h3>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                    Admin
                </span>
            </div>

        </div>

        <p class="text-sm text-gray-500 mb-6">
            Full CRUD access to all modules including user management and system settings.
        </p>

        <div class="border-t pt-4 flex justify-between items-center">

            <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U1</div>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U2</div>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U3</div>
            </div>

            <span class="text-sm text-gray-500">3 Users</span>

        </div>

    </div>


    <!-- DISTRICT OFFICER -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-md transition relative">

        <a href="#" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fa-regular fa-pen-to-square"></i>
        </a>

        <div class="flex items-start gap-4 mb-4">

            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 text-lg">District Officer</h3>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                    Monitoring
                </span>
            </div>

        </div>

        <p class="text-sm text-gray-500 mb-6">
            Monitoring and reporting access for assigned district schools only.
        </p>

        <div class="border-t pt-4 flex justify-between items-center">

            <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U1</div>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U2</div>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">+34</div>
            </div>

            <span class="text-sm text-gray-500">38 Users</span>

        </div>

    </div>


    <!-- SCHOOL PRINCIPAL -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-md transition">

        <div class="flex items-start gap-4 mb-4">

            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 text-lg">School Principal</h3>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                    Reporting
                </span>
            </div>

        </div>

        <p class="text-sm text-gray-500 mb-6">
            Data entry and reporting for their specific school. View own school analytics.
        </p>

        <div class="border-t pt-4 flex justify-between items-center">

            <div class="flex -space-x-2">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">U1</div>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs">+87</div>
            </div>

            <span class="text-sm text-gray-500">91 Users</span>

        </div>

    </div>

</div>

@endsection
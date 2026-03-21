@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800">
            System Settings
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Configure system preferences and security.
        </p>
    </div>


    <!-- GRID -->
    <div class="grid grid-cols-3 gap-6">

        <!-- LOCALIZATION -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">

            <div class="flex items-center gap-3 mb-4">
                <i class="fa-solid fa-globe text-primary-900 text-lg"></i>
                <h3 class="font-semibold text-gray-800">Localization</h3>
            </div>

            <p class="text-sm text-gray-500 mb-4">
                Set default language and region formats.
            </p>

            <select class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
                <option>English (India)</option>
                <option>English (US)</option>
            </select>

        </div>



        <!-- NOTIFICATIONS -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">

            <div class="flex items-center gap-3 mb-4">
                <i class="fa-solid fa-bell text-primary-900 text-lg"></i>
                <h3 class="font-semibold text-gray-800">Notifications</h3>
            </div>

            <p class="text-sm text-gray-500 mb-4">
                Manage email and SMS alerts.
            </p>

            <div class="space-y-3">

                <label class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">Email Alerts</span>
                    <input type="checkbox"
                        checked
                        class="w-4 h-4 rounded"
                        style="accent-color:#0F2E4D">
                </label>

                <label class="flex items-center justify-between">
                    <span class="text-sm text-gray-700">SMS Alerts</span>
                    <input type="checkbox"
                        checked
                        class="w-4 h-4 rounded"
                        style="accent-color:#0F2E4D">
                </label>

            </div>

        </div>



        <!-- SECURITY -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">

            <div class="flex items-center gap-3 mb-4">
                <i class="fa-solid fa-lock text-primary-900 text-lg"></i>
                <h3 class="font-semibold text-gray-800">Security</h3>
            </div>

            <p class="text-sm text-gray-500 mb-4">
                Password policies and 2FA.
            </p>

            <a href="#"
                class="text-primary-900 text-sm font-medium hover:underline">
                Change Admin Password
            </a>

        </div>


        <!-- BACKUP -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 col-span-1">

            <div class="flex items-center gap-3 mb-4">
                <i class="fa-solid fa-database text-primary-900 text-lg"></i>
                <h3 class="font-semibold text-gray-800">Backup & Data</h3>
            </div>

            <p class="text-sm text-gray-500 mb-4">
                Last backup: Today, 04:00 AM
            </p>

            <button class="px-4 py-2 text-sm bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200">
                Trigger Manual Backup
            </button>

        </div>

    </div>

</div>

@endsection
<div class="space-y-8">

    <!-- System Status Card -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
            <i class="fa-solid fa-lock text-gray-500 text-lg"></i>
            <h3 class="text-lg font-semibold text-gray-800">
                System Status
            </h3>
        </div>

        <!-- Active Status Row -->
        <div class="flex items-center justify-between">

            <div
                class="flex items-center justify-between bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">

                <!-- Left Content -->
                <div class="flex items-center gap-4">

                    <!-- Status Icon -->
                    <div
                        class="w-12 h-12 flex items-center justify-center rounded-xl
                     {{ $editschl->account_status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">

                        <i
                            class="fa-solid {{ $editschl->account_status ? 'fa-circle-check' : 'fa-circle-xmark' }} text-lg"></i>
                    </div>

                    <!-- Text -->
                    <div>
                        <h4 class="font-semibold text-gray-800 text-base">
                            {{ $editschl->account_status ? 'Active' : 'Inactive' }}
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $editschl->account_status
                                ? 'School is visible and operational in the system'
                                : 'School is currently inactive and hidden from system' }}
                        </p>
                    </div>
                </div>

                <!-- Badge -->
                <span
                    class="px-3 py-1 text-xs font-medium rounded-full
        {{ $editschl->account_status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $editschl->account_status ? 'Active' : 'Inactive' }}
                </span>

            </div>


        </div>

    </div>


    <!-- Login Management Card -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">

        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
            <i class="fa-solid fa-key text-gray-500 text-lg"></i>
            <h3 class="text-lg font-semibold text-gray-800">
                Login Management
            </h3>
        </div>

        <!-- Reset Password -->
        <a href="#" class="text-blue-600 text-sm font-medium hover:underline">
            Reset School Admin Password
        </a>

    </div>

</div>

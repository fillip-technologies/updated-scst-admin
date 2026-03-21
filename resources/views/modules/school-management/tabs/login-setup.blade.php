<div class="space-y-8">

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex items-start gap-4">

        <div class="text-blue-600 text-lg mt-1">
            <i class="fa-solid fa-cloud"></i>
        </div>

        <div>
            <h3 class="text-blue-800 font-semibold">
                Login Credentials
            </h3>
            <p class="text-sm text-blue-700 mt-1">
                These credentials will be shared with the School Principal for accessing the School Dashboard.
            </p>
        </div>

    </div>


    <!-- School Admin Username -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            School Admin Username <span class="text-red-500">*</span>
        </label>

        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="fa-regular fa-user"></i>
            </span>

            <input type="text"
                name="school_admin_username"

                placeholder="e.g. admin_patna_001"
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                       text-sm placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
        </div>
    </div>


    <!-- Temporary Password -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Temporary Password <span class="text-red-500">*</span>
        </label>

        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <i class="fa-solid fa-key"></i>
            </span>

            <input type="password"
                name="password"
                placeholder="Generate secure password..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                       text-sm placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
        </div>

        <p class="text-xs text-gray-500 mt-2">
            User will be prompted to change password on first login.
        </p>
    </div>


    <!-- Divider -->
    <hr class="border-gray-200">


    <!-- Account Status -->
    <div class="flex items-center justify-between">

        <div>
            <h3 class="text-base font-semibold text-gray-800">
                Account Status
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Enable or disable school access immediately
            </p>
        </div>

        <!-- Toggle Switch -->
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" name="account_status" value="active" class="sr-only peer" checked>

            <div class="w-12 h-6 bg-gray-300 rounded-full peer
                        peer-checked:bg-green-500
                        after:content-[''] after:absolute after:top-1 after:left-1
                        after:bg-white after:border after:rounded-full
                        after:h-4 after:w-4 after:transition-all
                        peer-checked:after:translate-x-6">
            </div>
        </label>

    </div>

</div>

<div class="space-y-8">

    <!-- Full Address -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Full Address
        </label>

        <textarea
            name="full_address"
            rows="4"
            class="w-full px-4 py-4 rounded-xl border border-gray-300 bg-gray-50
                   text-sm placeholder-gray-400
                   focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white"
            placeholder="Enter complete postal address...">{{ $editschl->full_address ?? '' }}</textarea>
    </div>


    <!-- Row 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Official Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Official Email <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </span>

                <input
                    type="email"
                    name="official_email"
                    placeholder="school@brschools.in" value="{{ old('official_email',$editschl->official_email ?? '') }}"
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                           text-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
            </div>
        </div>


        <!-- School Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                School Phone
            </label>

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-solid fa-phone text-sm"></i>
                </span>

                <input
                    type="text"
                    name="school_phone" value="{{ old('school_phone',$editschl->school_phone ?? '') }}"
                    placeholder="Landline or Mobile"
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                           text-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
            </div>
        </div>

    </div>


    <!-- Row 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Principal Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Principal Name <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-regular fa-user text-sm"></i>
                </span>

                <input
                    type="text"
                    name="principle_name" value="{{ old('principle_name',$editschl->principle_name ?? '') }}"
                    placeholder="e.g. Dr. Rajesh Kumar"
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                           text-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
            </div>
        </div>


        <!-- Principal Contact -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Principal Contact <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-solid fa-phone text-sm"></i>
                </span>

                <input
                    type="text"
                    name="principle_contact" value="{{ old('principle_contact',$editschl->principle_contact ?? '') }}"
                    placeholder="+91 98765 43210"
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                           text-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
            </div>
        </div>

    </div>

</div>

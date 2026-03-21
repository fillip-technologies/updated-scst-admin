<div class="flex items-center justify-between px-6 py-6">

    <!-- LEFT SECTION -->
    <div class="flex items-start gap-4">

        <!-- Icon Box -->
        <div class="w-12 h-12 rounded-xl flex items-center justify-center
            @if($color=='orange') bg-orange-100 text-orange-600
            @elseif($color=='blue') bg-blue-100 text-blue-600
            @elseif($color=='green') bg-green-100 text-green-600
            @else bg-indigo-100 text-indigo-600 @endif">

            <!-- Document Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7 3h7l5 5v13H7z" />
            </svg>
        </div>

        <!-- Content -->
        <div>

            <div class="flex items-center gap-3 mb-1">
                <span class="text-xs font-semibold tracking-wide text-gray-500">
                    {{ $category }}
                </span>

                @if($priority == 'High')
                <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                    High Priority
                </span>
                @elseif($priority == 'Medium')
                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-full">
                    Medium Priority
                </span>
                @else
                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">
                    Low Priority
                </span>
                @endif
            </div>

            <h3 class="text-lg font-semibold text-gray-800">
                {{ $title }}
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                {{ $school }}
            </p>

            <div class="flex items-center gap-4 text-xs text-gray-400 mt-2">

                <!-- Calendar Icon -->
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14V7H5z" />
                    </svg>
                    <span>{{ $date }}</span>
                </div>

                @if($amount)
                <div>
                    Amount: <span class="font-medium text-gray-600">{{ $amount }}</span>
                </div>
                @endif

            </div>

        </div>
    </div>

    <!-- RIGHT SECTION -->
    <div class="flex items-center gap-3">

        <!-- Approve Button -->
        <button class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
            Approve
        </button>

        <!-- Reject Button -->
        <button class="flex items-center gap-2 border border-red-400 text-red-500 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
            Reject
        </button>

        <!-- View Icon -->
        <button class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
            </svg>
        </button>

    </div>

</div>
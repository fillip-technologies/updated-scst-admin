<header class="h-[88px] bg-white border-b border-gray-200 shadow-sm flex items-center justify-between px-10">

    @if (Auth::user()->role === 'admin')
        <h1 class="text-xl font-semibold text-gray-800">
            Department of SC & ST Welfare
        </h1>
    @elseif(Auth::user()->role === 'school_admin')
        <h1 class="text-xl font-semibold text-gray-800">
            {{ Auth::user()->school->school_name }}
        </h1>
    @endif

    <div class="flex items-center gap-8">

        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M15 17h5l-1.405-1.405C18.79 14.79 18 13.42 18 12V8a6 6 0 10-12 0v4c0 1.42-.79 2.79-1.595 3.595L3 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>

            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5">
                1
            </span>
        </div>

        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-sm font-semibold text-gray-700">

                {{ Auth::user()->role === 'school_admin'
                    ? strtoupper(substr(Auth::user()->school->principle_name, 0, 2))
                    : 'AD' }}

            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">
                   {{ Auth::user()->role === 'school_admin'
                    ? Auth::user()->school->principle_name
                    : 'Director' }}
                </p>
                <p class="text-xs text-gray-500">
                    SC & ST Dept
                </p>
            </div>
        </div>

    </div>

</header>

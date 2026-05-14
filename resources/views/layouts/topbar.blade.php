<header class="min-h-[72px] bg-white border-b border-gray-200 shadow-sm flex items-center justify-between gap-4 px-4 sm:px-6 lg:h-[88px] lg:px-10">

    <div class="flex min-w-0 items-center gap-3">
        <button type="button"
            class="inline-flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-lg border border-gray-200 text-gray-700 transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-600 lg:hidden"
            x-on:click="sidebarOpen = true" aria-label="Open sidebar menu" x-bind:aria-expanded="sidebarOpen.toString()">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        @if (Auth::user()->role === 'admin')
            <h1 class="truncate text-base font-semibold text-gray-800 sm:text-xl">
                Department of SC & ST Welfare
            </h1>
        @elseif(Auth::user()->role === 'school_admin')
            <h1 class="truncate text-base font-semibold text-gray-800 sm:text-xl">
                {{ Auth::user()->school->school_name }}
            </h1>
        @else
            <h1 class="truncate text-base font-semibold text-gray-800 sm:text-xl">
                {{ Auth::user()->name }}
            </h1>
        @endif
    </div>

    <div class="flex flex-shrink-0 items-center gap-3 sm:gap-8">

        {{-- <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M15 17h5l-1.405-1.405C18.79 14.79 18 13.42 18 12V8a6 6 0 10-12 0v4c0 1.42-.79 2.79-1.595 3.595L3 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>

            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5">
                1
            </span>
        </div> --}}

        <div class="flex items-center gap-3">
            @php
                $user = Auth::user();
$profile_route =null;
                if ($user->role === 'school_admin' && $user->school) {
                    $name = $user->school->principle_name;
                    $profile_route = route('school.profile');
                } elseif ($user->role === 'staff') {
                    $name = $user->name; // ya staff_name field agar alag hai
                } elseif ($user->role === 'admin') {
                    $name = $user->name;
                    $profile_route = route('admin.profile');
                } else {
                    $name = 'NA';
                }

                $initials = strtoupper(substr($name, 0, 2));
                $route = $profile_route;
            @endphp

            <div
                class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-sm font-semibold text-gray-700">
                <a href="{{ $route }}">{{ $initials }}</a>
            </div>
            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-gray-800">
                    {{ Auth::user()->role === 'school_admin' ? Auth::user()->school->principle_name : Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-500">
                    SC & ST Dept
                </p>
            </div>
        </div>

    </div>

</header>

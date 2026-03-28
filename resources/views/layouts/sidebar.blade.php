<aside class="w-[280px] bg-primary-900 text-gray-300 flex flex-col h-full">

    @if(Auth::user()->role === 'admin')
    <!-- Header -->
    <div class="h-[88px] px-6 flex items-center border-b border-primary-800 flex-shrink-0">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-md overflow-hidden bg-black flex items-center justify-center">
                <img src="{{ asset('images/bihar-sarka.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h2 class="text-white text-xl font-semibold">
                    SC & ST Welfare
                </h2>
                <p class="text-xs text-gray-400 mt-1">
                    2026
                </p>
            </div>
        </div>
    </div>


    <!-- Scrollable Menu -->
    <div class="flex-1 overflow-y-auto py-6 px-3">

        <!-- Active -->
        <a href="{{ route('admin.dashboard') }}"
            class="relative flex items-center gap-4 px-6 py-3 rounded-xl transition
   {{ request()->routeIs('dashboard')
        ? 'bg-primary-800 text-white font-medium'
        : 'text-gray-300 hover:bg-primary-800' }}">

            @if(request()->routeIs('dashboard'))
            <span class="absolute left-0 top-0 h-full w-[4px] bg-accent-500 rounded-r"></span>
            @endif

            <!-- Dashboard Icon -->
            <svg class="w-5 h-5
        {{ request()->routeIs('dashboard') ? 'text-accent-500' : 'text-gray-400' }}"
                fill="none" stroke="currentColor"
                stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 13h8V3H3v10zm10 8h8V3h-8v18z" />
            </svg>

            Dashboard Overview
        </a>

        <div class="mt-2 space-y-1">

            <!-- School Monitoring -->
            <a href="{{ route('school.monitoring') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12h18M3 6h18M3 18h12" />
                </svg>
                School Monitoring
            </a>

            <!-- School Management -->
            <a href="{{ route('admin.school.management') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16v12H4z" />
                </svg>
                Manage School
            </a>

            <!-- Reports -->
            <a href="{{ route('report') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 2h9l5 5v15H6z" />
                </svg>
                Reports
            </a>

            <!-- Rankings -->
            <a href="{{ route('rankings') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 21l4-7 4 7M12 14V3" />
                </svg>
                Rankings
            </a>

            <!-- Performance -->
            <a href="{{ route('performance.analytics') }}"
                class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">

                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 13h18M3 6h18M3 20h18" />
                </svg>

                Performance Analytics
            </a>





            <!-- Approvals -->
            <a href="{{ route('approvals') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>
                Approvals
            </a>

            <!-- Notifications -->
            <a href="{{ route('notifications') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 8a6 6 0 10-12 0c0 7-3 7-3 7h18s-3 0-3-7" />
                </svg>
                Notifications
            </a>

            <!-- User & Role -->
            <a href="{{ route('user.management.users') }}"
                class="flex items-center gap-4 px-6 py-3 rounded-xl transition
            {{ request()->routeIs('user.management.*') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

                <svg class="w-5 h-5 {{ request()->routeIs('user.management.*') ? 'text-accent-500' : 'text-gray-400' }}"
                    fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 14a4 4 0 10-8 0M12 14v7" />
                </svg>

                User & Role Management
            </a>

            <!-- Audit Logs -->
            <a href="{{ route('audit.logs') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6M9 16h6M9 8h6" />
                </svg>
                Audit Logs
            </a>

            <!-- Settings -->
            <a href="{{ route('system.settings') }}" class="flex items-center gap-4 px-6 py-3 rounded-xl hover:bg-primary-800 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                Settings
            </a>

        </div>
    </div>
    <div class="border-t border-primary-800 p-4 flex-shrink-0">
        <a href="{{ route('admin.logout') }}" class="w-full flex items-center gap-4 px-6 py-3 rounded-xl text-red-400 hover:bg-primary-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>
            Sign Out
        </a>
    </div>
    @else

    {{-- SCHOOL PANENL --}}

    <div class="mt-6 mb-3 px-6 text-xs text-gray-400 uppercase tracking-wider">
        School Panel
    </div>

    <div class="space-y-1">

        <!-- School Dashboard -->
        <a href="{{ route('school.dashboard') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
    {{ request()->routeIs('school.dashboard') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-house {{ request()->routeIs('school.dashboard') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            School Dashboard
        </a>

        <!-- Student Attendance -->
        <a href="{{ route('school.attendance') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->routeIs('school.attendance') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-user-check {{ request()->routeIs('school.attendance') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            Student Attendance
        </a>

        <a href="{{ route('school.student') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->is('school-management') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-school {{ request()->is('school-management') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            Students Management
        </a>

        <!-- Academic Activities -->
        <a href="{{ route('school.academics') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->routeIs('school.academics') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-book {{ request()->routeIs('school.academics') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            Academic Activities
        </a>

        <!-- Meal Reporting -->
        <a href="{{ route('school.meal') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->routeIs('school.meal') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-utensils {{ request()->routeIs('school.meal') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            Meal Reporting
        </a>

        <a href="{{ route('school.infra.info') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->routeIs('school.infra.*') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-building {{ request()->routeIs('school.infra.*') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            Infra Info
        </a>

        <!-- School Reports -->
        <a href="{{ route('school.reports') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->routeIs('school.reports') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-file-lines {{ request()->routeIs('school.reports') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            School Reports
        </a>

        <a href="{{ route('school.website-cms') }}"
            class="flex items-center gap-4 px-6 py-3 rounded-xl transition
        {{ request()->routeIs('school.website-cms') || request()->is('school/website-cms*') ? 'bg-primary-800 text-white' : 'hover:bg-primary-800 text-gray-300' }}">

            <i class="fa-solid fa-globe {{ request()->routeIs('school.website-cms') || request()->is('school/website-cms*') ? 'text-accent-500' : 'text-gray-400' }}"></i>
            Website CMS
        </a>

    </div>



    <!-- Bottom -->
    <div class="border-t border-primary-800 p-4 flex-shrink-0">
        <a href="{{ route('school.logout') }}" class="w-full flex items-center gap-4 px-6 py-3 rounded-xl text-red-400 hover:bg-primary-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>
            Sign Out
        </a>
    </div>

    @endif

</aside>

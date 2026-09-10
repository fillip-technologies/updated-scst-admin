<header class="h-[88px] bg-white border-b border-gray-200 shadow-sm flex items-center justify-between px-10">

    @if (Auth::user()->role === 'admin')
        <h1 class="text-xl font-semibold text-gray-800">
            Department of SC & ST Welfare
        </h1>
    @elseif(Auth::user()->role === 'school_admin')
        <h1 class="text-xl font-semibold text-gray-800">
            {{ Auth::user()->school->school_name }}
        </h1>
    @else
        <h1 class="text-xl font-semibold text-gray-800">
            {{ Auth::user()->name }}
        </h1>
    @endif

    <div class="flex items-center gap-8">



        <div class="flex items-center gap-3">
            @php
                $user = Auth::user();
                $profile_route = null;
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
            <div>
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


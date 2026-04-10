<div class="bg-white rounded-2xl border border-gray-200 shadow-[0_2px_8px_rgba(0,0,0,0.05)] p-5 mb-8">

    <div class="flex items-center justify-between gap-6 flex-wrap">
        <form action="{{ route('search.school') }}" method="get">
            <div class="relative w-[360px]">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>

                <input type="text" placeholder="Search by name, code or principal..." name="search"
                    value="{{ request('search') }}" id="search"
                    class="w-full pl-11 pr-4 py-3 rounded-xl
                   border border-gray-300 bg-gray-50
                   text-sm text-gray-700 placeholder-gray-400
                   focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white transition">
            </div>
        </form>
        <!-- LEFT SIDE (Search) -->



        <!-- RIGHT SIDE (Filters) -->

        <div class="flex items-center gap-4">

            <form action="{{ route('search.school') }}" method="get">
                <select onchange="submit()" name="search" value="{{ request('search') }}"
                    class="px-4 py-2.5 rounded border border-gray-300 bg-gray-50 w-80
                       text-sm text-gray-700
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white transition">
                    <option>All Districts</option>
                    @foreach (getDisc() as $d)
                        <option value="{{ $d->district }}">{{ $d->district }}</option>
                    @endforeach
                </select>
            </form>


            {{-- <select
                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-gray-50
                       text-sm text-gray-700
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white transition">
                <option>All Status</option>
            </select> --}}

            {{-- <select
                class="px-4 py-2.5 rounded-xl border border-gray-300 bg-gray-50
                       text-sm text-gray-700
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white transition">
                <option>All Categories</option>
            </select> --}}

            <a href="{{ url('/admin/school-management') }}" class="text-sm font-medium text-white transition bg-blue-500 p-3 rounded-xl te ">
                Reset
            </a>

        </div>

    </div>

</div>

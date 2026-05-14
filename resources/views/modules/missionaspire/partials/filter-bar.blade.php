<section
    class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-900 to-cyan-700 p-4 sm:p-6 text-white shadow-xl">

    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
            <p class="text-xs sm:text-sm font-semibold uppercase tracking-[0.25em] text-cyan-100">
                Mission Aspire
            </p>

            <h1 class="mt-3 text-2xl font-semibold tracking-tight sm:text-3xl md:text-4xl">
                Mission Aspire Reporting Dashboard
            </h1>

            <p class="mt-3 max-w-2xl text-sm text-slate-200 md:text-base">
                Filter district, school, and mission pillar to review finance
                and implementation status in one workspace.
            </p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3 w-full lg:w-auto">

            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">
                    Districts
                </p>

                <p class="mt-2 text-xl sm:text-2xl font-semibold">
                    {{ getDisc()->count() }}
                </p>
            </div>

            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">
                    Schools
                </p>

                <p class="mt-2 text-xl sm:text-2xl font-semibold">
                    {{ App\Models\School::count() }}
                </p>
            </div>

            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">
                    Mission Areas
                </p>

                <p class="mt-2 text-xl sm:text-2xl font-semibold">
                    {{ count(mission_aspire()) }}
                </p>
            </div>
        </div>
    </div>
</section>


<section class="mt-6 rounded-3xl border border-slate-200 bg-white p-4 sm:p-6 shadow-lg shadow-slate-200/60">

    <div class="border-b border-slate-200 pb-4">
        <h2 class="text-lg font-semibold text-slate-900">
            Filters
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            Choose the reporting scope before loading Mission Aspire data.
        </p>
    </div>

    <form action="{{ route('search.mission.aspire') }}" method="GET"
        class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4" data-mission-form>

        {{-- District --}}
        @php
            $selectedDistrict = request('district', $filters['district'] ?? '');
        @endphp
        <div class="relative w-full" x-data="{ open: false, districtValue: @js($selectedDistrict), districtLabel: @js($selectedDistrict ?: 'Select District') }"
            x-on:click.outside="open = false">
            <label for="district" class="mb-1 block text-sm text-gray-500">
                Select District
            </label>

            <select id="district" name="district" class="hidden" x-ref="districtSelect" x-model="districtValue"
                x-init="$watch('districtValue', value => {
                    $refs.districtSelect.value = value;
                    $refs.districtSelect.dispatchEvent(new Event('change', { bubbles: true }));
                })">
                <option value="">Select District</option>

                @foreach (getDisc() as $district)
                    <option value="{{ $district->district }}" @selected($selectedDistrict === $district->district)>
                        {{ $district->district }}
                    </option>
                @endforeach
            </select>

            <button type="button"
                class="flex h-11 w-full items-center justify-between rounded-lg border border-gray-300 bg-white px-3 py-2 text-left text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                x-on:click="open = !open" x-bind:aria-expanded="open.toString()" aria-haspopup="listbox">
                <span class="truncate" x-text="districtLabel"></span>
                <i class="fa-solid fa-chevron-down ml-3 text-xs text-slate-500 transition"
                    x-bind:class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-cloak x-show="open" x-transition
                class="absolute left-0 right-0 top-full z-30 mt-2 max-h-64 overflow-y-auto rounded-lg border border-slate-200 bg-white py-1 shadow-xl shadow-slate-200/70"
                role="listbox">
                <button type="button"
                    class="block w-full px-4 py-2.5 text-left text-sm text-slate-700 transition hover:bg-blue-50 hover:text-blue-700"
                    x-on:click="districtValue = ''; districtLabel = 'Select District'; open = false">
                    Select District
                </button>

                @foreach (getDisc() as $district)
                    <button type="button"
                        class="block w-full px-4 py-2.5 text-left text-sm text-slate-700 transition hover:bg-blue-50 hover:text-blue-700"
                        x-on:click="districtValue = @js($district->district); districtLabel = @js($district->district); open = false"
                        role="option">
                        {{ $district->district }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Mission Aspire --}}
        <div class="w-full">
            <label for="mission_aspire" class="mb-1 block text-sm text-gray-500">
                Mission Aspire
            </label>

            <select id="mission_aspire" name="mission_aspire"
                class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <option value="">Select Mission Aspire</option>

                @foreach (mission_aspire() as $key => $mission)
                    <option value="{{ $key }}" @selected((string) ($filters['mission_aspire'] ?? '') === (string) $key)>
                        {{ $mission }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- School --}}
        <div id="schooldata" class="w-full"></div>

        {{-- Buttons --}}
        <div class="mt-6 flex flex-col sm:flex-row gap-3 w-full md:col-span-2 xl:col-span-1">

            <button type="submit"
                class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition duration-200 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">

                Load Report
            </button>

            <a href="{{ route('admin.mission.aspire') }}"
                class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-md transition duration-200 hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2">

                Refresh
            </a>
        </div>
    </form>
</section>

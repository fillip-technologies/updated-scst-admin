<section
    class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-900 to-cyan-700 p-6 text-white shadow-xl">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-100">Mission Aspire</p>
            <h1 class="mt-3 text-3xl font-semibold tracking-tight md:text-4xl">Mission Aspire reporting dashboard</h1>
            <p class="mt-3 max-w-2xl text-sm text-slate-200 md:text-base">
                Filter district, school, and mission pillar to review finance and implementation status in one workspace.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">Districts</p>
                <p class="mt-2 text-2xl font-semibold">{{ $districts->count() }}</p>
            </div>
            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">Schools</p>
                <p class="mt-2 text-2xl font-semibold">{{ $schools->count() }}</p>
            </div>
            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">Mission Areas</p>
                <p class="mt-2 text-2xl font-semibold">{{ count($missionOptions) }}</p>
            </div>
        </div>
    </div>
</section>

<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-200/60">
    <div class="border-b border-slate-200 pb-4">
        <h2 class="text-lg font-semibold text-slate-900">Filters</h2>
        <p class="mt-1 text-sm text-slate-500">Choose the reporting scope before loading Mission Aspire data.</p>
    </div>

    <form class="mt-6 grid grid-cols-1 items-end gap-4 md:grid-cols-2 lg:grid-cols-4"
        action="{{ route('admin.mission.aspire.report') }}" method="GET" data-mission-form>
        <div class="relative">
            <label for="district" class="mb-1 block text-sm text-gray-500">Select District</label>
            <input type="hidden" id="district" name="district" placeholder="Select District"
                value="{{ $filters['district'] ?? '' }}">
            <button type="button" id="district_button"
                class="flex h-11 w-full items-center justify-between rounded-lg border border-gray-300 bg-white px-3 py-2 text-left text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                aria-haspopup="listbox" aria-expanded="false">
                <span data-district-label>{{ $filters['district'] ?? 'Select District' }}</span>
                <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </button>
            <div id="district_menu"
                class="absolute left-0 right-0 top-full z-30 mt-2 hidden max-h-60 overflow-y-auto rounded-lg border border-slate-200 bg-white py-1 text-sm shadow-xl"
                role="listbox">
                <button type="button"
                    class="block w-full px-3 py-2 text-left text-slate-700 transition hover:bg-slate-100"
                    data-district-option="">
                    Select District
                </button>
                @foreach ($districts as $district)
                    <button type="button"
                        class="block w-full px-3 py-2 text-left text-slate-700 transition hover:bg-slate-100"
                        data-district-option="{{ $district }}">
                        {{ $district }}
                    </button>
                @endforeach
            </div>
        </div>

        <div>
            <label for="school" class="mb-1 block text-sm text-gray-500">Select School</label>
            <select id="school" name="school" placeholder="Select School"
                class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Select School</option>
                @if (! empty($filters['district']))
                    @foreach ($schools->where('district', $filters['district']) as $school)
                        <option value="{{ $school->id }}" @selected((string) ($filters['school'] ?? '') === (string) $school->id)>
                            {{ $school->school_name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div>
            <label for="mission_aspire" class="mb-1 block text-sm text-gray-500">Mission Aspire</label>
            <select id="mission_aspire" name="mission_aspire" placeholder="Select Mission Aspire"
                class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Select Mission Aspire</option>
                @foreach ($missionOptions as $key => $mission)
                    <option value="{{ $key }}" @selected((string) ($filters['mission_aspire'] ?? '') === (string) $key)>
                        {{ $mission }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-3">
            <button type="submit"
                class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Load Report
            </button>
            <a href="{{ route('admin.mission.aspire') }}"
                class="inline-flex h-11 items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Refresh
            </a>
        </div>
    </form>
</section>

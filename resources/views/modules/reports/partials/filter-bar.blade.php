@php
$districtOptions = collect($schools)->pluck('district')->filter()->unique()->sort()->values();
@endphp

<section class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-900 to-cyan-700 p-6 text-white shadow-xl">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-100">District Monitoring Reports</p>
            <h1 class="mt-3 text-3xl font-semibold tracking-tight md:text-4xl">Unified reporting dashboard for Admin review</h1>
            <p class="mt-3 max-w-2xl text-sm text-slate-200 md:text-base">
                Filter by district and school, choose a report, and review monitoring data in a single responsive workspace.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">Coverage</p>
                <p class="mt-2 text-2xl font-semibold">18 Districts</p>
            </div>
            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">Schools</p>
                <p class="mt-2 text-2xl font-semibold">420 Active</p>
            </div>
            <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-cyan-100">Report Modes</p>
                <p class="mt-2 text-2xl font-semibold">11 Modules</p>
            </div>
        </div>
    </div>
</section>

<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-2 border-b border-slate-100 pb-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-900">Filters</h2>
            <p class="text-sm text-slate-500">Choose the reporting scope before loading district monitoring data.</p>
        </div>
        <div class="rounded-full bg-sky-50 px-4 py-2 text-xs font-medium text-sky-700">
            
        </div>
    </div>

    <form class="mt-6 grid grid-cols-1 gap-4 xl:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_auto]" @submit.prevent="fetchReportData">
        <div>
            <label for="district" class="mb-2 block text-sm font-medium text-slate-700">Select District</label>
            <select
                id="district"
                name="district"
                x-model="filters.district"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                <option value="">Select District</option>
                @foreach ($districtOptions as $district)
                <option value="{{ \Illuminate\Support\Str::of($district)->lower()->replace(' ', '-') }}">{{ $district }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="school_id" class="mb-2 block text-sm font-medium text-slate-700">Select School</label>
            <select
                id="school_id"
                name="school_id"
                x-model="filters.school_id"
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">
                <option value="">Select School</option>
                @foreach ($schools as $school)
                <option value="{{ $school['id'] }}">{{ $school['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end">
            <button
                type="submit"
                class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200 xl:w-auto">
                Load Report
            </button>
        </div>

        <input type="hidden" name="report_type" :value="selectedReport">
    </form>
</section>
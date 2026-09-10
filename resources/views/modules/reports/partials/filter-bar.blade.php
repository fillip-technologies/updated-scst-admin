@php
    $districtOptions = collect($schools)->pluck('district')->filter()->unique()->sort()->values();
@endphp

<section
    class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-900 to-cyan-700 p-6 text-white shadow-xl">

    <!-- Background Decoration -->
    <div class="absolute -top-20 -right-20 h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
    <div class="absolute -bottom-16 -left-16 h-60 w-60 rounded-full bg-blue-500/20 blur-3xl"></div>

    <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

        <!-- Left Content -->
        <div class="max-w-3xl">
            <span
                class="inline-flex items-center rounded-full border border-cyan-300/30 bg-cyan-400/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-cyan-100 backdrop-blur">
                📊 District Monitoring System
            </span>

            <h1 class="mt-5 text-4xl font-bold leading-tight text-white md:text-5xl">
                Monitoring Reports
            </h1>

            <p class="mt-5 max-w-2xl text-base leading-7 text-slate-200">
                View district-wise and school-wise monitoring reports in one place.
                Easily filter records, analyze attendance, meals, inspections,
                and generate actionable insights through a responsive dashboard.
            </p>


        </div>

        <!-- Right Stats -->
        <div class="grid grid-cols-2 gap-5 lg:w-[420px]">

            <div
                class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-xl transition hover:-translate-y-1 hover:bg-white/15">
                <div class="text-3xl">🏛️</div>
                <p class="mt-3 text-sm text-cyan-100">Districts</p>
                <h2 class="mt-1 text-3xl font-bold text-white">
                    {{ getDisc()->count() }}
                </h2>
            </div>

            <div
                class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-xl transition hover:-translate-y-1 hover:bg-white/15">
                <div class="text-3xl">🏫</div>
                <p class="mt-3 text-sm text-cyan-100">Schools</p>
                <h2 class="mt-1 text-3xl font-bold text-white">
                    {{ App\Models\School::count() }}
                </h2>
            </div>

        </div>

    </div>

</section>

<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-200/60">
    <div class="border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Filters</h2>
            <p class="mt-1 text-sm text-slate-500">Choose the reporting scope before loading district monitoring data.
            </p>
        </div>
    </div>
    @php
        $filterRoute = null;
        if (Auth::user()->role == 'dwo') {
            $filterRoute = route('dwo.show.all.report');
        } elseif (Auth::user()->role == 'admin') {
            $filterRoute = route('show.all.report');
        }
    @endphp
    <form action="{{ $filterRoute }}" method="GET" class="mt-6 bg-white p-6 rounded-xl shadow-md border">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            <!-- District -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Select District
                </label>
                <select id="district" name="district"
                    class="w-full h-11 rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select District</option>
                    @foreach (getDisc() as $dist)
                        <option value="{{ $dist->district }}" @selected(request('district') == $dist->district)>
                            {{ $dist->district }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- School -->
            <div id="allschool">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Select School
                </label>
                <select id="school_id" name="school_id"
                    class="w-full h-11 rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select School</option>
                </select>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Report Category
                </label>
                <select id="report_category" name="report_category" onchange="reportCategory(this.value)"
                    class="w-full h-11 rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Category</option>
                    <option value="academic" {{ request('report_category') == 'academin' ? 'selected' : '' }}>Academic
                    </option>
                    <option value="infrastructure"
                        {{ request('report_category') == 'infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                </select>
            </div>

            <!-- Report -->
            <div id="reporthidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Select Report
                </label>
                <select id="report_type" name="report_type"
                    class="w-full h-11 rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Report</option>
                </select>
            </div>

            <!-- From Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    From Date
                </label>
                <input type="date" name="from_date" value="{{ request('from_date') }}"
                    class="w-full h-11 rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- To Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    To Date
                </label>
                <input type="date" name="to_date" value="{{ request('to_date') }}"
                    class="w-full h-11 rounded-lg border border-gray-300 px-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

        </div>

        <!-- Buttons -->
        <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">

            <button type="submit"
                class="px-6 h-11 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                🔍 Load Report
            </button>

            <a href="{{ route('dwo.report') }}"
                class="px-6 h-11 rounded-lg bg-gray-600 text-white font-medium hover:bg-gray-700 transition flex items-center justify-center">
                ↻ Refresh
            </a>

        </div>

    </form>
</section>
<script>
    function reportCategory(value) {
        let reportType = document.querySelector('#report_type');
        let reportHidden = document.querySelector('#reporthidden');

        if (value === 'academic') {
            reportType.innerHTML = `
                <option selected>Select Report</option>
                @foreach (academicType() as $academic)
                    <option value="{{ $academic }}">{{ $academic }}</option>
                @endforeach
            `;

            reportHidden.classList.remove('hidden');


        } else {
            reportType.innerHTML = `<option selected>Select Report</option>`;
            reportHidden.classList.add('hidden');

        }
    }
    @php
        $getschool = url('admin/get/school');
        if (Auth::user()->role == 'dwo') {
            $getschool = url('dwo/get/school');
        }
    @endphp
    $(document).ready(function() {
        var url = @json($getschool);
        $("#district").on("change", function() {
            let value = $(this).val();
            console.log(value);
            $.ajax({
                url: url +"/"+ value,
                type: "GET",
                success: function(res) {
                    console.log(res); // Check response every time

                    let options = `<option value="">Select School</option>`;

                    $.each(res.data, function(key, school) {
                        options +=
                            `<option value="${school.id}">${school.school_name}</option>`;
                    });

                    $("#allschool").html(`
                <label class="mb-1 block text-sm text-gray-500">
                    Select School
                </label>

                <select id="school_id" name="school_id"
                    class="h-11 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    ${options}
                </select>
            `);
                }
            });
        });
    });
</script>

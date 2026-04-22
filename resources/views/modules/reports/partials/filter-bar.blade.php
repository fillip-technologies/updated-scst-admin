@php
    $districtOptions = collect($schools)->pluck('district')->filter()->unique()->sort()->values();
@endphp

<section
    class="overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-sky-900 to-cyan-700 p-6 text-white shadow-xl">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-100">District Monitoring Reports</p>
            <h1 class="mt-3 text-3xl font-semibold tracking-tight md:text-4xl">Unified reporting dashboard for Admin
                review</h1>
            <p class="mt-3 max-w-2xl text-sm text-slate-200 md:text-base">
                Filter by district and school, choose a report, and review monitoring data in a single responsive
                workspace.
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

<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-200/60">
    <div class="border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Filters</h2>
            <p class="mt-1 text-sm text-slate-500">Choose the reporting scope before loading district monitoring data.
            </p>
        </div>
    </div>

    <form class="mt-6 grid grid-cols-1 items-end gap-4 md:grid-cols-2 lg:grid-cols-5"
        action="{{ route('show.all.report') }}" method="GET">

        <div>
            <label for="district" class="mb-1 block text-sm text-gray-500">Select District</label>
            <select id="district" name="district" x-model="filters.district"
                class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Select District</option>
                @foreach (getDisc() as $dist)
                    <option value="{{ $dist->district }}">{{ $dist->district }}</option>
                @endforeach
            </select>
        </div>

         <div id="allschool">

        </div>

        <div>
            <label for="report_category" class="mb-1 block text-sm text-gray-500">Report Category</label>
            <select id="report_category" name="report_category" onchange="reportCategory(this.value)"
                class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Select Category</option>
                <option value="academic">Academic</option>
                <option value="infrastructure">Infrastructure</option>
            </select>
        </div>

        <div id="reporthidden">
            <label for="report_type" class="mb-1 block text-sm text-gray-500">Report</label>
            <select id="report_type" name="report_type"
                class="h-11 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option selected>Select Report</option>
            </select>
        </div>

        <div class="flex items-end">
            <button type="submit"
                class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Load Report
            </button>
            <a href="{{ route('report') }}"
                class="inline-flex h-11 ms-3  items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Refresh
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

    $(document).ready(function() {
        var allschool = $("#allschool").hide();

        $("#district").on('change', function() {
            var value = $(this).val();

            $.ajax({
                url: "/get/school/" + value,
                type: "GET",
                success: function(res) {

                    var datas = res.data;
                    var options = `<option value="">Select School</option>`;

                    // loop through data
                    $.each(datas, function(key, school) {
                        options +=
                            `<option value="${school.id}">${school.school_name}</option>`;
                    });

                    var html = `
                <label class="mb-1 block text-sm text-gray-500">Select School</label>
                <select id="school_id" name="school_id"
                    class="h-11 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    ${options}
                </select>
                `;

                    $("#allschool").html(html).show();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

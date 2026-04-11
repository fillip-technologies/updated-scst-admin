{{-- @php
    $districtOptions = collect($schools)->pluck('district')->filter()->unique()->sort()->values();
@endphp --}}

<div class="grid gap-3 md:grid-cols-4 xl:grid-cols-5">
    <select name="district" class="rounded-md border border-gray-300 px-3 py-2 text-sm" data-filter-district>
        <option value="">Select district</option>
        @foreach (getDisc() as $dis)
            <option value="{{ $dis->district }}" @selected(request('district') === $dis->district)>{{ $dis->district }}</option>
        @endforeach
    </select>

    <input
        type="number"
        name="dropout_filter"
        value="{{ request('dropout_filter') }}"
        placeholder="Dropout greater than"
        class="rounded-md border border-gray-300 px-3 py-2 text-sm"
        data-filter-dropout>

    <input
        type="number"
        step="0.1"
        name="performance_filter"
        value="{{ request('performance_filter') }}"
        placeholder="Performance below %"
        class="rounded-md border border-gray-300 px-3 py-2 text-sm"
        data-filter-performance>

    <select name="status_filter" class="rounded-md border border-gray-300 px-3 py-2 text-sm" data-filter-status>
        <option value="">Select reporting status</option>
        <option value="on_time" @selected(request('status_filter') === 'on_time')>On Time</option>
        <option value="delayed" @selected(request('status_filter') === 'delayed')>Delayed</option>
        <option value="not_reported" @selected(request('status_filter') === 'not_reported')>Not Reported</option>
    </select>

    <button type="submit" class="rounded-md border border-gray-300 px-4 py-2 text-sm">
        Submit
    </button>
</div>

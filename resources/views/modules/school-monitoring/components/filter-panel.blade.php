<div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 items-end">

    <!-- District -->
    <div class="flex flex-col">
        <label class="text-xs text-gray-500 mb-1">District</label>
        <select name="district" class="rounded-md border border-gray-300 px-3 py-2 text-sm w-full">
            <option value="">Select district</option>
            @foreach (getDisc() as $dis)
                <option value="{{ $dis->district }}" @selected(request('district') === $dis->district)>
                    {{ $dis->district }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- From Date -->


    <!-- Dropout -->
    <div class="flex flex-col">
        <label class="text-xs text-gray-500 mb-1">Dropout % ≥</label>
        <input
            type="number"
            name="dropout_filter"
            value="{{ request('dropout_filter') }}"
            placeholder="e.g. 10"
            class="rounded-md border border-gray-300 px-3 py-2 text-sm w-full"
        >
    </div>

    <!-- Pass Percentage -->
    <div class="flex flex-col">
        <label class="text-xs text-gray-500 mb-1">Pass % ≥</label>
        <input
            type="number"
            step="0.1"
            name="pass_percentage"
            value="{{ request('pass_percentage') }}"
            placeholder="e.g. 75"
            class="rounded-md border border-gray-300 px-3 py-2 text-sm w-full"
        >
    </div>
 <div class="flex flex-col">
        <label class="text-xs text-gray-500 mb-1">From Date</label>
        <input
            type="date"
            name="from_date"
            value="{{ request('from_date') }}"
            class="rounded-md border border-gray-300 px-3 py-2 text-sm w-full"
        >
    </div>

    <!-- To Date -->
    <div class="flex flex-col">
        <label class="text-xs text-gray-500 mb-1">To Date</label>
        <input
            type="date"
            name="to_date"
            value="{{ request('to_date') }}"
            class="rounded-md border border-gray-300 px-3 py-2 text-sm w-full"
        >
    </div>
    <!-- Buttons -->
    <div class="flex gap-2">
        <button
            type="submit"
            class="w-full rounded-md bg-blue-600 text-white px-4 py-2 text-sm font-medium hover:bg-blue-700 transition"
        >
            Apply
        </button>

        <a href="{{ url('admin/school-monitoring') }}"
           class="w-full text-center rounded-md bg-gray-500 text-white px-4 py-2 text-sm font-medium hover:bg-gray-600 transition">
            Reset
        </a>
    </div>

</div>

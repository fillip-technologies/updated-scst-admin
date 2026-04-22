@php
$getdata = json_decode($data->state_section) ?? [];
@endphp

<div class="rounded-2xl border border-primary-800/10 bg-white shadow-sm">
    <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
        <h2 class="text-xl font-semibold text-gray-800">Stats Section Form</h2>
        <p class="mt-2 text-sm text-gray-500">
            Manage the counter values and labels displayed on the department website.
        </p>
    </div>

  <form class="p-6 sm:p-8" action="{{ route('add.states') }}" method="POST">
    @csrf
<input type="hidden" name="id" value="{{ !empty($getdata)  ? $data->id : 1 }}">
    <div class="grid grid-cols-1 gap-6">

        <div class="rounded-2xl border border-orange-200 bg-orange-50/60 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-orange-700">Stat 1</p>
            <div class="mt-4 grid grid-cols-1 gap-4">
                <div>
                    <label for="schools_count" class="mb-2 block text-sm font-medium text-gray-700">Schools Count</label>
                    <input id="schools_count" type="text" name="schools_count"
                        placeholder="Enter number of schools"
                        value="{{ old('schools_count', $getdata->schools_count ?? '') }}"
                        class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    @error('schools_count')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="schools_label" class="mb-2 block text-sm font-medium text-gray-700">Schools Label</label>
                    <input id="schools_label" type="text" name="schools_label"
                        placeholder="Enter label"
                        value="{{ old('schools_label', $getdata->schools_label ?? '') }}"
                        class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    @error('schools_label')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-sky-200 bg-sky-50/60 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sky-700">Stat 2</p>
            <div class="mt-4 grid grid-cols-1 gap-4">
                <div>
                    <label for="students_count" class="mb-2 block text-sm font-medium text-gray-700">Students Count</label>
                    <input id="students_count" type="text" name="students_count"
                        placeholder="Enter number of students"
                        value="{{ old('students_count', $getdata->students_count ?? '') }}"
                        class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    @error('students_count')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="students_label" class="mb-2 block text-sm font-medium text-gray-700">Students Label</label>
                    <input id="students_label" type="text" name="students_label"
                        placeholder="Enter label"
                        value="{{ old('students_label', $getdata->students_label ?? '') }}"
                        class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    @error('students_label')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-emerald-200 bg-emerald-50/60 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">Stat 3</p>
            <div class="mt-4 grid grid-cols-1 gap-4">
                <div>
                    <label for="teachers_count" class="mb-2 block text-sm font-medium text-gray-700">Teachers Count</label>
                    <input id="teachers_count" type="text" name="teachers_count"
                        placeholder="Enter number of teachers"
                        value="{{ old('teachers_count', $getdata->teachers_count ?? '') }}"
                        class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    @error('teachers_count')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="teachers_label" class="mb-2 block text-sm font-medium text-gray-700">Teachers Label</label>
                    <input id="teachers_label" type="text" name="teachers_label"
                        placeholder="Enter label"
                        value="{{ old('teachers_label', $getdata->teachers_label ?? '') }}"
                        class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    @error('teachers_label')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end border-t border-primary-800/10 pt-2">
            <button type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                Save
            </button>
        </div>

    </div>
</form>
</div>

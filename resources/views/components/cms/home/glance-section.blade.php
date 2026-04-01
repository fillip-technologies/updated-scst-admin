<div x-data="{
    form: {
        title: 'School At A Glance',
        subtitle: 'Key academic and institutional statistics that highlight the school’s scale and performance.',
        stat1Value: '650',
        stat1Label: 'Total Students',
        stat2Value: '45',
        stat2Label: 'Faculty Members',
        stat3Value: '12',
        stat3Label: 'Classes (6–12)',
        stat4Value: '95%',
        stat4Label: 'Board Pass Rate',
    }
}" class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">School At A Glance</h2>
            <p class="mt-2 text-sm text-gray-500">
                Manage the fixed four statistics shown in the homepage overview section.
            </p>
        </div>

        <form class="p-6 sm:p-8" action="{{ !empty($glance) ? route('glance.update') : route('glance.save') }}" method="POST">
            @csrf
            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="glance_title" class="mb-2 block text-sm font-medium text-gray-700">Section Title</label>
                    <input type="text" name="glance_title"
                        value="{{ old('glance_title', $glance->glance_title ?? '') }}"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="glance_subtitle" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Subtitle</label>
                    <textarea rows="4" name="glance_subtitle"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('glance_title', $glance->glance_subtitle ?? '') }}</textarea>
                </div>

                <div class="md:col-span-2 rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500">Statistics Blocks</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Statistic 1</p>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="stat_1_value"
                                        class="mb-2 block text-sm font-medium text-gray-700">Value</label>
                                    <input type="text" value="{{ old('stat_1_value', $glance->stat_1_value ?? '') }}"
                                        name="stat_1_value"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                                <div>
                                    <label for="stat_1_label"
                                        class="mb-2 block text-sm font-medium text-gray-700">Label</label>
                                    <input type="text" name="stat_1_label"
                                        value="{{ old('stat_1_label', $glance->stat_1_label ?? '') }}"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Statistic 2</p>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="stat_2_value"
                                        class="mb-2 block text-sm font-medium text-gray-700">Value</label>
                                    <input value="{{ old('stat_2_value', $glance->stat_2_value ?? '') }}" type="text"
                                        name="stat_2_value"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                                <div>
                                    <label for="stat_2_label"
                                        class="mb-2 block text-sm font-medium text-gray-700">Label</label>
                                    <input type="text" name="stat_2_label"
                                        value="{{ old('stat_2_value', $glance->stat_2_label ?? '') }}"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Statistic 3</p>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="stat_3_value"
                                        class="mb-2 block text-sm font-medium text-gray-700">Value</label>
                                    <input type="text" name="stat_3_value"
                                        value="{{ old('stat_3_value', $glance->stat_3_value ?? '') }}"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                                <div>
                                    <label for="stat_3_label"
                                        class="mb-2 block text-sm font-medium text-gray-700">Label</label>
                                    <input type="text" name="stat_3_label"
                                        value="{{ old('stat_3_label', $glance->stat_3_label ?? '') }}"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Statistic 4</p>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="stat_4_value"
                                        class="mb-2 block text-sm font-medium text-gray-700">Value</label>
                                    <input type="text" name="stat_4_value"  value="{{ old('stat_4_value', $glance->stat_4_value ?? '') }}"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                                <div>
                                    <label for="stat_4_label"
                                        class="mb-2 block text-sm font-medium text-gray-700">Label</label>
                                    <input type="text" name="stat_4_label"  value="{{ old('stat_4_label', $glance->stat_4_label ?? '') }}"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end border-t border-primary-800/10 pt-6">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    {{ !empty($glance) ? "Update" : "Save" }}

                </button>
            </div>
        </form>
    </div>

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Homepage statistics section appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Glance</span>
        </div>

        <div class="mt-6 rounded-3xl border border-primary-800/10 bg-gray-50 p-5">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary-700">{{ $glance->glance_title ?? '' }}
            </p>
            <p class="mt-3 text-sm leading-6 text-gray-500">{{ $glance->glance_subtitle ?? '' }}</p>

            <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="rounded-2xl bg-primary-900 p-4 text-white shadow-sm">
                    <p class="text-3xl font-semibold">{{ $glance->stat_1_value ?? "" }}</p>
                    <p class="mt-2 text-sm text-gray-100">{{ $glance->stat_1_label ?? "" }}</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-primary-800/10">
                    <p class="text-3xl font-semibold text-gray-800">{{ $glance->stat_2_value ?? ""}}</p>
                    <p class="mt-2 text-sm text-gray-500">{{ $glance->stat_2_label ?? "" }}</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-primary-800/10">
                    <p class="text-3xl font-semibold text-gray-800">{{ $glance->stat_3_value ?? "" }}</p>
                    <p class="mt-2 text-sm text-gray-500">{{ $glance->stat_3_label ?? "" }}</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-primary-800/10">
                    <p class="text-3xl font-semibold text-gray-800">{{ $glance->stat_4_value ?? "" }}</p>
                    <p class="mt-2 text-sm text-gray-500">{{ $glance->stat_4_label ?? "" }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

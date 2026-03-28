<div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
    <div class="border-b border-slate-100 pb-4">
        <h2 class="text-xl font-semibold text-slate-900">Report Library</h2>
        <p class="mt-1 text-sm text-slate-500">Switch categories and select one monitoring report to inspect.</p>
    </div>

    <div class="mt-5 flex rounded-2xl bg-slate-100 p-1">
        @foreach ($reportGroups as $groupKey => $group)
            <button
                type="button"
                @click="activeGroup = '{{ $groupKey }}'"
                :class="activeGroup === '{{ $groupKey }}' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500'"
                class="flex-1 rounded-2xl px-4 py-2.5 text-sm font-semibold transition">
                {{ $group['label'] }}
            </button>
        @endforeach
    </div>

    @foreach ($reportGroups as $groupKey => $group)
        <div x-show="activeGroup === '{{ $groupKey }}'" x-cloak class="mt-5 space-y-4">
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $group['label'] }}</h3>
                <p class="mt-1 text-sm text-slate-500">{{ $group['description'] }}</p>
            </div>

            <div class="space-y-3">
                @foreach ($group['reports'] as $report)
                    <button
                        type="button"
                        @click="selectReport('{{ $report['key'] }}', '{{ $report['label'] }}')"
                        :class="selectedReport === '{{ $report['key'] }}'
                            ? 'border-sky-500 bg-sky-50 text-sky-900 shadow-sm ring-2 ring-sky-100'
                            : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50'"
                        class="flex w-full items-center gap-3 rounded-2xl border px-4 py-3 text-left transition">
                        <span
                            :class="selectedReport === '{{ $report['key'] }}' ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-500'"
                            class="flex h-10 w-10 items-center justify-center rounded-xl transition">
                            <i class="fa-solid {{ $report['icon'] }}"></i>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-sm font-semibold">{{ $report['label'] }}</span>
                            <span class="mt-0.5 block text-xs text-slate-500">Click to prepare this report</span>
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

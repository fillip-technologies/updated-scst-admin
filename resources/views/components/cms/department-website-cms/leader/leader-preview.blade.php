<div class="rounded-2xl border border-primary-800/10 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Preview</h2>
            <p class="mt-1 text-sm text-gray-500">Homepage leader message card preview.</p>
        </div>
        <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Live UI</span>
    </div>

    <div class="mt-6 rounded-2xl bg-gradient-to-br from-primary-900 via-primary-800 to-slate-800 p-6 text-white shadow-sm">
        <div class="flex flex-col items-center text-center">
            <img src="{{ $leader['image'] }}"
                alt="Leader profile preview" class="h-24 w-24 rounded-full border-4 border-white/20 object-cover shadow-sm">

            <h3 class="mt-5 text-2xl font-semibold">{{ $leader['name'] }}</h3>
            <p class="mt-2 text-sm font-medium text-primary-100">{{ $leader['designation'] }}</p>

            <p class="mt-5 max-w-md text-sm leading-7 text-primary-50/90">{{ $leader['message'] }}</p>

            <button type="button"
                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-medium text-primary-900 transition hover:bg-primary-50">
                Read Full Message
                <span aria-hidden="true">&rarr;</span>
            </button>
        </div>
    </div>
</div>

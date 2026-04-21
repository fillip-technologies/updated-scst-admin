@props([
    'title' => 'Scheme Title',
    'description' => 'Scheme description will appear here.',
    'tags' => [],
])

<article class="rounded-xl border border-primary-800/10 bg-white p-5 shadow-sm">
    <div class="flex items-start gap-4">
        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-primary-900/10 text-primary-900">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6v12m6-6H6m3-7h6a2 2 0 012 2v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8a2 2 0 012-2z" />
            </svg>
        </div>

        <div class="min-w-0 flex-1">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            <p class="mt-3 text-sm leading-6 text-gray-500">{{ $description }}</p>

            <div class="mt-4 flex flex-wrap gap-2">
                @forelse ($tags as $tag)
                    <span class="inline-flex rounded-full bg-primary-900/8 px-3 py-1 text-xs font-medium text-primary-900">{{ $tag }}</span>
                @empty
                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500">No tags</span>
                @endforelse
            </div>

            <button type="button"
                class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-primary-900 transition hover:text-primary-700">
                View Details
                <span aria-hidden="true">&rarr;</span>
            </button>
        </div>
    </div>
</article>

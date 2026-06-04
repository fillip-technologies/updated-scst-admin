{{-- @props([
    'cards' => [],
]) --}}


<div class="rounded-2xl border border-primary-800/10 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Preview</h2>
            <p class="mt-1 text-sm text-gray-500">Frontend scheme card layout preview.</p>
        </div>
        <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Schemes</span>
    </div>

    <div id="schemePreviewContainer" class="mt-6 grid grid-cols-1 gap-4">
        @forelse ($datas as $key=> $item)
            <article class="rounded-xl border border-primary-800/10 bg-white p-5 shadow-sm">
                <div class="flex items-start gap-4">
                    <div
                        class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-primary-900/10 text-primary-900">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m6-6H6m3-7h6a2 2 0 012 2v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $item->title }}</h3>
                        <p class="mt-3 text-sm leading-6 text-gray-500">{{ $item->description }}</p>

                        @php
                            $tags = explode(',', $item->tags);
                        @endphp

                        <div class="mt-4 flex flex-wrap gap-2">
                            @forelse ($tags as $tag)
                                <span
                                    class="inline-flex rounded-full bg-primary-900/8 px-3 py-1 text-xs font-medium text-primary-900">tags</span>
                            @empty
                                <span
                                    class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-500">No
                                    tags</span>
                            @endforelse
                        </div>
                        <div class="flex justify-between">

                            <button type="button"
                                class="mt-5 inline-flex items-center gap-2 text-sm font-medium text-primary-900 transition hover:text-primary-700">
                                View Details
                                <span aria-hidden="true">&rarr;</span>
                            </button>
                            <a href="{{ route('edit.schema',$item->id) }}"
                                class="mt-5 inline-flex items-center gap-2 px-2 py-2 text-sm font-medium text-white bg-primary-900 rounded-lg hover:bg-primary-800 transition">
                                Edit
                            </a>
                        </div>

                    </div>
                </div>
            </article>
        @empty
        @endforelse

    </div>
    <div class="mt-4 p-3">
        {{ $datas->links() }}
    </div>
</div>

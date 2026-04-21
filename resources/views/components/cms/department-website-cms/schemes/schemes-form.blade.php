@props([
    'cards' => [],
    'buttonText' => null,
    'createRoute' => null,
])

<div class="rounded-2xl border border-primary-800/10 bg-white shadow-sm">
    <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Schemes Form</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Manage multiple department scheme cards and keep the preview in sync as you edit.
                </p>
            </div>

            <a href="{{ $createRoute ?? route('admin.department.cms.schemes.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                + Add Scheme
            </a>
        </div>
    </div>

    <form class="p-6 sm:p-8">
        <div class="space-y-5">
            @foreach ($cards as $index => $card)
                <div class="rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                    <div class="border-b border-primary-800/10 pb-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-primary-700">Scheme Card</p>
                            <p class="mt-1 text-sm font-medium text-gray-800">Card {{ $index + 1 }}</p>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-1 gap-5">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="scheme_title_{{ $index }}">Title</label>
                            <input type="text" name="title[]" placeholder="Enter scheme title"
                                id="scheme_title_{{ $index }}" value="{{ $card['title'] ?? '' }}"
                                class="scheme-title w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="scheme_description_{{ $index }}">Description</label>
                            <textarea name="description[]" rows="4" placeholder="Enter scheme description"
                                id="scheme_description_{{ $index }}"
                                class="scheme-description w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ $card['description'] ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700" for="scheme_tags_{{ $index }}">Tags</label>
                            <input type="text" name="tags[]" placeholder="Enter tags (comma separated)"
                                id="scheme_tags_{{ $index }}" value="{{ $card['tags'] ?? '' }}"
                                class="scheme-tags w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($buttonText)
            <div class="mt-5 flex justify-end border-t border-primary-800/10 pt-5">
                <button type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                    {{ $buttonText }}
                </button>
            </div>
        @endif
    </form>
</div>

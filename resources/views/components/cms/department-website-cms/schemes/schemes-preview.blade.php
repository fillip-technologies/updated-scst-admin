@props([
    'cards' => [],
])

<div class="rounded-2xl border border-primary-800/10 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Preview</h2>
            <p class="mt-1 text-sm text-gray-500">Frontend scheme card layout preview.</p>
        </div>
        <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Schemes</span>
    </div>

    <div id="schemePreviewContainer" class="mt-6 grid grid-cols-1 gap-4">
        @foreach ($cards as $card)
            <x-cms.department-website-cms.schemes.scheme-card
                :title="$card['title'] ?? 'Scheme Title'"
                :description="$card['description'] ?? 'Scheme description will appear here.'"
                :tags="collect(explode(',', $card['tags'] ?? ''))->map(fn ($tag) => trim($tag))->filter()->values()->all()" />
        @endforeach
    </div>
</div>

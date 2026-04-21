@php
    $tabs = [
        'minister' => 'Minister',
        'secretary' => 'Secretary',
        'ias' => 'IAS Officer',
    ];
    $activeType = $type ?? 'minister';
    $tabsRoute = $routeName ?? 'admin.department.cms.leader';
@endphp

<div class="rounded-2xl border border-primary-800/10 bg-white p-3 shadow-sm">
    <div class="flex flex-wrap gap-3">
        @foreach ($tabs as $key => $tab)
            <a href="{{ route($tabsRoute, ['type' => $key]) }}"
                class="{{ $activeType === $key
                    ? 'bg-primary-900 text-white shadow-sm'
                    : 'bg-gray-100 text-gray-600 hover:bg-primary-900/10 hover:text-primary-900' }} rounded-full px-5 py-2.5 text-sm font-medium transition">
                {{ $tab }}
            </a>
        @endforeach
    </div>
</div>

<section class="space-y-6">
    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
        <x-cms.department-website-cms.stats.stats-form :data="$states"/>
        <x-cms.department-website-cms.stats.stats-preview :data="$states"/>
    </div>
</section>

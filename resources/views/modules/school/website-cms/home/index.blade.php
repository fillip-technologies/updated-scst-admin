@extends('layouts.app')

@section('content')

@php
    $homeSections = [
        [
            'key' => 'hero',
            'title' => 'Hero',
            'description' => 'Manage the homepage hero banner, school summary details and top-fold preview.',
            'route' => route('school.website-cms.home.hero'),
            'icon' => 'fa-solid fa-images',
        ],
        [
            'key' => 'gallery',
            'title' => 'Gallery',
            'description' => 'Edit the fixed homepage gallery cards and their supporting text.',
            'route' => route('school.website-cms.home.gallery'),
            'icon' => 'fa-solid fa-camera-retro',
        ],
        [
            'key' => 'about',
            'title' => 'About',
            'description' => 'Update the homepage about section content and related preview.',
            'route' => route('school.website-cms.home.about'),
            'icon' => 'fa-solid fa-circle-info',
        ],
        [
            'key' => 'glance',
            'title' => 'School At A Glance',
            'description' => 'Manage the key school statistics highlighted on the homepage.',
            'route' => route('school.website-cms.home.glance'),
            'icon' => 'fa-solid fa-chart-column',
        ],
        [
            'key' => 'infrastructure',
            'title' => 'Infrastructure',
            'description' => 'Control the homepage infrastructure content block and visual presentation.',
            'route' => route('school.website-cms.home.infrastructure'),
            'icon' => 'fa-solid fa-building',
        ],
        [
            'key' => 'activities',
            'title' => 'Activities',
            'description' => 'Maintain activities cards, labels and related homepage content.',
            'route' => route('school.website-cms.home.activities'),
            'icon' => 'fa-solid fa-person-running',
        ],
        [
            'key' => 'quiz',
            'title' => 'Quiz',
            'description' => 'Manage the homepage quiz section and its editable entries.',
            'route' => route('school.website-cms.home.quiz'),
            'icon' => 'fa-solid fa-puzzle-piece',
        ],
        [
            'key' => 'alumni',
            'title' => 'Alumni',
            'description' => 'Add, edit and organize alumni cards shown on the homepage.',
            'route' => route('school.website-cms.home.alumni'),
            'icon' => 'fa-solid fa-user-graduate',
        ],
        [
            'key' => 'faq',
            'title' => 'FAQ',
            'description' => 'Update frequently asked questions and answers for the homepage.',
            'route' => route('school.website-cms.home.faq'),
            'icon' => 'fa-solid fa-comments',
        ],
    ];
@endphp

<div
    x-data="{
        activeTab: 'hero',
        sections: @js($homeSections),
        get activeSection() {
            return this.sections.find((section) => section.key === this.activeTab) ?? this.sections[0];
        }
    }"
    class="min-h-screen bg-gray-100 p-8">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Website CMS</p>
                <h1 class="mt-2 text-3xl font-semibold text-gray-800">Home Page Management</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Switch between homepage sections inside a single editor panel. Existing section forms and save flows remain unchanged.
                </p>
            </div>

            <div class="rounded-2xl border border-primary-800/10 bg-white px-5 py-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Active Section</p>
                <p class="mt-2 text-lg font-semibold text-primary-900" x-text="activeSection.title"></p>
                <p class="mt-1 text-xs text-gray-500" x-text="`${sections.length} total sections`"></p>
            </div>
        </div>

        <div class="rounded-3xl border border-primary-800/10 bg-white p-4 shadow-sm sm:p-5">
            <div class="-mx-1 overflow-x-auto pb-1">
                <div class="flex min-w-max items-center gap-3 px-1">
                    @foreach ($homeSections as $section)
                        <button
                            type="button"
                            @click="activeTab = '{{ $section['key'] }}'"
                            :class="activeTab === '{{ $section['key'] }}'
                                ? 'bg-primary-900 text-white shadow-sm'
                                : 'border-primary-800/15 bg-white text-gray-600 hover:border-primary-700 hover:bg-primary-900/5 hover:text-primary-900'"
                            class="inline-flex items-center gap-2 rounded-2xl border px-4 py-3 text-sm font-medium whitespace-nowrap transition">
                            <i class="{{ $section['icon'] }} text-xs"></i>
                            <span>{{ $section['title'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="mt-4 rounded-2xl bg-gray-50 px-4 py-3">
                <p class="text-sm leading-6 text-gray-500" x-text="activeSection.description"></p>
            </div>
        </div>

        <div class="mt-8 space-y-8">
            <div x-show="activeTab === 'hero'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.hero-section />
            </div>

            <div x-show="activeTab === 'gallery'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.gallery-section />
            </div>

            <div x-show="activeTab === 'about'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.about-section />
            </div>

            <div x-show="activeTab === 'glance'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.glance-section />
            </div>

            <div x-show="activeTab === 'infrastructure'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.infrastructure-section />
            </div>

            <div x-show="activeTab === 'activities'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.activities-section />
            </div>

            <div x-show="activeTab === 'quiz'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.quiz-section />
            </div>

            <div x-show="activeTab === 'alumni'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.alumni-section />
            </div>

            <div x-show="activeTab === 'faq'" x-transition.opacity.duration.200ms style="display: none;">
                <x-cms.home.faq-section />
            </div>
        </div>
    </div>
</div>
@endsection

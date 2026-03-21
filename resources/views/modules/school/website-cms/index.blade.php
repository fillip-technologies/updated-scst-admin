@extends('layouts.app')

@section('content')
@php
    $cmsPages = [
        [
            'title' => 'Home',
            'description' => 'Manage homepage hero section and general highlights.',
            'url' => url('/school/website-cms/home'),
            'icon' => 'fa-solid fa-house',
        ],
        [
            'title' => 'Infrastructure',
            'description' => 'Manage infrastructure blocks like classrooms, labs, hostel and campus facilities.',
            'url' => url('/school/website-cms/infrastructure'),
            'icon' => 'fa-solid fa-building',
        ],
        [
            'title' => 'Staff',
            'description' => 'Manage staff listing, leadership profiles and team information shown on the homepage.',
            'url' => url('/school/website-cms/staff'),
            'icon' => 'fa-solid fa-users',
        ],
        [
            'title' => 'Notices',
            'description' => 'Manage notice board announcements and important updates featured on the homepage.',
            'url' => url('/school/website-cms/notices'),
            'icon' => 'fa-solid fa-bullhorn',
        ],
        [
            'title' => 'Performance',
            'description' => 'Manage performance statistics, achievements and academic highlights.',
            'url' => url('/school/website-cms/performance'),
            'icon' => 'fa-solid fa-chart-line',
            'cardClass' => 'xl:col-start-2',
        ],
    ];
@endphp

<div class="min-h-screen bg-gray-100 p-8">
    <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">School Panel</p>
            <h1 class="mt-2 text-2xl font-semibold text-gray-800">Website CMS Dashboard</h1>
            <p class="mt-2 max-w-2xl text-sm text-gray-500">
                Manage the core sections of the school homepage from one CMS dashboard.
            </p>
        </div>

        <div class="rounded-2xl border border-primary-800/10 bg-white px-5 py-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Available Sections</p>
            <p class="mt-2 text-3xl font-semibold text-primary-900">{{ count($cmsPages) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($cmsPages as $page)
            <div class="{{ $page['cardClass'] ?? '' }} group flex h-full flex-col rounded-2xl border border-primary-800/10 bg-white p-6 shadow-sm transition duration-300 hover:scale-105 hover:shadow-xl">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-900 text-xl text-white shadow-sm">
                    <i class="{{ $page['icon'] }}"></i>
                </div>

                <div class="mt-6 flex-1">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $page['title'] }}</h2>
                    <p class="mt-3 text-sm leading-6 text-gray-500">{{ $page['description'] }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ $page['url'] }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-primary-800">
                        Manage
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

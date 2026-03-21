@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Website CMS</p>
                <h1 class="mt-2 text-3xl font-semibold text-gray-800">Homepage Hero Section</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Manage the hero banner content, media and summary details shown at the top of the homepage.
                </p>
            </div>

            <div class="rounded-2xl border border-primary-800/10 bg-white px-5 py-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Route</p>
                <p class="mt-2 text-sm font-medium text-primary-900">/school/website-cms/home/hero</p>
            </div>
        </div>

        <x-cms.home.hero-section />
    </div>
</div>
@endsection

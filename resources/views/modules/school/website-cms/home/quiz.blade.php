@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Website CMS</p>
                <h1 class="mt-2 text-3xl font-semibold text-gray-800">Homepage Quiz Section</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Manage the homepage quiz content from this dedicated section page.
                </p>
            </div>

            <a href="{{ route('school.website-cms.home') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-primary-800/20 bg-white px-5 py-3 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Home CMS
            </a>
        </div>

        <x-cms.home.quiz-section />
    </div>
</div>
@endsection

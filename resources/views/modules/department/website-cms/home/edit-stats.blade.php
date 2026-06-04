@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Department CMS</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-800">Edit Stats Section</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                        Review and safely update the department counter values from this dedicated edit screen.
                    </p>
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.department.cms.stats') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-gray-600">
                    Back
                </a>
            </div>

            <x-cms.department-website-cms.stats.stats-section button-text="Update" />
        </div>
    </div>
@endsection

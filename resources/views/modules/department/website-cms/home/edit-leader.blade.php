@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Department CMS</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-800">Edit Leader Message</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                        Review and update the selected leader message safely with a dedicated edit screen.
                    </p>
                </div>

                <div class="rounded-2xl border border-primary-800/10 bg-white px-5 py-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Route</p>
                    <p class="mt-2 text-sm font-medium text-primary-900">/admin/department/website-cms/home/leader/edit</p>
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.department.cms.leader', ['type' => $type ?? 'minister']) }}"
                    class="inline-flex items-center justify-center rounded-lg border border-primary-800/15 bg-white px-4 py-2 text-sm font-medium text-primary-900 shadow-sm transition hover:bg-primary-900/5">
                    Back
                </a>
            </div>

            <x-cms.department-website-cms.leader.leader-section
                :type="$type"
                route-name="admin.department.cms.leader.edit"
                button-text="Update" />
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Department CMS</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-800">Leader Message Module</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                        Manage leader profile details and homepage message content for Minister, Secretary, and IAS Officer sections.
                    </p>
                </div>

                <!-- <div class="rounded-2xl border border-primary-800/10 bg-white px-5 py-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Route</p>
                    <p class="mt-2 text-sm font-medium text-primary-900">/admin/department/website-cms/home/leader</p>
                </div> -->
            </div>

            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.department.cms.leader.edit', ['type' => $type ?? 'minister']) }}"
                    class="inline-flex items-center justify-center rounded-lg bg-yellow-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-yellow-400">
                    Edit
                </a>
            </div>

            <x-cms.department-website-cms.leader.leader-section :type="$type" />
        </div>
    </div>
@endsection

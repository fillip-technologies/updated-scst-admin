@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Department CMS</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-800">Schemes / Initiatives Module</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                        Build and preview multiple scheme cards for department initiatives with flexible titles, descriptions, and tags.
                    </p>
                </div>
            </div>

            {{-- <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.department.cms.schemes.edit') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-yellow-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-yellow-400">
                    Edit
                </a>
            </div> --}}

            <x-cms.department-website-cms.schemes.schemes-section :datas="$schemas" :editdata="$editdata"/>
        </div>
    </div>
@endsection

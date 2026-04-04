@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Website CMS</p>
                <h1 class="mt-2 text-3xl font-semibold text-gray-800">Notices Management</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Manage public website announcements through a simple notices management system.
                </p>
            </div>
        </div>

        {{-- @php
            dd($notice['notice_manage']);
        @endphp --}}
        <x-cms.notices.latest-announcements-section :notice="$notice" />
    </div>
</div>
@endsection

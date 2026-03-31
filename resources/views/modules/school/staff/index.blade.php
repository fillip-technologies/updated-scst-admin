@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8" x-data="{
    activeTab: 'leadership',
    currentSectionLabel() {
        const labels = {
            leadership: 'Leadership Section',
            teaching_staff: 'Teaching Staff Section',
        };
        return labels[this.activeTab] || 'Leadership Section';
    }
}">
    @php
        $tabs = [
            ['id' => 'leadership', 'label' => 'Leadership'],
            ['id' => 'teaching_staff', 'label' => 'Teaching Staff'],
        ];
    @endphp

    @php
        $leasder = json_decode($staffdata->leadership);
        $teachers = json_decode($staffdata->teacher_staff);
       
    @endphp

    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Website CMS</p>
                <h1 class="mt-2 text-3xl font-semibold text-gray-800">Staff Page Management</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Manage the staff page sections through the same CMS workflow used across the website pages.
                </p>
            </div>

            <div class="rounded-2xl border border-primary-800/10 bg-white px-5 py-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500">Current Section</p>
                <p class="mt-2 text-sm font-medium text-primary-900" x-text="currentSectionLabel()"></p>
            </div>
        </div>

        <div class="mb-8 rounded-3xl border border-primary-800/10 bg-white p-3 shadow-sm">
            <div class="flex gap-3 overflow-x-auto">
                @foreach ($tabs as $tab)
                    <button type="button"
                        @click="activeTab = '{{ $tab['id'] }}'"
                        :class="activeTab === '{{ $tab['id'] }}'
                            ? 'bg-primary-900 text-white shadow-sm'
                            : 'bg-transparent text-gray-600 hover:bg-primary-900/5 hover:text-primary-900'"
                        class="whitespace-nowrap rounded-2xl px-4 py-3 text-sm font-medium transition duration-200">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <div x-show="activeTab === 'leadership'" x-transition.opacity.duration.200ms>
            <x-cms.staff.leadership-section :leaders="$leasder" />
        </div>

        <div x-show="activeTab === 'teaching_staff'" x-transition.opacity.duration.200ms>
            <x-cms.staff.teaching-staff-section />
        </div>
    </div>
</div>
@endsection

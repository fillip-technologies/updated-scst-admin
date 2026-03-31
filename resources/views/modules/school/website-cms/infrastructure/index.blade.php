@extends('layouts.app')

@section('content')

@php

    $herosection = json_decode($infradatas->hero);
      $compussection = json_decode(stripslashes($infradatas->compus_overview));
    $academicsection = json_decode($infradatas->academic_infrastructure);
  

@endphp
<div class="min-h-screen bg-gray-100 p-8" x-data="{
    activeTab: 'hero',
    currentSectionLabel() {
        const labels = {
            hero: 'Hero Section',
            campus_overview: 'Campus Overview Section',
            academic_infrastructure: 'Academic Infrastructure Section',
        };
        return labels[this.activeTab] || 'Hero Section';
    }
}">
    @php
        $tabs = [
            ['id' => 'hero', 'label' => 'Hero'],
            ['id' => 'campus_overview', 'label' => 'Campus Overview'],
            ['id' => 'academic_infrastructure', 'label' => 'Academic Infrastructure'],
        ];
    @endphp

    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Website CMS</p>
                <h1 class="mt-2 text-3xl font-semibold text-gray-800">Infrastructure Page Management</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                    Manage the infrastructure page section by section using the same CMS workflow as the homepage.
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

        <div x-show="activeTab === 'hero'" x-transition.opacity.duration.200ms>
            <x-cms.infrastructure.hero-section :heros="$herosection" />
        </div>

        <div x-show="activeTab === 'campus_overview'" x-transition.opacity.duration.200ms>
            <x-cms.infrastructure.campus-overview-section :compusdata="$compussection" />
        </div>

        <div x-show="activeTab === 'academic_infrastructure'" x-transition.opacity.duration.200ms>
            <x-cms.infrastructure.academic-infrastructure-section />
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@php
    $mode = 'edit';
@endphp

@section('content')
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let errorMessages = `
                    <ul style="text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">• {{ $error }}</li>
                        @endforeach
                    </ul>
                `;

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessages,
                    confirmButtonColor: '#d33'
                });
            });
        </script>
    @endif
    <div x-data="{ step: 1 }" class="max-w-6xl mx-auto">

        <!-- header of edit section -->
        <div class="mb-6 flex items-center gap-3">
            <a href="/school-management">
                <i class="fa-solid fa-arrow-left text-gray-500 cursor-pointer"></i>
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Edit School
                </h1>
                <p class="text-sm text-gray-500">
                    Update school information and settings
                </p>
            </div>
        </div>

        <!--  FORM START -->
        <form method="POST" action="{{ route('update.school', encrypt($editschl->id)) }}" enctype="multipart/form-data">
            @csrf
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                <!-- tabs of edit section -->
                <div class="bg-gray-50 px-8 pt-6 rounded-t-2xl">
                    <div class="flex items-center gap-12 border-b border-gray-200 text-sm font-medium">

                        <button type="button" @click="step=1" class="pb-4 flex items-center gap-2"
                            :class="step === 1 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">
                            <i class="fa-regular fa-building"></i>
                            Basic Information
                        </button>

                        <button type="button" @click="step=2" class="pb-4 flex items-center gap-2"
                            :class="step === 2 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">
                            <i class="fa-solid fa-phone"></i>
                            Contact Details
                        </button>

                        <button type="button" @click="step=3" class="pb-4 flex items-center gap-2"
                            :class="step === 3 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">
                            <i class="fa-regular fa-file-lines"></i>
                            Infrastructure
                        </button>

                        <button type="button" @click="step=4" class="pb-4 flex items-center gap-2"
                            :class="step === 4 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">
                            <i class="fa-solid fa-gear"></i>
                            Settings & Access
                        </button>

                    </div>
                </div>

                <!-- Tab Content -->
                <div class="px-8 py-8 bg-white">

                    <div x-show="step===1">
                        @include('modules.school-management.tabs.basic-info')
                    </div>

                    <div x-show="step===2">
                        @include('modules.school-management.tabs.contact-details')
                    </div>

                    <div x-show="step===3">
                        @include('modules.school-management.tabs.infrastructure')
                    </div>

                    <div x-show="step===4">
                        @include('modules.school-management.tabs.settings-access')
                    </div>

                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between px-8 py-6 border-t border-gray-200 bg-gray-50">

                    <button type="button" @click="if(step>1) step--"
                        class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 bg-white">
                        Back
                    </button>

                    <div class="flex items-center gap-6">

                        <button type="button" class="text-gray-600">
                            Cancel
                        </button>

                        <button type="submit"
                            class="bg-primary-700 hover:bg-primary-800 text-white px-6 py-2.5 rounded-xl shadow-sm flex items-center gap-2">

                            <i class="fa-solid fa-floppy-disk"></i>
                            Update School

                        </button>

                    </div>

                </div>

            </div>

        </form>
        <!--FORM END -->

    </div>
@endsection

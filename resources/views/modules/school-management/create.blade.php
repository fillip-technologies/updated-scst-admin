@extends('layouts.app')

@section('content')
 
    {{-- Success Alert --}}

    {{-- Validation Errors --}}
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
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

    @php $mode = 'create'; @endphp

    <div x-data="{ step: 1 }" class="max-w-6xl mx-auto">

        <!-- Header -->
        <div class="mb-6 flex items-center gap-3">
            <i class="fa-solid fa-arrow-left text-gray-500 cursor-pointer"></i>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Add New School
                </h1>
                <p class="text-sm text-gray-500">
                    Register a new residential school in the system
                </p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            <!-- Tabs -->
            <div class="bg-gray-50 px-8 pt-6 rounded-t-2xl">
                <div class="flex items-center gap-12 border-b border-gray-200 text-sm font-medium">

                    <!-- Basic -->
                    <button type="button" @click="step=1"
                        class="pb-4 flex items-center gap-2"
                        :class="step === 1 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">

                        <i :class="step === 1 ? 'fa-regular fa-building text-primary-700' : 'fa-regular fa-building text-gray-500'"></i>
                        Basic Information
                    </button>

                    <!-- Contact -->
                    <button type="button" @click="step=2"
                        class="pb-4 flex items-center gap-2"
                        :class="step === 2 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">

                        <i :class="step === 2 ? 'fa-solid fa-phone text-primary-700' : 'fa-solid fa-phone text-gray-500'"></i>
                        Contact Details
                    </button>

                    <!-- Infra -->
                    <button type="button" @click="step=3"
                        class="pb-4 flex items-center gap-2"
                        :class="step === 3 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">

                        <i :class="step === 3 ? 'fa-regular fa-file-lines text-primary-700' : 'fa-regular fa-file-lines text-gray-500'"></i>
                        Infrastructure
                    </button>

                    <!-- Login -->
                    <button type="button" @click="step=4"
                        class="pb-4 flex items-center gap-2"
                        :class="step === 4 ? 'text-primary-700 border-b-2 border-primary-700' : 'text-gray-600'">

                        <i :class="step === 4 ? 'fa-solid fa-lock text-primary-700' : 'fa-solid fa-lock text-gray-500'"></i>
                        Login Setup
                    </button>

                </div>
            </div>

            <form action="{{ route('save.school') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                        @include('modules.school-management.tabs.login-setup')
                    </div>

                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between px-8 py-6 border-t border-gray-200 bg-gray-50">

                    <!-- Back -->
                    <button type="button"
                        @click="if(step>1) step--"
                        class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 bg-white">
                        Back
                    </button>

                    <div class="flex items-center gap-6">

                        <!-- Cancel -->
                        <button type="button" class="text-gray-600">
                            Cancel
                        </button>

                        <!-- Next -->
                        <button x-show="step < 4"
                            type="button"
                            @click="step++"
                            class="bg-primary-700 hover:bg-primary-800 text-white px-6 py-2.5 rounded-xl shadow-sm">
                            Next Step
                        </button>

                        <!-- Submit -->
                        <button x-show="step === 4"
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl shadow-sm flex items-center gap-2">

                            <i class="fa-solid fa-floppy-disk"></i>
                            Create School
                        </button>

                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

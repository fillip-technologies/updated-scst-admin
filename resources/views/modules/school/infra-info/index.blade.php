@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Infrastructure Info</h1>
                <p class="mt-1 text-sm text-gray-500">Add and manage your school infrastructure details in one place.</p>
            </div>

            <a href="{{ route('school.infra.edit') }}"
                class="inline-flex items-center justify-center rounded-lg border border-primary-900 px-5 py-2.5 text-sm font-medium text-primary-900 transition hover:bg-primary-50">
                Edit Info
            </a>
        </div>

        <div class="mx-auto max-w-5xl rounded-2xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="border-b border-gray-100 pb-4">
                <h2 class="text-lg font-semibold text-gray-800">Add Infrastructure Info</h2>
                <p class="mt-1 text-sm text-gray-500">Fill in the core infrastructure details for your school campus.</p>
            </div>

            <form action="{{ route('school.infra.store') }}" method="POST" class="mt-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="school_name" class="mb-2 block text-sm font-medium text-gray-600">School Name</label>
                        <input
                            id="school_name"
                            type="text"
                            name="school_name"
                            placeholder="Enter school name"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                    </div>

                    <div>
                        <label for="toilets" class="mb-2 block text-sm font-medium text-gray-600">Number of Toilets</label>
                        <input
                            id="toilets"
                            type="number"
                            name="toilets"
                            placeholder="Enter number of toilets"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                    </div>

                    <div>
                        <label for="electricity" class="mb-2 block text-sm font-medium text-gray-600">Electricity</label>
                        <select
                            id="electricity"
                            name="electricity"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                            <option value="">Select Electricity Status</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div>
                        <label for="drinking_water" class="mb-2 block text-sm font-medium text-gray-600">Drinking Water</label>
                        <select
                            id="drinking_water"
                            name="drinking_water"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                            <option value="">Select Drinking Water Status</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div>
                        <label for="building_safety" class="mb-2 block text-sm font-medium text-gray-600">Building Safety</label>
                        <select
                            id="building_safety"
                            name="building_safety"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                            <option value="">Select Building Safety Status</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div>
                        <label for="network" class="mb-2 block text-sm font-medium text-gray-600">Network Availability</label>
                        <select
                            id="network"
                            name="network"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-primary-900 focus:ring-2 focus:ring-primary-100">
                            <option value="">Select Network Availability</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-900 px-5 py-3 text-sm font-medium text-white transition hover:bg-primary-800">
                        Submit
                    </button>

                    <a href="{{ route('school.infra.edit') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        Edit Info
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

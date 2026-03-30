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

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: "Validation Error",
                html: `<ul>
        @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
        @endforeach
        </ul>
        `,
                showConfirmButton: true,
            })
        </script>
    @endif

    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Infrastructure Info</h1>
                <p class="mt-1 text-sm text-gray-500">Add and manage your school infrastructure details in one place.</p>
            </div>

            
        </div>

        <div class="mx-auto max-w-5xl rounded-2xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="border-b border-gray-100 pb-4">
                <h2 class="text-lg font-semibold text-gray-800">Add Infrastructure Info</h2>
                <p class="mt-1 text-sm text-gray-500">Fill in the core infrastructure details for your school campus.</p>
            </div>



            <form action="{{ route('infra.store') }}" method="POST" class="mt-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- School Name --}}
                    <div>
                        <input type="text" value="{{ SchoolLogin()->school_name }}" readonly
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700">

                        <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                        <input type="hidden" name="district" value="{{ SchoolLogin()->district }}">
                    </div>

                    {{-- Toilets --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-600">Number of Toilets</label>
                        <input type="number" name="toilets" value="{{ old('toilets') }}"
                            placeholder="Enter number of toilets"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700">
                    </div>

                    {{-- Electricity --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-600">Electricity</label>
                        <select name="electricity"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700">
                            <option value="">Select Electricity Status</option>
                            @foreach (checkCandition() as $check)
                                <option value="{{ $check }}" {{ old('electricity') == $check ? 'selected' : '' }}>
                                    {{ $check }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Drinking Water --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-600">Drinking Water</label>
                        <select name="drinking_water"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700">
                            <option value="">Select Drinking Water Status</option>
                            @foreach (checkCandition() as $check)
                                <option value="{{ $check }}"
                                    {{ old('drinking_water') == $check ? 'selected' : '' }}>
                                    {{ $check }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Building Safety --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-600">Building Safety</label>
                        <select name="building_safety"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700">
                            <option value="">Select Building Safety Status</option>
                            @foreach (checkCandition() as $check)
                                <option value="{{ $check }}"
                                    {{ old('building_safety') == $check ? 'selected' : '' }}>
                                    {{ $check }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Network --}}
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-600">Network Availability</label>
                        <select name="network"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-700">
                            <option value="">Select Network Availability</option>
                            @foreach (checkCandition() as $check)
                                <option value="{{ $check }}" {{ old('network') == $check ? 'selected' : '' }}>
                                    {{ $check }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-900 px-5 py-3 text-sm font-medium text-white hover:bg-primary-800">
                        Submit
                    </button>


                </div>
            </form>
        </div>
    </div>
@endsection

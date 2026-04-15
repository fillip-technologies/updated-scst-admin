@extends('layouts.app')

@section('content')

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                showConfirmButton: true,
                timer: 3000
            })
        </script>
    @endif
    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Top Header Card -->
        <div class=" bg-primary-800 text-white rounded-2xl p-6 shadow-lg">
            <h1 class="text-2xl font-bold">
                {{ $school->school_name ?? 'ABC Public School' }}
            </h1>

            <p class="text-sm opacity-90">
                {{ $school->district ?? 'Patna' }}, Bihar
            </p>

            <div class="mt-4 flex gap-6 text-sm">
                <div>
                    <p class="opacity-80">Students</p>
                    <p class="text-xl font-semibold">
                        {{ $school->student_count ?? 450 }}
                    </p>
                </div>
                <div>
                    <p class="opacity-80">Teachers</p>
                    <p class="text-xl font-semibold">
                        {{ $school->teacher_count ?? 25 }}
                    </p>
                </div>
                <div>
                    <p class="opacity-80">Last Updated</p>
                    <p class="text-xl font-semibold">
                        {{ $school->updated_at ? $school->updated_at->diffForHumans() : '2 days ago' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="bg-white border rounded-xl p-4 shadow-sm text-center">
                <p class="text-sm text-gray-500">Pass %</p>
                <p class="text-2xl font-bold text-green-600">
                    {{ $school->pass_percentage ?? 78 }}%
                </p>
            </div>

            <div class="bg-white border rounded-xl p-4 shadow-sm text-center">
                <p class="text-sm text-gray-500">Attendance</p>
                <p class="text-2xl font-bold text-yellow-500">
                    {{ $school->attendance_rate ?? 82 }}%
                </p>
            </div>

            <div class="bg-white border rounded-xl p-4 shadow-sm text-center">
                <p class="text-sm text-gray-500">Dropouts</p>
                <p class="text-2xl font-bold text-red-500">
                    {{ $school->dropout_count ?? 12 }}
                </p>
            </div>

            <div class="bg-white border rounded-xl p-4 shadow-sm text-center">
                <p class="text-sm text-gray-500">Performance</p>
                <span
                    class="inline-block mt-1 px-3 py-1 text-xs
                {{ ($school->pass_percentage ?? 78) >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                rounded-full">
                    {{ ($school->pass_percentage ?? 78) >= 75 ? 'Good' : 'Needs Improvement' }}
                </span>
            </div>

        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- LEFT SIDE -->
            <div class="lg:col-span-2 space-y-6">

                <!-- School Info -->
                <div class="bg-white border rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">School Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

                        <div>
                            <p class="text-gray-500">School Name</p>
                            <p class="font-medium">
                                {{ $school->school_name ?? 'ABC Public School' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">District</p>
                            <p class="font-medium">
                                {{ $school->district ?? 'Patna' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Total Students</p>
                            <p class="font-medium">
                                {{ $school->student_count ?? 450 }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Total Teachers</p>
                            <p class="font-medium">
                                {{ $school->teacher_count ?? 25 }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Issues -->
                <div class="bg-white border rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">Issues</h2>

                    <ul class="space-y-2 text-sm text-gray-700">

                        {{-- Dynamic Issues ADD किए हैं (old static भी रहेगा) --}}

                        @if (isset($school))
                            @if ($school->attendance_rate < 75)
                                <li class="flex items-center gap-2">
                                    <span class="text-red-500">●</span> Low attendance
                                </li>
                            @endif

                            @if ($school->dropout_rate > 10)
                                <li class="flex items-center gap-2">
                                    <span class="text-red-500">●</span> High dropout rate
                                </li>
                            @endif

                            @if ($school->pass_percentage < 50)
                                <li class="flex items-center gap-2">
                                    <span class="text-yellow-500">●</span> Poor results
                                </li>
                            @endif
                        @endif

                        {{-- OLD STATIC (unchanged) --}}
                        <li class="flex items-center gap-2">
                            <span class="text-red-500">●</span> Low attendance in Class 8
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-yellow-500">●</span> Midday meal delay
                        </li>

                    </ul>
                </div>

                <!-- Resources (UNCHANGED) -->
                <div class="bg-white border rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">Resources</h2>

                    <div class="grid grid-cols-2 gap-4 text-sm">

                        <div class="bg-indigo-50 p-3 rounded-lg">
                            📚 Books
                            <p class="font-medium">Available</p>
                        </div>

                        <div class="bg-pink-50 p-3 rounded-lg">
                            🍱 Meals
                            <p class="font-medium">Average</p>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="space-y-6">

                <!-- Progress -->
                <div class="bg-white border rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">Performance Overview</h2>

                    <div class="space-y-4 text-sm">

                        <div>
                            <div class="flex justify-between">
                                <span>Pass %</span>
                                <span>{{ $school->pass_percentage ?? 78 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                <div class="bg-green-500 h-2 rounded-full"
                                    style="width: {{ $school->pass_percentage ?? 78 }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <span>Attendance</span>
                                <span>{{ $school->attendance_rate ?? 82 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                <div class="bg-yellow-500 h-2 rounded-full"
                                    style="width: {{ $school->attendance_rate ?? 82 }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between">
                                <span>Dropout Rate</span>
                                <span>{{ $school->dropout_rate ?? 5 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                <div class="bg-red-500 h-2 rounded-full" style="width: {{ $school->dropout_rate ?? 5 }}%">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Notice (UNCHANGED) -->
                <div class="bg-white border rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-4">Send Notice</h2>

                    <form class="space-y-3" action="{{ route('send.email') }}" method="POST">
                        @csrf
                        <input type="hidden" name="school" value="{{ $school->school_name ?? "" }}">
                        <input type="hidden" name="principale" value="{{ $school->principle_name ?? "" }}">
                        <textarea name="message"
                            class="w-full border rounded-lg px-3 py-2 text-sm
                        @error('message')
 border-red-500
                        @enderror"
                            rows="4" placeholder="Write notice...">{{ old('message') }}</textarea>


                        <button type="submit"
                            class="w-full bg-blue-800 text-white rounded-lg px-4 py-2 text-sm hover:bg-primary-600">
                            Send Notice
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>

@endsection

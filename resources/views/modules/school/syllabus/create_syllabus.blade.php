@extends('layouts.app')

@section('content')


@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#2563eb',
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif


@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc2626',
        });
    </script>
@endif


@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Validation Error',
            html: `
                <ul style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#f59e0b',
        });
    </script>
@endif
    <div class="bg-gray-100 min-h-screen p-6">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Add Syllabus</h1>
            <p class="text-sm text-gray-500">Add subject and topics easily.</p>
        </div>

        <!-- GRID START -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- LEFT BOX (FORM) -->
            <div class="bg-white p-5 rounded-xl shadow-sm border">

                <form action="{{ route('store.syllabus.topic') }}" method="POST">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id ?? '' }}">

                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Subject Details</h2>

                    <!-- Subject -->
                    <div class="mb-4">
                        <input type="text" name="subject_name" value="{{ old('subject_name') }}"
                            placeholder="Subject Name" class="w-full px-4 py-2 border rounded-lg">

                        @error('subject_name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Topics -->
                    <div id="topics-wrapper" class="space-y-3">

                        @if (old('topics'))
                            @foreach (old('topics') as $topic)
                                <div class="flex gap-2">
                                    <input type="text" name="topics[]" value="{{ $topic }}"
                                        class="w-full px-4 py-2 border rounded-lg">

                                    <button type="button" onclick="removeTopic(this)"
                                        class="px-3 bg-red-500 text-white rounded">X</button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2">
                                <input type="text" name="topics[]" placeholder="Enter Topic"
                                    class="w-full px-4 py-2 border rounded-lg">
                            </div>
                        @endif

                    </div>

                    @error('topics')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                    <!-- Add Topic -->
                    <button type="button" onclick="addTopic()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg">
                        + Add Topic
                    </button>

                    <!-- Submit -->
                    <button type="submit" class="px-6 py-3 mt-4 bg-green-600 text-white rounded-lg w-full">
                        Save Syllabus
                    </button>

                </form>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border">

                <form action="{{ route('store.assing.subject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id ?? '' }}">

                    <h2 class="text-lg font-semibold mb-4 text-gray-700">Assing Syllabus</h2>

                    <!-- 🔽 SELECT SUBJECT -->
                    <div class="mb-4">
                        <select name="sublist_id"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-600">

                            <option value="">-- Select Subject --</option>

                            @foreach ($subject as $sub)
                                <option value="{{ $sub->id }}" {{ old('sublist_id') == $sub->id ? 'selected' : '' }}>
                                    {{ $sub->subject_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('sublist_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <select name="teacher_id"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-600">

                            <option value="">-- Select Teachers --</option>

                            @foreach ($teachers as $tea)
                                <option value="{{ $tea->id }}" {{ old('teacher_id') == $tea->id ? 'selected' : '' }}>
                                    {{ $tea->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('teacher_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <select name="class_id"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-600">

                            <option value="">-- Select Class --</option>

                            @foreach ($classs as $cls)
                                <option value="{{ $cls->id }}" {{ old('class_id') == $cls->id ? 'selected' : '' }}>
                                    {{ $cls->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('class_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    
                     <div class="mb-4">
                        <input name="completion_time" placeholder="Enter Completion Time"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2
                            focus:ring-primary-600">
                        @error('completion_time')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="px-6 py-3 mt-4 bg-green-600 text-white rounded-lg w-full">
                        Assing Syllabus
                    </button>

                </form>

            </div>


        </div>
        <!-- GRID END -->

    </div>

    <!-- JS -->
    <script>
        function addTopic() {
            let wrapper = document.getElementById('topics-wrapper');

            let div = document.createElement('div');
            div.classList.add('flex', 'gap-2');

            div.innerHTML = `
        <input type="text" name="topics[]" placeholder="Enter Topic"
            class="w-full px-4 py-2 border rounded-lg">
        <button type="button" onclick="removeTopic(this)"
            class="px-3 bg-red-500 text-white rounded">X</button>
    `;

            wrapper.appendChild(div);
        }

        function removeTopic(btn) {
            btn.parentElement.remove();
        }
    </script>

@endsection

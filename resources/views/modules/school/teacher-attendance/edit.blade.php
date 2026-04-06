@extends('layouts.app')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">Add New Teacher</h2>

            <form method="POST"
                action="{{ route('teacher.update', ['id' => $editdata->id, 'schoolId' => SchoolLogin()->id]) }}"
                enctype="multipart/form-data">

                @csrf


                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">

                <div class="grid grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="text-sm">Name</label>
                        <input type="text" name="name" value="{{ old('name', $editdata->name) }}"
                            class="w-full border px-3 py-2 rounded-lg @error('name') border-red-500 @enderror">

                        @error('name')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm">Email</label>
                        <input type="email" name="email" value="{{ old('email', $editdata->email) }}"
                            class="w-full border px-3 py-2 rounded-lg @error('email') border-red-500 @enderror">

                        @error('email')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="text-sm">Gender</label>
                        <select name="gender"
                            class="w-full border px-3 py-2 rounded-lg @error('gender') border-red-500 @enderror">

                            <option value="">Select gender</option>
                            @foreach (gender() as $g)
                                <option value="{{ $g }}"
                                    {{ old('gender', $editdata->gender) == $g ? 'selected' : '' }}>
                                    {{ ucfirst($g) }}
                                </option>
                            @endforeach
                        </select>

                        @error('gender')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="text-sm">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $editdata->phone) }}"
                            class="w-full border px-3 py-2 rounded-lg @error('phone') border-red-500 @enderror">

                        @error('phone')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Address -->
                <div class="mt-4">
                    <label class="text-sm">Address</label>
                    <textarea name="address" class="w-full border px-3 py-2 rounded-lg @error('address') border-red-500 @enderror">{{ old('address', $editdata->address) }}</textarea>

                    @error('address')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <!-- Photo -->
                <div class="mt-6">
                    <label class="text-sm font-medium text-gray-600">Photo</label>

                    <div class="flex items-center gap-4 mt-2">

                        <!-- Preview Box -->
                        <div
                            class="w-20 h-20 rounded-full border overflow-hidden flex items-center justify-center bg-gray-100">

                            <!-- Old Image -->
                            @if ($editdata->photo)
                                <img id="oldImg" src="{{ asset( $editdata->photo) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span id="icon" class="text-gray-400 text-xl">📷</span>
                            @endif

                            <!-- New Preview -->
                            <img id="previewImg" class="hidden w-full h-full object-cover">
                        </div>

                        <!-- Upload Button -->
                        <label class="cursor-pointer px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg border text-sm">
                            Upload Photo
                            <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">
                        </label>

                    </div>

                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Designation -->
                <div class="mt-4">
                    <label class="text-sm">Designation</label>
                    <select name="designation" id="designation"
                        class="w-full border px-3 py-2 rounded-lg @error('designation') border-red-500 @enderror"
                        onchange="handleDesignation()">

                        <option value="">Select</option>
                        <option value="teacher"
                            {{ old('designation', $editdata->designation) == 'teacher' ? 'selected' : '' }}>
                            Teacher
                        </option>

                        <option value="class_teacher"
                            {{ old('designation', $editdata->designation) == 'class_teacher' ? 'selected' : '' }}>
                            Class Teacher
                        </option>
                    </select>
                </div>

                <!-- Subject -->
                <div id="subjectField"
                    class="mt-4 {{ old('designation', $editdata->designation) == 'teacher' ? '' : 'hidden' }}">

                    <label>Subject</label>
                    <input type="text" name="subject" value="{{ old('subject', $editdata->subject) }}"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

                <!-- Class Teacher -->
                <div id="classTeacherFields"
                    class="mt-4 grid grid-cols-2 gap-4 {{ old('designation', $editdata->designation) == 'class_teacher' ? '' : 'hidden' }}">

                    <div>
                        <label>Class</label>
                        <select name="class_id" class="w-full border px-3 py-2 rounded-lg">
                            <option value="">Select</option>
                            @foreach (getClass() as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id', $editdata->class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Subject</label>
                        <input type="text" name="subject" value="{{ old('subject', $editdata->subject) }}"
                            class="w-full border px-3 py-2 rounded-lg">
                    </div>

                </div>

                <!-- Joining -->
                <div class="mt-4">
                    <label>Date of Joining</label>
                    <input type="date" name="joining_date" value="{{ old('joining_date', $editdata->joining_date) }}"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">
                    <a href="{{ url()->previous() }}" class="bg-gray-200 px-4 py-2 rounded-lg">
                        ← Cancel
                    </a>

                    <button class="bg-blue-500 text-white px-5 py-2 rounded-lg">
                        Update Teacher
                    </button>
                </div>

            </form>
        </div>

    </div>

    <script>
        function handleDesignation() {
            let val = document.getElementById('designation').value;

            document.getElementById('subjectField').classList.add('hidden');
            document.getElementById('classTeacherFields').classList.add('hidden');

            if (val === 'teacher') {
                document.getElementById('subjectField').classList.remove('hidden');
            } else if (val === 'class_teacher') {
                document.getElementById('classTeacherFields').classList.remove('hidden');
            }
        }

        // image preview
        document.getElementById('photoInput').addEventListener('change', function(e) {
            let file = e.target.files[0];
            if (file) {
                let img = document.getElementById('previewImg');
                img.src = URL.createObjectURL(file);
                img.classList.remove('hidden');
            }
        });
    </script>
@endsection

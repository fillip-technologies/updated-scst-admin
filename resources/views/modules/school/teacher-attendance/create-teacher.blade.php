@extends('layouts.app')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">

        <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">Add New Teacher</h2>

            <form method="POST" action="{{ route('school.teacher') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">

                <div class="grid grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="text-sm">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border px-3 py-2 rounded-lg @error('name') border-red-500 @enderror"
                            placeholder="Enter full name">

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border px-3 py-2 rounded-lg @error('email') border-red-500 @enderror"
                            placeholder="Enter email address">

                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="text-sm">Gender</label>
                        <select name="gender"
                            class="w-full border px-3 py-2 rounded-lg @error('gender') border-red-500 @enderror">

                            <option value="">Select gender</option>
                            @foreach (gender() as $g)
                                <option value="{{ $g }}" {{ old('gender') == $g ? 'selected' : '' }}>
                                    {{ ucfirst($g) }}
                                </option>
                            @endforeach
                        </select>

                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div>
                        <label class="text-sm">Contact</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border px-3 py-2 rounded-lg @error('phone') border-red-500 @enderror"
                            placeholder="Enter phone number">

                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Address -->
                <div class="mt-4">
                    <label class="text-sm">Address</label>
                    <textarea name="address" class="w-full border px-3 py-2 rounded-lg @error('address') border-red-500 @enderror"
                        placeholder="Enter full address">{{ old('address') }}</textarea>

                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div class="mt-6">
                    <label class="text-sm font-medium text-gray-600">Photo</label>

                    <div class="mt-2 flex items-center gap-4">

                        <div id="previewBox"
                            class="w-16 h-16 rounded-full bg-gray-100 border flex items-center justify-center overflow-hidden">

                            <span class="text-gray-400 text-xl">📷</span>
                            <img id="previewImg" class="hidden w-full h-full object-cover" />
                        </div>

                        <label class="cursor-pointer">
                            <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">

                            <div class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-sm rounded-lg border">
                                Upload Photo
                            </div>
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

                        <option value="">Select designation</option>
                        <option value="teacher">Teacher</option>
                        <option value="class_teacher" >Class Teacher
                        </option>
                    </select>

                    @error('designation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject -->
                <div id="subjectField" class="mt-4 {{ old('designation') == 'teacher' ? '' : 'hidden' }}">
                    <label class="text-sm">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}"
                        class="w-full border px-3 py-2 rounded-lg @error('subject') border-red-500 @enderror">

                    @error('subject')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Class Teacher Fields -->
                <div id="classTeacherFields"
                    class="mt-4 grid grid-cols-2 gap-4 {{ old('designation') == 'class_teacher' ? '' : 'hidden' }}">

                    <div>
                        <label class="text-sm">Class</label>
                        <select name="class_id"
                            class="w-full border px-3 py-2 rounded-lg @error('class_id') border-red-500 @enderror">
                            <option value="">Select Class</option>
                            @foreach (getClass() as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('class_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-sm">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                            class="w-full border px-3 py-2 rounded-lg @error('subject') border-red-500 @enderror">

                        @error('subject')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Joining Date -->
                <div class="mt-4">
                    <label class="text-sm">Date of Joining</label>
                    <input type="date" name="joining_date" value="{{ old('joining_date') }}"
                        class="w-full border px-3 py-2 rounded-lg @error('joining_date') border-red-500 @enderror">

                    @error('joining_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">

                    <a href="{{ url()->previous() }}" class="bg-gray-200 px-4 py-2 rounded-lg">
                        ← Cancel
                    </a>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">
                        Save Teacher
                    </button>

                </div>

            </form>
        </div>

    </div>

    <script>
        function handleDesignation() {
            let value = document.getElementById('designation').value;

            document.getElementById('subjectField').classList.add('hidden');
            document.getElementById('classTeacherFields').classList.add('hidden');

            if (value === 'teacher') {
                document.getElementById('subjectField').classList.remove('hidden');
            } else if (value === 'class_teacher') {
                document.getElementById('classTeacherFields').classList.remove('hidden');
            }
        }
    </script>
    <script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const previewImg = document.getElementById('previewImg');
                previewImg.src = URL.createObjectURL(file);
                previewImg.classList.remove('hidden');
            }
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')

<div class="p-8 min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Add New Teacher</h1>
            <p class="text-sm text-gray-500">Fill all details carefully</p>
        </div>

        <a href="{{ route('teacher.attendance') }}"
           class="text-sm text-blue-500 hover:underline">
           Back
        </a>
    </div>

    <!-- Card -->
    <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-gray-100">

        <form method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Basic Info -->
            <h3 class="text-md font-semibold text-gray-700 mb-4 border-b pb-2">
                Basic Information
            </h3>

            <div class="grid grid-cols-2 gap-6">

                <div>
                    <label class="text-sm font-medium">Name</label>
                    <input type="text" name="name" placeholder="Enter full name"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" placeholder="Enter email"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <div>
                    <label class="text-sm font-medium">Gender</label>
                    <select name="gender"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                        <option value="">Select gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        

                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Contact</label>
                    <input type="text" name="contact" placeholder="Enter phone number"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

            </div>

            <!-- Address -->
            <div class="mt-6">
                <label class="text-sm font-medium">Address</label>
                <textarea name="address" placeholder="Enter full address"
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <!-- Photo Upload -->
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

                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max 2MB)</p>
            </div>

            <!-- Professional -->
            <h3 class="text-md font-semibold text-gray-700 mt-8 mb-4 border-b pb-2">
                Professional Details
            </h3>

            <div>
                <label class="text-sm font-medium">Designation</label>
                <select name="designation" id="designation"
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400"
                    onchange="handleDesignation()">

                    <option value="">Select designation</option>
                    <option value="teacher">Teacher</option>
                    <option value="class_teacher">Class Teacher</option>

                </select>
            </div>

            <!-- Subject -->
            <div id="subjectField" class="mt-4 hidden">
                <label class="text-sm font-medium">Subject</label>
                <input type="text" name="subject" placeholder="Enter subject"
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Class Teacher -->
            <div id="classTeacherFields" class="mt-4 hidden grid grid-cols-2 gap-6">

                <div>
                    <label class="text-sm font-medium">Class</label>
                    <input type="text" name="class" placeholder="Enter class"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="text-sm font-medium">Subject</label>
                    <input type="text" name="class_subject" placeholder="Enter subject"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

            </div>

            <!-- Joining -->
            <div class="mt-6">
                <label class="text-sm font-medium">Date of Joining</label>
                <input type="date" name="joining_date"
                    class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center mt-8">

                <a href="{{ route('teacher.attendance') }}"
                   class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-sm">
                   ← Cancel
                </a>

                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-lg shadow-md">
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
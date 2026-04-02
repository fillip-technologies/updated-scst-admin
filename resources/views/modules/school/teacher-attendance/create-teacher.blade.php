@extends('layouts.app')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-4">Add New Teacher</h2>

        <form method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- Name -->
                <div>
                    <label class="text-sm">Name</label>
                    <input type="text" name="name" placeholder="Enter full name"
                        class="w-full border px-3 py-2 rounded-lg" required>
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email" placeholder="Enter email address"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

                <!-- Gender -->
                <div>
                    <label class="text-sm">Gender</label>
                    <select name="gender"
                        class="w-full border px-3 py-2 rounded-lg">
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Transgender">Transgender</option>
                        <option value="Other">Other</option>
                        <option value="Prefer not to say">Prefer not to say</option>
                    </select>
                </div>

                <!-- Contact -->
                <div>
                    <label class="text-sm">Contact</label>
                    <input type="text" name="contact" placeholder="Enter phone number"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

            </div>

            <!-- Address -->
            <div class="mt-4">
                <label class="text-sm">Address</label>
                <textarea name="address" placeholder="Enter full address"
                    class="w-full border px-3 py-2 rounded-lg"></textarea>
            </div>

            <!-- Photo -->
            <div class="mt-6">
                <label class="text-sm font-medium text-gray-600">Photo</label>

                <div class="mt-2 flex items-center gap-4">

                    <!-- Preview -->
                    <div id="previewBox"
                        class="w-16 h-16 rounded-full bg-gray-100 border flex items-center justify-center overflow-hidden">

                        <span class="text-gray-400 text-xl">📷</span>

                        <img id="previewImg" class="hidden w-full h-full object-cover" />
                    </div>

                    <!-- Upload Button -->
                    <label class="cursor-pointer">

                        <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">

                        <div class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-sm rounded-lg border">
                            Upload Photo
                        </div>

                    </label>

                </div>

                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max 2MB)</p>
            </div>

            <!-- Designation -->
            <div class="mt-4">
                <label class="text-sm">Designation</label>
                <select name="designation" id="designation"
                    class="w-full border px-3 py-2 rounded-lg"
                    onchange="handleDesignation()">

                    <option value="">Select designation</option>
                    <option value="teacher">Teacher</option>
                    <option value="class_teacher">Class Teacher</option>

                </select>
            </div>

            <!-- Subject -->
            <div id="subjectField" class="mt-4 hidden">
                <label class="text-sm">Subject</label>
                <input type="text" name="subject" placeholder="Enter subject name"
                    class="w-full border px-3 py-2 rounded-lg">
            </div>

            <!-- Class Teacher Fields -->
            <div id="classTeacherFields" class="mt-4 hidden grid grid-cols-2 gap-4">

                <div>
                    <label class="text-sm">Class</label>
                    <input type="text" name="class" placeholder="Enter class (e.g. 6-A)"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

                <div>
                    <label class="text-sm">Subject</label>
                    <input type="text" name="class_subject" placeholder="Enter subject"
                        class="w-full border px-3 py-2 rounded-lg">
                </div>

            </div>

            <!-- Joining Date -->
            <div class="mt-4">
                <label class="text-sm">Date of Joining</label>
                <input type="date" name="joining_date"
                    class="w-full border px-3 py-2 rounded-lg">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">

                <a href=""
                    class="bg-gray-200 px-4 py-2 rounded-lg">
                    ← Cancel
                </a>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">
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
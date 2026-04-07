@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Manage Results
        </h1>
        <p class="text-sm text-gray-500">
            Upload class-wise result files
        </p>
    </div>

    <!-- UPLOAD CARD -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <form class="grid md:grid-cols-4 gap-4">

            <!-- TERM -->
            <select name="term" class="border rounded-xl px-4 py-2">
                <option value="">Select Term</option>
                <option value="half">Half Yearly</option>
                <option value="third">Third Terminal</option>
                <option value="final">Final</option>
            </select>

            <!-- CLASS -->
            <select name="class" id="classSelect"
                class="border rounded-xl px-4 py-2">
                <option value="">Select Class</option>
                <option value="10">Class 10</option>
                <option value="9">Class 9</option>
            </select>

            <!-- TEACHER -->
            <input type="text"
                   name="teacher"
                   id="teacherName"
                   placeholder="Class Teacher"
                   class="border rounded-xl px-4 py-2 bg-gray-100"
                   readonly>

            <!-- FILE -->
            <input type="file"
                   name="file"
                   placeholder="Upload Result File"
                   class="border rounded-xl px-2 py-2">

        </form>

        <!-- BUTTON -->
        <div class="mt-4 text-right">
            <button class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700">
                Upload
            </button>
        </div>

    </div>

    <!-- LIST -->
    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="font-semibold text-gray-700 mb-4">
            Uploaded Results
        </h2>

        <table class="w-full text-sm">

            <thead>
                <tr class="text-left text-gray-500 border-b">
                    <th class="py-3">Term</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>File</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3">Half Yearly</td>
                    <td>Class 10</td>
                    <td>Mr. Sharma</td>
                    <td>📄 result10.xlsx</td>
                    <td>10 Apr 2026</td>
                </tr>

                <tr>
                    <td class="py-3">Final</td>
                    <td>Class 9</td>
                    <td>Ms. Priya</td>
                    <td>📄 result9.pdf</td>
                    <td>12 Apr 2026</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<!-- JS -->
<script>
    const teachers = {
        "10": "Mr. Sharma",
        "9": "Ms. Priya"
    };

    document.getElementById("classSelect").addEventListener("change", function() {
        let value = this.value;
        document.getElementById("teacherName").value = teachers[value] || "";
    });
</script>

@endsection
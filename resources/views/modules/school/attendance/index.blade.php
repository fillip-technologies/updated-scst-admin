@extends('layouts.app')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Student Attendance</h1>
            <p class="text-sm text-gray-500">Mark and manage daily student attendance records.</p>
        </div>

        <input type="date" class="border rounded-lg px-3 py-2 text-sm">
    </div>

    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT SIDE CLASS LIST -->
        <div class="col-span-3 bg-white rounded-xl shadow-sm p-4">

            <h2 class="text-sm font-semibold text-gray-600 mb-4">Select Class</h2>

            <div id="classList" class="space-y-2">
                @for($i=1; $i<=10; $i++)
                    <div onclick="selectClass({{ $i }})"
                    id="class{{ $i }}"
                    class="class-item px-4 py-2 rounded-lg cursor-pointer 
                    {{ $i==1 ? 'bg-primary-900 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
                    Class {{ $i }}
            </div>
            @endfor
        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="col-span-9 space-y-6">

        <!-- Top Summary -->
        <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">

            <div class="flex gap-8 text-sm">

                <div>
                    <p class="text-gray-500">TOTAL STUDENTS</p>
                    <h3 id="totalCount" class="font-semibold text-gray-800">0</h3>
                </div>

                <div>
                    <p class="text-gray-500">PRESENT</p>
                    <h3 id="presentCount" class="font-semibold text-green-600">0</h3>
                </div>

                <div>
                    <p class="text-gray-500">ABSENT</p>
                    <h3 id="absentCount" class="font-semibold text-red-500">0</h3>
                </div>

            </div>

            <input type="text"
                id="searchInput"
                onkeyup="searchStudent()"
                placeholder="Search student..."
                class="border rounded-lg px-3 py-2 text-sm w-64">
        </div>


        <!-- Attendance Table -->
        <div class="bg-white rounded-xl shadow-sm">

            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h2 id="classTitle" class="font-semibold text-gray-700">
                    Class 1 Attendance List
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-6 text-left">Roll No</th>
                            <th class="py-3 px-6 text-left">Student Name</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody id="attendanceBody" class="divide-y">
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

</div>


<script>
    // Sample data for all classes
    let attendanceData = {};

    for (let c = 1; c <= 10; c++) {
        attendanceData[c] = [];
        for (let i = 1; i <= 20; i++) {
            attendanceData[c].push({
                roll: 100 + i,
                name: "Student " + i,
                status: "Present"
            });
        }
    }

    let currentClass = 1;

    function renderTable() {

        let tbody = document.getElementById("attendanceBody");
        tbody.innerHTML = "";

        let students = attendanceData[currentClass];

        students.forEach((student, index) => {

            let badgeColor = student.status === "Present" ?
                "bg-green-100 text-green-600" :
                "bg-red-100 text-red-600";

            let buttonColor = student.status === "Present" ?
                "border-red-500 text-red-500" :
                "border-green-500 text-green-500";

            let buttonText = student.status === "Present" ?
                "Mark Absent" :
                "Mark Present";

            tbody.innerHTML += `
            <tr class="hover:bg-gray-50">
                <td class="py-3 px-6">${student.roll}</td>
                <td class="py-3 px-6 student-name">${student.name}</td>
                <td class="py-3 px-6">
                    <span class="${badgeColor} px-3 py-1 rounded-full text-xs">
                        ${student.status}
                    </span>
                </td>
                <td class="py-3 px-6">
                    <button onclick="toggleStatus(${index})"
                        class="border ${buttonColor} px-3 py-1 rounded-md text-xs">
                        ${buttonText}
                    </button>
                </td>
            </tr>
        `;
        });

        updateCounts();
    }

    function toggleStatus(index) {

        let student = attendanceData[currentClass][index];

        student.status = student.status === "Present" ? "Absent" : "Present";

        renderTable();
    }

    function updateCounts() {

        let students = attendanceData[currentClass];

        let total = students.length;
        let present = students.filter(s => s.status === "Present").length;
        let absent = total - present;

        document.getElementById("totalCount").innerText = total;
        document.getElementById("presentCount").innerText = present;
        document.getElementById("absentCount").innerText = absent;
    }

    function selectClass(classNumber) {

        currentClass = classNumber;

        document.querySelectorAll(".class-item").forEach(el => {
            el.classList.remove("bg-primary-900", "text-white");
            el.classList.add("hover:bg-gray-100", "text-gray-700");
        });

        let active = document.getElementById("class" + classNumber);
        active.classList.add("bg-primary-900", "text-white");

        document.getElementById("classTitle").innerText =
            "Class " + classNumber + " Attendance List";

        renderTable();
    }

    function searchStudent() {

        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#attendanceBody tr");

        rows.forEach(row => {
            let name = row.querySelector(".student-name").innerText.toLowerCase();
            row.style.display = name.includes(input) ? "" : "none";
        });
    }

    // Initial load
    renderTable();
</script>

@endsection
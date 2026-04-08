@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Edit Student Result</h1>

    <div id="editSection"></div>

</div>

<script>

// 🔥 GET STUDENT ID FROM URL
const urlParts = window.location.pathname.split('/');
const studentId = urlParts[urlParts.length - 1];

// 🔥 DUMMY STUDENT DATA
const students = [
    { id: 1, name: "Manish Kumar", roll: "01" },
    { id: 2, name: "Ravi Kumar", roll: "02" }
];

// FIND CURRENT STUDENT
const student = students.find(s => s.id == studentId);

// 🔥 SUBJECTS (FROM LOCALSTORAGE)
const subjects = JSON.parse(localStorage.getItem("subjects")) || [];

function renderEdit() {

    if (!student) {
        document.getElementById("editSection").innerHTML = "Student not found";
        return;
    }

    if (subjects.length === 0) {
        document.getElementById("editSection").innerHTML = "No subjects found";
        return;
    }

    let html = `
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="font-semibold mb-4">
            👨‍🎓 ${student.name} (Roll: ${student.roll})
        </h2>

        <div class="grid md:grid-cols-2 gap-4">
    `;

    subjects.forEach(sub => {
        let key = sub.toLowerCase() + "_" + student.id;

        html += `
        <div class="border p-4 rounded-lg">

            <p class="font-medium mb-2">${sub}</p>

            <!-- MARKS -->
            <input type="number"
                name="marks_${key}"
                placeholder="Enter Marks"
                class="w-full border px-3 py-2 rounded mb-2">

            <!-- ABSENT -->
            <label class="text-sm flex items-center gap-2 mb-2">
                <input type="checkbox"
                    onchange="toggleAbsent('${key}')">
                Mark as Absent
            </label>

            <!-- FILE -->
            <input type="file"
                name="file_${key}"
                class="w-full text-sm">

        </div>
        `;
    });

    html += `
        </div>

        <!-- UPDATE BUTTON -->
        <div class="mt-6 text-right">
            <button onclick="updateResult()"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Update Result
            </button>
        </div>

    </div>
    `;

    document.getElementById("editSection").innerHTML = html;
}

//  ABSENT LOGIC
function toggleAbsent(key) {
    const input = document.querySelector(`[name="marks_${key}"]`);
    input.disabled = !input.disabled;
    input.value = "";
}

//  UPDATE FUNCTION
function updateResult() {

    const inputs = document.querySelectorAll("input");
    let data = {};

    inputs.forEach(input => {
        if (input.type === "checkbox") {
            data[input.name || "absent"] = input.checked;
        } else if (input.type === "file") {
            data[input.name] = input.files[0]?.name || null;
        } else {
            data[input.name] = input.value;
        }
    });

    console.log("UPDATED DATA:", data);

    alert("Updated successfully ✅");

    // 🔥 REDIRECT BACK
    window.location.href = "/school/manage-result";
}

// INIT
renderEdit();

</script>

@endsection
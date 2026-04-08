@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Upload Student Results
        </h1>
        <p class="text-gray-500 text-sm">
            Select term and enter subject-wise marks
        </p>
    </div>

    <!-- TERM SELECT -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6 flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500 mb-1">Select Term</p>
            <select id="termSelect"
                name="term"
                class="border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400">
                <option value="">Choose Term</option>
                <option value="half">Half Yearly</option>
                <option value="third">Third Terminal</option>
                <option value="final">Final</option>
            </select>
        </div>

        <div class="text-sm text-gray-400">
            Class: <span class="font-medium text-gray-700">10 (Assigned)</span>
        </div>
    </div>

    <!-- STUDENT SECTION -->
    <form id="resultForm">
        <div id="studentSection" class="hidden space-y-6"></div>

        <!-- SAVE BUTTON -->
        <div id="saveBar" class="hidden mt-6 flex justify-end">
            <button type="submit"
                class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition">
                Save Results
            </button>
        </div>
    </form>

</div>

<!-- JS -->
<script>
    // ================= JSON DATA =================
    const students = [{
            id: 1,
            name: "Manish Kumar",
            roll: "01"
        },
        {
            id: 2,
            name: "Ravi Kumar",
            roll: "02"
        }
    ];

    const subjects = JSON.parse(localStorage.getItem("subjects")) || [];

    // ================= RENDER =================
    const container = document.getElementById("studentSection");

    function renderStudents() {

        if (subjects.length === 0) {
            container.innerHTML = `
            <div class="text-center text-gray-400 p-10">
                No subjects added. Please add subjects first.
            </div>
        `;
            return;
        }
        container.innerHTML = "";

        students.forEach(student => {

            let subjectHTML = "";

            subjects.forEach(sub => {
                let key = sub.toLowerCase() + "_" + student.id;

                subjectHTML += `
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 hover:shadow transition">

                    <p class="font-medium text-gray-700 mb-2">${sub}</p>

                    <!-- MARKS -->
                    <input type="number"
                        name="marks_${key}"
                        placeholder="Enter Marks"
                        class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 mb-3 focus:ring-2 focus:ring-blue-400 outline-none">

                    <!-- CUSTOM FILE -->
                    <label class="flex justify-between items-center border border-dashed border-gray-300 rounded-lg px-3 py-2 cursor-pointer hover:border-blue-400 transition">

                        <span id="file_${key}" class="text-sm text-gray-500">
                            Upload Copy
                        </span>

                        <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                            Choose
                        </span>

                        <input type="file"
                            name="file_${key}"
                            class="hidden"
                            onchange="updateFileName(this, 'file_${key}')">
                    </label>

                </div>
            `;
            });

            container.innerHTML += `
            <div class="bg-white rounded-2xl shadow p-6">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-lg text-gray-800">
                        👨‍🎓 ${student.name}
                    </h2>

                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        Roll No: ${student.roll}
                    </span>
                </div>

                <!-- SUBJECTS -->
                <div class="grid md:grid-cols-3 gap-5">
                    ${subjectHTML}
                </div>

            </div>
        `;
        });
    }

    // ================= FILE NAME UPDATE =================
    function updateFileName(input, id) {
        const fileName = input.files[0]?.name || "Upload Copy";
        document.getElementById(id).innerText = fileName;
    }

    // ================= TERM CHANGE =================
    const termSelect = document.getElementById("termSelect");
    const saveBar = document.getElementById("saveBar");

    termSelect.addEventListener("change", function() {
        if (this.value !== "") {
            container.classList.remove("hidden");
            saveBar.classList.remove("hidden");
            renderStudents();
        }
    });

    // ================= FORM SUBMIT (FRONTEND ONLY) =================
    document.getElementById("resultForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        let data = {};

        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }

        console.log("FINAL DATA:", data);
        alert("Data captured in console ");
    });
</script>

@endsection
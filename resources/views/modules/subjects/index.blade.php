@extends('layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">Manage Subjects</h1>

        <!-- ADD SUBJECT -->

        <form action="{{ route('create.subject') }}" method="POST">
            @csrf
            <div class="flex gap-2 mb-6">
                <input name="subject" type="text" placeholder="Enter Subject Name"
                    class="border px-4 py-2 rounded w-full">

                <button type="submit" class="bg-blue-600 text-white px-6 rounded">
                    Add
                </button>
            </div>

        </form>

        <!-- SUBJECT LIST -->
        <div id="subjectList" class="flex flex-wrap gap-2"></div>

    </div>

    <script>
        let subjects = JSON.parse(localStorage.getItem("subjects")) || [];

        function renderSubjects() {
            const list = document.getElementById("subjectList");
            list.innerHTML = "";

            subjects.forEach((sub, index) => {
                list.innerHTML += `
            <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full flex items-center gap-2">
                ${sub}
                <button onclick="deleteSubject(${index})" class="text-red-500">✕</button>
            </div>
        `;
            });
        }

        function addSubject() {
            const input = document.getElementById("subjectInput");
            const value = input.value.trim();

            if (value) {
                subjects.push(value);
                localStorage.setItem("subjects", JSON.stringify(subjects));
                input.value = "";
                renderSubjects();
            }
        }

        function deleteSubject(index) {
            subjects.splice(index, 1);
            localStorage.setItem("subjects", JSON.stringify(subjects));
            renderSubjects();
        }

        renderSubjects();
<<<<<<< Updated upstream
    </script>
=======
    }
}

function deleteSubject(index) {
    subjects.splice(index, 1);
    localStorage.setItem("subjects", JSON.stringify(subjects));
    renderSubjects();
}

renderSubjects();
</script>

>>>>>>> Stashed changes
@endsection

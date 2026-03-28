@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">School Management</h1>
                <p class="text-sm text-gray-500">Manage student records</p>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-3 bg-white rounded-xl shadow-sm p-4">
                <h2 class="text-sm font-semibold text-gray-600 mb-4">Select Class</h2>

                <form id="classForm" action="" method="GET">

                    <input type="hidden" name="class" id="selectedClass">
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">

                    @php
                        $activeClass = session('selected_class') ?? $classes->first()->id;
                    @endphp

                    <div class="space-y-2">
                        @foreach ($classes as $class)
                            <div onclick="selectClass('{{ $class->id }}')"
                                class="class-item px-4 py-2 rounded-lg cursor-pointer
                               {{ $activeClass == $class->id ? 'bg-primary-900 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
                                {{ $class->name }}
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>

            <div class="col-span-12 lg:col-span-9 space-y-6">
                <div
                    class="bg-white rounded-xl shadow-sm p-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 id="classTitle" class="font-semibold text-gray-700">Class 1 Student List</h2>
                        <p class="text-sm text-gray-500">View, search, and manage student records.</p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <input type="text" id="searchInput" onkeyup="searchStudent()" placeholder="Search student..."
                            class="border rounded-lg px-3 py-2 text-sm w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-primary-200">

                        <a href="{{ route('school.stud.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition">
                            Add Student
                        </a>

                        <a href="{{ route('student.bulkupload') }}"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary-900 text-primary-900 text-sm font-medium hover:bg-primary-50 transition">
                            Bulk Upload
                        </a>

                        <a href="{{ route('student.bulkupload') }}"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-primary-900 text-primary-900 text-sm font-medium hover:bg-primary-50 transition">
                            Export
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="py-3 px-6 text-left">Sr.No</th>
                                    <th class="py-3 px-6 text-left">Roll No</th>
                                    <th class="py-3 px-6 text-left">Student Name</th>
                                    <th class="py-3 px-6 text-left">Parent Name</th>
                                    <th class="py-3 px-6 text-left">Parent Relation</th>
                                    <th class="py-3 px-6 text-left">Class</th>
                                    <th class="py-3 px-6 text-left">Mobile</th>
                                    <th class="py-3 px-6 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody id="studentTableBody" class="divide-y">
                                @forelse ($studentdata as $stud)
                                    <tr>
                                        <td class="py-3 px-6">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-6">{{ $stud->roll_number }}</td>
                                        <td class="py-3 px-6">{{ $stud->name }}</td>
                                        <td class="py-3 px-6">{{ $stud->parent_name }}</td>
                                        <td class="py-3 px-6">{{ $stud->parent_relation }}</td>
                                        <td class="py-3 px-6">{{ $stud->allclass->name }}</td>
                                        <td class="py-3 px-6">{{ $stud->parent_phone }}</td>
                                        <td class="py-3 px-6">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('school.stud.edit', $stud->id) }}"
                                                    class="inline-flex items-center px-3 py-1 rounded-md bg-green-50 text-green-700 border border-green-200 text-xs font-medium hover:bg-green-100 transition">
                                                    Edit
                                                </a>
                                                <form action="{{ route('student.delete', $stud->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this student?');"
                                                        class="inline-flex items-center px-3 py-1 rounded-md bg-red-50 text-red-600 border border-red-200 text-xs font-medium hover:bg-red-100 transition">
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
    const studentData = {
        1: [
            { roll: '101', name: 'Aarav Kumar', father_name: 'Rajesh Kumar', mother_name: 'Sunita Devi', class_name: 'Class 1', mobile: '9876543210', status: 'Active' },
            { roll: '102', name: 'Diya Sharma', father_name: 'Vikas Sharma', mother_name: 'Kavita Sharma', class_name: 'Class 1', mobile: '9123456780', status: 'Inactive' },
            { roll: '103', name: 'Ishaan Verma', father_name: 'Mohit Verma', mother_name: 'Pooja Verma', class_name: 'Class 1', mobile: '9988776655', status: 'Active' }
        ],
        2: [
            { roll: '201', name: 'Anaya Singh', father_name: 'Rohit Singh', mother_name: 'Neha Singh', class_name: 'Class 2', mobile: '9012345678', status: 'Active' },
            { roll: '202', name: 'Kabir Das', father_name: 'Suresh Das', mother_name: 'Meena Das', class_name: 'Class 2', mobile: '9090909090', status: 'Active' },
            { roll: '203', name: 'Myra Patel', father_name: 'Nitin Patel', mother_name: 'Rina Patel', class_name: 'Class 2', mobile: '9345678901', status: 'Inactive' }
        ],
        3: [
            { roll: '301', name: 'Rudra Yadav', father_name: 'Amit Yadav', mother_name: 'Seema Yadav', class_name: 'Class 3', mobile: '9234567810', status: 'Active' },
            { roll: '302', name: 'Sara Khan', father_name: 'Imran Khan', mother_name: 'Farah Khan', class_name: 'Class 3', mobile: '9871203456', status: 'Active' },
            { roll: '303', name: 'Vivaan Jain', father_name: 'Manoj Jain', mother_name: 'Pallavi Jain', class_name: 'Class 3', mobile: '9811112233', status: 'Active' }
        ],
        4: [
            { roll: '401', name: 'Aditi Roy', father_name: 'Subhash Roy', mother_name: 'Nandini Roy', class_name: 'Class 4', mobile: '9765432101', status: 'Active' },
            { roll: '402', name: 'Dev Malhotra', father_name: 'Rakesh Malhotra', mother_name: 'Anita Malhotra', class_name: 'Class 4', mobile: '9654321098', status: 'Inactive' },
            { roll: '403', name: 'Kiara Joshi', father_name: 'Prakash Joshi', mother_name: 'Maya Joshi', class_name: 'Class 4', mobile: '9543210987', status: 'Active' }
        ],
        5: [
            { roll: '501', name: 'Arjun Thakur', father_name: 'Deepak Thakur', mother_name: 'Rekha Thakur', class_name: 'Class 5', mobile: '9432109876', status: 'Active' },
            { roll: '502', name: 'Naira Gupta', father_name: 'Anil Gupta', mother_name: 'Sangeeta Gupta', class_name: 'Class 5', mobile: '9321098765', status: 'Active' },
            { roll: '503', name: 'Parth Nanda', father_name: 'Harish Nanda', mother_name: 'Asha Nanda', class_name: 'Class 5', mobile: '9210987654', status: 'Inactive' }
        ],
        6: [
            { roll: '601', name: 'Reyansh Paul', father_name: 'Sanjay Paul', mother_name: 'Rita Paul', class_name: 'Class 6', mobile: '9109876543', status: 'Active' },
            { roll: '602', name: 'Siya Mehta', father_name: 'Ajay Mehta', mother_name: 'Komal Mehta', class_name: 'Class 6', mobile: '9191919191', status: 'Active' },
            { roll: '603', name: 'Tanishq Rao', father_name: 'Kiran Rao', mother_name: 'Lata Rao', class_name: 'Class 6', mobile: '9081726354', status: 'Inactive' }
        ],
        7: [
            { roll: '701', name: 'Vedika Sen', father_name: 'Arup Sen', mother_name: 'Mitali Sen', class_name: 'Class 7', mobile: '8976543210', status: 'Active' },
            { roll: '702', name: 'Yuvan Bose', father_name: 'Tapas Bose', mother_name: 'Lipika Bose', class_name: 'Class 7', mobile: '8865432109', status: 'Active' },
            { roll: '703', name: 'Zara Ali', father_name: 'Naseem Ali', mother_name: 'Shabnam Ali', class_name: 'Class 7', mobile: '8754321098', status: 'Inactive' }
        ],
        8: [
            { roll: '801', name: 'Harsh Raj', father_name: 'Dilip Raj', mother_name: 'Madhuri Raj', class_name: 'Class 8', mobile: '8643210987', status: 'Active' },
            { roll: '802', name: 'Jiya Sahu', father_name: 'Ramesh Sahu', mother_name: 'Shanti Sahu', class_name: 'Class 8', mobile: '8532109876', status: 'Inactive' },
            { roll: '803', name: 'Laksh Batra', father_name: 'Vinod Batra', mother_name: 'Bhavna Batra', class_name: 'Class 8', mobile: '8421098765', status: 'Active' }
        ],
        9: [
            { roll: '901', name: 'Mihir Kapoor', father_name: 'Rajiv Kapoor', mother_name: 'Monika Kapoor', class_name: 'Class 9', mobile: '8310987654', status: 'Active' },
            { roll: '902', name: 'Navya Soni', father_name: 'Mukesh Soni', mother_name: 'Anjali Soni', class_name: 'Class 9', mobile: '8209876543', status: 'Active' },
            { roll: '903', name: 'Ojas Tiwari', father_name: 'Pankaj Tiwari', mother_name: 'Shikha Tiwari', class_name: 'Class 9', mobile: '8098765432', status: 'Inactive' }
        ],
        10: [
            { roll: '1001', name: 'Priyanshi Das', father_name: 'Sudhir Das', mother_name: 'Rupa Das', class_name: 'Class 10', mobile: '7987654321', status: 'Active' },
            { roll: '1002', name: 'Raghav Chouhan', father_name: 'Mahesh Chouhan', mother_name: 'Usha Chouhan', class_name: 'Class 10', mobile: '7876543210', status: 'Active' },
            { roll: '1003', name: 'Tanvi Gill', father_name: 'Kuldeep Gill', mother_name: 'Manpreet Gill', class_name: 'Class 10', mobile: '7765432109', status: 'Inactive' }
        ]
    };

    let currentClass = 1;

    function renderTable() {
        const tbody = document.getElementById('studentTableBody');
        const students = studentData[currentClass] || [];

        tbody.innerHTML = '';

        students.forEach((student) => {
            const badgeClass = student.status === 'Active'
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-600';

            tbody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-6">${student.roll}</td>
                    <td class="py-3 px-6 student-name font-medium text-gray-800">${student.name}</td>
                    <td class="py-3 px-6">${student.father_name}</td>
                    <td class="py-3 px-6">${student.mother_name}</td>
                    <td class="py-3 px-6">${student.class_name}</td>
                    <td class="py-3 px-6">${student.mobile}</td>
                    <td class="py-3 px-6">
                        <span class="${badgeClass} px-3 py-1 rounded-full text-xs font-medium">${student.status}</span>
                    </td>
                    <td class="py-3 px-6">

                    </td>
                </tr>
            `;
        });
    }

    function selectClass(classNumber) {
        currentClass = classNumber;

        document.querySelectorAll('.class-item').forEach((item) => {
            item.classList.remove('bg-primary-900', 'text-white');
            item.classList.add('text-gray-700', 'hover:bg-gray-100');
        });

        const activeClass = document.getElementById(`class${classNumber}`);
        activeClass.classList.remove('text-gray-700', 'hover:bg-gray-100');
        activeClass.classList.add('bg-primary-900', 'text-white');

        document.getElementById('classTitle').innerText = `Class ${classNumber} Student List`;
        document.getElementById('searchInput').value = '';
        renderTable();
    }

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this student?')) {
            alert('Deleted (UI only)');
        }
    }
    function searchStudent() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#studentTableBody tr');

        rows.forEach((row) => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    }

    renderTable();
</script> --}}
    <script>
        function selectClass(classId) {
            document.getElementById('selectedClass').value = classId;
            document.getElementById('classForm').submit();
        }
    </script>
@endsection

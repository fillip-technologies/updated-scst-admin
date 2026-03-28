@extends('layouts.app')

@section('content')
=

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
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

                <form id="classForm" action="{{ route('student.class.filter') }}" method="GET">

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

                        <a href="{{ route('student.export') }}"
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
                <div>
                    {{ $studentdata->links() }}
                </div>
            </div>
        </div>
    </div>


    <script>
        function selectClass(classId) {
            document.getElementById('selectedClass').value = classId;
            document.getElementById('classForm').submit();
        }
    </script>
@endsection

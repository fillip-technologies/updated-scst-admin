@extends('layouts.app')

@section('content')
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

        @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="bg-gray-100 min-h-screen py-8">

        <!-- Header -->
        <div class="max-w-6xl mx-auto mb-6 px-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">Teacher Management</h1>
                    <p class="text-sm text-gray-500">Manage teacher records</p>
                </div>

                <a href="{{ route('teacher.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                    + Add Teacher
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-sm p-4">

            <!-- Search -->
            <div class="flex justify-between items-center mb-4">

                <div class="relative">
                    <input type="text" id="searchInput" onkeyup="searchTeacher()" placeholder="Search teacher..."
                        class="border rounded-lg pl-10 pr-3 py-2 text-sm w-64 focus:ring-2 focus:ring-blue-200 outline-none">

                    <!-- Icon -->
                    <span class="absolute left-3 top-2.5 text-gray-400 text-sm">🔍</span>
                </div>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center">

                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Photo</th>
                            <th class="py-3 px-4">Name</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Phone</th>
                            <th class="py-3 px-4">Gender</th>
                            <th class="py-3 px-4">Designation</th>
                            <th class="py-3 px-4">Subject</th>
                            <th class="py-3 px-4">Class</th>
                            <th class="py-3 px-4">Joining</th>
                            <th class="py-3 px-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse ($teachers as $key => $teacher)
                            <tr class="hover:bg-gray-50">

                                <!-- Sr -->
                                <td class="py-2 px-4">{{ $key + 1 }}</td>

                                <!-- Photo -->
                                <td class="py-2 px-4">
                                    <img src="{{ asset($teacher->photo ?? "teacher/Abhishek.jpg") }}"
                                        class="w-10 h-10 rounded-full mx-auto object-cover border">
                                </td>

                                <!-- Name -->
                                <td class="py-2 px-4 font-medium text-gray-700">
                                    {{ $teacher->name }}
                                </td>

                                <!-- Email -->
                                <td class="py-2 px-4">
                                    {{ $teacher->email ?? '-' }}
                                </td>

                                <!-- Phone -->
                                <td class="py-2 px-4">
                                    {{ $teacher->phone ?? '-' }}
                                </td>


                                <td class="py-2 px-4">
                                    {{ ucfirst($teacher->gender) ?? '-' }}
                                </td>


                                <td class="py-2 px-4">
                                    {{ ucfirst(str_replace('_', ' ', $teacher->designation)) }}
                                </td>


                                <td class="py-2 px-4">
                                    {{ $teacher->subject ?? '-' }}
                                </td>


                                <td class="py-2 px-4">
                                    {{ $teacher->class_id ?? '-' }}
                                </td>


                                <td class="py-2 px-4">
                                    {{ $teacher->joining_date ?? '-' }}
                                </td>


                                <td class="py-2 px-4 space-x-2">

                                    <a href="{{ route('edit.teacher', ['id' => $teacher->id, 'schoolId' => SchoolLogin()->id]) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium
                                        bg-blue-50 text-blue-600 rounded-lg border border-blue-200
                                        hover:bg-blue-100 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('delete.teacher',['id' => $teacher->id , 'schoolId'=>SchoolLogin()->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium
                                           bg-red-50 text-red-600 rounded-lg border border-red-200
                                            hover:bg-red-100 transition">
                                            Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="11" class="py-6 text-gray-400 text-center">
                                    🚫 No teachers found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
{{ $teachers->links() }}
            </div>

        </div>

    </div>
@endsection

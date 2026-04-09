@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
                showConfirmButton: true
            })
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}",
                showConfirmButton: true
            })
        </script>
    @endif
    <div class="p-8 bg-gray-100 min-h-screen">

        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm">

            <div class="flex items-center gap-4">
                <a href="{{ SchoolLogin() ? route('school.attendance') : route('staff.school.attendance') }}"
                    class="flex items-center gap-2 text-sm text-gray-600 hover:text-blue-600 transition">
                    <span class="text-lg">←</span>
                    <span class="font-medium">Back</span>
                </a>

                <div class="h-6 w-px bg-gray-300"></div>

                <h2 class="text-lg font-semibold text-gray-800">
                    Add New Class
                </h2>



            </div>

            <div class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full">
                Academic Setup
            </div>
        </div>

        <!-- GRID START -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- LEFT: FORM -->
            <div class="md:col-span-1 bg-white p-6 rounded-xl shadow h-fit">

                <form method="POST"
                    action="{{ SchoolLogin()
                        ? (isset($editdata)
                            ? route('school.update.class', $editdata->id)
                            : route('school.add.class'))
                        : (TeacherLog()
                            ? (isset($editdata)
                                ? route('staff.update.class', $editdata->id)
                                : route('staff.add.class'))
                            : '#') }}">
                    @csrf

                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id ?? TeacherLog()->school_id }}">

                    <div class="mb-4">
                        <label class="block text-sm mb-1 font-medium">Class Name</label>
                        <input type="text" name="class_name" value="{{ old('class_name', $editdata->class ?? '') }}"
                            class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm mb-1 font-medium">Optional(Section)</label>
                        <input type="text" name="section"
                            class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                    </div>

                    <button type="submit" class="w-50 bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                        {{ isset($editdata) ? 'Update' : 'Save Class' }}
                    </button>
                    {{-- <button type="button" class="w-50 bg-blue-500 rounded-lg py-2 text-white w-20">Import</button> --}}

                </form>
            </div>

            <!-- RIGHT: LIST -->
            <div class="md:col-span-2 bg-white rounded-xl shadow overflow-x-auto">

                <table class="w-full text-sm">

                    <!-- Head -->
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Class Name</th>
                            <th class="py-3 px-6 text-left">Class</th>
                            <th class="py-3 px-6 text-center">Action</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="divide-y">
                        @forelse ($classdata as $key => $class)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="py-3 px-6">{{ $key + 1 }}</td>
                                <td class="py-3 px-6">{{ $class->name }}</td>
                                <td class="py-3 px-6">{{ $class->class }}</td>

                                <!-- Action -->
                                <td class="py-3 px-6">
                                    <div class="flex justify-center gap-2">

                                        <!-- Edit -->
                                        <a href="{{ SchoolLogin() ?  route('school.edit.class', $class->id) :route('staff.edit.class', $class->id)  }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                            Edit
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{SchoolLogin() ?  route('school.delete.class', $class->id) : route('staff.delete.class', $class->id)  }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="school_id"
                                                value="{{ SchoolLogin()->id ?? TeacherLog()->school_id }}">
                                            <button type="submit" onclick="return confirm('Are you sure ?')"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                                Delete
                                            </button>
                                        </form>


                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>
        <!-- GRID END -->

    </div>
@endsection

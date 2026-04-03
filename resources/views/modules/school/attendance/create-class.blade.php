@extends('layouts.app')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm">

        <div class="flex items-center gap-4">
            <a href="{{ route('school.attendance') }}"
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

            <form method="POST" action="">
                @csrf

                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">

                <div class="mb-4">
                    <label class="block text-sm mb-1 font-medium">Class Name</label>
                    <input type="text" name="name"
                        class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm mb-1 font-medium">Section</label>
                    <input type="text" name="section"
                        class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                    Save Class
                </button>

            </form>
        </div>

        <!-- RIGHT: LIST -->
        <div class="md:col-span-2 bg-white rounded-xl shadow overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Class</th>
                        <th class="py-3 px-6 text-left">Section</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">



                </tbody>

            </table>

        </div>

    </div>
    <!-- GRID END -->

</div>

@endsection

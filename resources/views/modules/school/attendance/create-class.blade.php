@extends('layouts.app')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <!-- Top Back + Title -->
    <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm">

        <!-- Left: Back + Title -->
        <div class="flex items-center gap-4">

            <!-- Back Button -->
            <a href="{{ route('school.attendance') }}"
                class="flex items-center gap-2 text-sm text-gray-600 hover:text-blue-600 transition">

                <span class="text-lg">←</span>
                <span class="font-medium">Back</span>
            </a>

            <!-- Divider -->
            <div class="h-6 w-px bg-gray-300"></div>

            <!-- Title -->
            <h2 class="text-lg font-semibold text-gray-800">
                Add New Class
            </h2>

        </div>

        <!-- Optional Right Badge -->
        <div class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-full">
            Academic Setup
        </div>

    </div>

    <!-- Form Card -->
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

        <form method="POST">
            @csrf

            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">

            <!-- Class Name -->
            <div class="mb-4">
                <label class="block text-sm mb-1 font-medium">Class Name</label>
                <input type="text" name="name" placeholder="Enter class name"
                    class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                    required>
            </div>

            <!-- Section -->
            <div class="mb-4">
                <label class="block text-sm mb-1 font-medium">Section (Optional)</label>
                <input type="text" name="section" placeholder="A, B"
                    class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center mt-6">

                <!-- Back -->
                <a href="{{ route('school.attendance') }}"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
                    ← Cancel
                </a>

                <!-- Save -->
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg text-sm">
                    Save Class
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
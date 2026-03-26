@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen">
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Student</h1>
        <p class="text-sm text-gray-500">Update the student record to correct wrong data.</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="font-semibold text-gray-700">Student Information</h2>
            </div>

            <form class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Student Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="Aarav Kumar"
                            placeholder="Enter Student Name"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                    </div>

                    <div>
                        <label for="father_name" class="block text-sm font-medium text-gray-700 mb-2">Father Name</label>
                        <input
                            type="text"
                            id="father_name"
                            name="father_name"
                            value="Rajesh Kumar"
                            placeholder="Enter Father Name"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                    </div>

                    <div>
                        <label for="mother_name" class="block text-sm font-medium text-gray-700 mb-2">Mother Name</label>
                        <input
                            type="text"
                            id="mother_name"
                            name="mother_name"
                            value="Sunita Devi"
                            placeholder="Enter Mother Name"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                    </div>

                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Class</label>
                        <select
                            id="class"
                            name="class"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="Class {{ $i }}" {{ $i === 1 ? 'selected' : '' }}>Class {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">Mobile</label>
                        <input
                            type="text"
                            id="mobile"
                            name="mobile"
                            value="9876543210"
                            placeholder="Enter Mobile Number"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition">
                        Update Student
                    </button>

                    <a
                        href="#"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

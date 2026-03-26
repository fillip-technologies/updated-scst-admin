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
    @endif
    <div class="bg-gray-100 min-h-screen">
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Add Student</h1>
            <p class="text-sm text-gray-500">Create a new student record for school management.</p>
        </div>

        <div class=" min-h-screen items-center justify-center">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold text-gray-700">Student Information</h2>
                </div>

                <form method="POST" action="{{ route('addmition.student') }}" class="p-6 space-y-6">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Student Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Student Name</label>
                            <input type="text" name="name" placeholder="Enter Student Name" value="{{ old('name') }}"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">

                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Roll Number -->
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Roll Number</label>
                            <input type="text" name="roll_number" placeholder="Enter Roll Number"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                 @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <!-- DOB -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Of Birth</label>
                            <input type="date" name="dob"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                   @error('dob')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select name="gender"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                             @error('gender')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Student Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Student Email</label>
                            <input type="email" name="email" placeholder="Enter Email"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                  @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Student Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Student Phone</label>
                            <input type="text" name="phone" placeholder="Enter Phone"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                @error('phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Class -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Class</label>
                            <select name="class_id"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                <option value="">Select Class</option>
                                @foreach (getClass() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Parent Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Parent Name</label>
                            <input type="text" name="parent_name" placeholder="Enter Parent Name"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                @error('parent_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Parent Relation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Parent Relation</label>
                            <select name="parent_relation"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                <option value="">Select Relation</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="guardian">Guardian</option>
                            </select>
                            @error('parent_relation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Parent Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Parent Email</label>
                            <input type="email" name="parent_email" placeholder="Enter Parent Email"
                                class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                                   @error('parent_email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Parent Phone</label>
                        <input type="text" name="parent_phone" placeholder="Enter Parent Phone"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-green-200">
                            @error('parent_phone')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-green-600 text-white text-sm hover:bg-green-700">
                            Save Student
                        </button>

                        <a href="#" class="px-5 py-2.5 rounded-lg border text-gray-700 text-sm hover:bg-gray-50">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

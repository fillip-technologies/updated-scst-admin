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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif
    <div class="min-h-screen bg-gray-100 flex  justify-center px-4">
        <div class="w-full max-w-md">

            <!-- CARD -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

                <!-- TOP BANNER -->
                <div class="h-24 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

                <div class="px-6 pb-6">

                    <!-- PROFILE IMAGE -->
                    <div class="flex justify-center">
                        <img src="{{ Auth::user()->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-md -mt-14 bg-white">
                    </div>

                    <!-- NAME -->
                    <div class="text-center mt-3">
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ Auth::user()->role === 'school_admin' ? Auth::user()->school->principle_name : Auth::user()->name }}
                        </h2>

                        <!-- EMAIL -->
                        <p class="text-gray-500 text-sm mt-1">
                            {{ Auth::user()->role === 'school_admin' ? Auth::user()->school->official_email : Auth::user()->username }}
                        </p>

                        <!-- ROLE -->
                        <span class="inline-block mt-2 px-3 py-1 text-xs font-medium bg-blue-50 text-blue-600 rounded-full">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>

                    <!-- DETAILS -->
                    <div class="mt-6 border-t pt-4 text-sm">

                        <div class="flex justify-between py-2">
                            <span class="text-gray-500">Account Created</span>
                            <span class="font-medium text-gray-700">
                                {{ Auth::user()->created_at->format('d M Y') }}
                            </span>
                        </div>

                        @if (Auth::user()->role === 'school_admin')
                            <div class="flex justify-between py-2">
                                <span class="text-gray-500">School</span>
                                <span class="font-medium text-gray-700">
                                    {{ Auth::user()->school->school_name ?? '-' }}
                                </span>
                            </div>
                        @endif

                    </div>

                    <!-- FORGOT PASSWORD LINK -->
                    <div class="mt-5 text-center">
                        <button id="openModal" class=" bg-blue-900 text-sm text-white  p-x-2 py-3 p-2 border rounded-xl">
                            Change Password?
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div id="modal" class="fixed inset-0 bg-opacity-50 hidden items-center justify-center">

        <!-- Modal Box -->
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">

            <!-- Close Button -->
            <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">
                ✖
            </button>

            <!-- Content -->
            <h2 class="text-xl font-semibold mb-3">Reset Password</h2>
            <form id="resetForm" class="space-y-4" action="{{ route('reset.school.password') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ Auth::user()->role === 'school_admin' ? Auth::user()->school->id : '' }}"
                    name="id">
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" id="email" readonly name="email"
                        value="{{ old('email', Auth::user()->role === 'school_admin' ? Auth::user()->school->official_email : Auth::user()->username) }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                        placeholder="Enter your email">
                    @error('email')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">New Password</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                        placeholder="Enter new password">
                    @error('password')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="password_confirmation"
                        value="{{ old('password_confirmation') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                        placeholder="Confirm password">
                    @error('password_confirmation')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Error -->
                <p id="errorMsg" class="text-red-500 text-sm hidden"></p>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Update Password
                </button>

            </form>



        </div>
    </div>
    <script>
        const modal = document.getElementById('modal');
        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');
        const closeBtn2 = document.getElementById('closeBtn');

        // Open modal
        openBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        // Close modal (buttons)
        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        closeBtn.addEventListener('click', closeModal);
        closeBtn2.addEventListener('click', closeModal);

        // Close on outside click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    </script>
@endsection

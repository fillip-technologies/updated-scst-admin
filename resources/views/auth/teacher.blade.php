@extends('layouts.login')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div class="w-[900px] bg-white rounded-2xl shadow-2xl overflow-hidden flex">

        <!-- LEFT -->
        <div class="w-1/2 bg-primary-900 text-white flex flex-col justify-center items-center p-12">
            <h2 class="text-3xl font-semibold mb-4">
                SC / ST Welfare Portal
            </h2>
            <p class="text-gray-300 text-center text-sm">
                Login or register to access government services.
            </p>
        </div>

        <!-- Alerts -->
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: @json(session('error'))
                });
            </script>
        @endif

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`
                });
            </script>
        @endif

        <!-- RIGHT -->
        <!-- RIGHT -->
        <div class="w-1/2 p-10">

            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-primary-800">
                    Login
                </h2>
                <p class="text-gray-500 text-sm mt-2">
                    Select your login type
                </p>
            </div>

            <form action="{{ route('system.login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Login Type -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Login As
                    </label>

                    <div class="grid grid-cols-2 gap-4">

                        <label
                            class="flex items-center justify-center gap-2 border rounded-xl py-3 cursor-pointer hover:border-primary-600">
                            <input type="radio" name="login_type" value="staff" checked>
                            <span class="font-medium">👨‍🏫 Teacher</span>
                        </label>

                        <label
                            class="flex items-center justify-center gap-2 border rounded-xl py-3 cursor-pointer hover:border-primary-600">
                            <input type="radio" name="login_type" value="dwo">
                            <span class="font-medium">🏢 DWO</span>
                        </label>

                    </div>
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <input type="text" name="username" id="Username" value="{{ old('username') }}" required
                        placeholder="Username"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-600 focus:outline-none">
                </div>

                <!-- Password -->
                <div class="mb-5 relative">
                    <input id="password" type="password" name="password" required placeholder="Password"
                        class="w-full border rounded-xl px-4 py-3 pr-20 focus:ring-2 focus:ring-primary-600 focus:outline-none">

                    <button type="button" onclick="togglePassword(event)"
                        class="absolute right-4 top-3 text-sm text-gray-600 hover:text-primary-700">
                        👁 Show
                    </button>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-primary-700 hover:bg-primary-800 text-white py-3 rounded-xl font-semibold transition">
                    Login →
                </button>

            </form>

        </div>
    </div>

    <script>
        function togglePassword(e) {
            let input = document.getElementById('password');

            if (input.type === "password") {
                input.type = "text";
                e.target.innerText = "🙈 Hide";
            } else {
                input.type = "password";
                e.target.innerText = "👁 Show";
            }
        }

        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const passwordField = document.getElementById('password');
            const usernameField = document.getElementById('Username');

            try {
                const res = await fetch('/api/public-key');
                const data = await res.json();

                const encrypt = new JSEncrypt();
                encrypt.setPublicKey(data.public_key);

                const encryptedPassword = encrypt.encrypt(passwordField.value);
                const encryptedUsername = encrypt.encrypt(usernameField.value);

                if (!encryptedPassword || !encryptedUsername) {
                    alert('Encryption Failed');
                    return;
                }

                passwordField.value = encryptedPassword;
                usernameField.value = encryptedUsername;

                this.submit();

            } catch (error) {
                console.error(error);
                alert('Encryption Error');
            }
        });
    </script>
@endsection

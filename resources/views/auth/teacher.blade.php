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
        <div class="w-1/2 p-10">

            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-primary-800">
                    Teacher Login
                </h2>
            </div>

            <form action="{{ route('system.login') }}" method="POST" id="loginForm">
                @csrf
                <input type="hidden" name="login_type" value="staff">

                <div class="mb-4">
                    <input type="text" name="username" value="{{ old('username') }}" required placeholder="Username"
                        class="w-full border rounded-xl px-4 py-2">
                </div>


                <div class="mb-4 relative">
                    <input id="password" type="password" name="password" required placeholder="Password"
                        class="w-full border rounded-xl px-4 py-2 pr-16">

                    <button type="button" onclick="togglePassword(event)" class="absolute right-3 top-2 text-sm">
                        👁 Show
                    </button>
                </div>

                <button type="submit" class="w-full bg-primary-700 text-white py-2 rounded-xl">
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

        document
            .getElementById('loginForm')
            .addEventListener('submit', async function(e) {

                e.preventDefault();
                const passwordField =
                    document.getElementById('password');

                const res = await fetch('http://127.0.0.1:8000/api/public-key');
                const data = await res.json();

                const encrypt = new JSEncrypt();
                encrypt.setPublicKey(data.public_key);

                const encryptedPassword =
                    encrypt.encrypt(passwordField.value);

                if (!encryptedPassword) {
                    alert('Encryption failed');
                    return;
                }

                passwordField.value = encryptedPassword;

                this.submit();
            });
    </script>
@endsection

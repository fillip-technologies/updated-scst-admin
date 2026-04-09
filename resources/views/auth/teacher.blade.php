@extends('layouts.login')

@section('content')

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="w-[900px] bg-white rounded-2xl shadow-2xl overflow-hidden flex">

    <!-- LEFT SIDE -->
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
                title: 'Authentication Error',
                text: @json(session('error')),
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `@foreach ($errors->all() as $error) {{ $error }} <br> @endforeach`,
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    <!-- RIGHT SIDE -->
    <div class="w-1/2 p-10">

        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-primary-800">
                Teacher Login
            </h2>
            <p class="text-sm text-gray-500">
                Teacher Login System
            </p>
        </div>

        <form action="{{ route('system.login') }}" method="POST" class="space-y-5" onsubmit="return validateCaptcha()">
            @csrf

            <input type="hidden" name="login_type" value="staff">

            <!-- Username -->
            <div>
                <input type="text" name="username" placeholder="Enter your Username"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
            </div>

            <!-- Password -->
            <div class="relative">
                <input id="password" type="password" name="password" placeholder="Password"
                    class="w-full border rounded-xl px-4 py-2 pr-10 focus:ring-2 focus:ring-primary-700">

                <button type="button" onclick="togglePassword(event)"
                    class="absolute right-3 top-2 text-gray-400 text-sm">
                    👁
                </button>
            </div>

            <!-- Captcha -->
            <div class="flex items-center gap-3">
                <input type="text" id="captchaInput" placeholder="Enter Captcha"
                    class="flex-1 border rounded-xl px-4 py-2">

                <div id="captchaBox"
                    class="px-4 py-2 bg-gray-200 rounded-md font-mono tracking-widest">
                </div>

                <button type="button" onclick="generateCaptcha()" class="text-gray-500">
                    ⟳
                </button>
            </div>

            <!-- Remember -->
            <div class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember">
                <span class="text-gray-600">Remember me</span>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-primary-700 hover:bg-primary-800 text-white py-2 rounded-xl">
                Access Dashboard →
            </button>
        </form>

        <!-- Signup -->
        <p class="text-sm text-center mt-6 text-gray-600">
            New user?
            <a href="{{ route('signup') }}" class="text-primary-700 font-medium hover:underline">
                Create account
            </a>
        </p>

    </div>
</div>

<!-- Scripts -->
<script>

    let captchaValue = "";

    function togglePassword(e) {
        let input = document.getElementById('password');
        let btn = e.target;

        if (input.type === "password") {
            input.type = "text";
            btn.innerText = "🙈";
        } else {
            input.type = "password";
            btn.innerText = "👁";
        }
    }

    function generateCaptcha() {
        const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        let result = "";

        for (let i = 0; i < 5; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        captchaValue = result;
        document.getElementById('captchaBox').innerText = result;
    }

    function validateCaptcha() {
        let userInput = document.getElementById('captchaInput').value;

        if (userInput !== captchaValue) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Captcha',
                text: 'Please try again'
            });
            generateCaptcha();
            return false;
        }

        return true;
    }

    // Initial captcha
    generateCaptcha();

</script>

@endsection

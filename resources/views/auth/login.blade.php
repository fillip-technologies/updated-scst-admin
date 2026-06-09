@extends('layouts.login')

@section('content')
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
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <!-- RIGHT SIDE -->
        <div class="w-1/2 p-10">

            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-primary-800">
                    Secure Login
                </h2>
                <p class="text-sm text-gray-500">
                    Centralized School Monitoring System
                </p>
            </div>

            <!-- Tabs -->
            <div class="flex bg-gray-100 rounded-lg p-1 mb-6">
                <button type="button" onclick="switchTab('school')" id="schoolTab"
                    class="flex-1 py-2 rounded-md text-sm font-medium bg-white shadow text-primary-700">
                    School Level
                </button>

                <button type="button" onclick="switchTab('department')" id="departmentTab"
                    class="flex-1 py-2 rounded-md text-sm font-medium text-gray-600">
                    Department
                </button>
            </div>

            <!-- FORM -->
            <form action="{{ route('system.login') }}" method="POST" class="space-y-5" id="loginForm">
                @csrf

                <!-- ✅ Hidden Input -->
                <input type="hidden" name="login_type" id="loginType" value="school">

                <!-- School Field -->
                <div id="schoolField">
                    <input type="text" name="schoolCode" placeholder="School Code / UDISE" autocomplete="off"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
                </div>

                <!-- Department Field -->
                <div id="departmentField" class="hidden">
                    <input type="email" name="username" placeholder="Username" autocomplete="off"
                        class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
                </div>

                <!-- Password -->
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Password" autocomplete="off"
                        class="w-full border rounded-xl px-4 py-2 pr-10 focus:ring-2 focus:ring-primary-700">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-2 text-gray-400 text-sm">
                        👁
                    </button>
                </div>

                <!-- Captcha -->
                <div class="flex items-center gap-3">
                    <input type="hidden" name="captcha_code" id="captchaCode">
                    <input type="text" name="captcha" id="captchaInput" placeholder="Enter Captcha" autocomplete="off"
                        class="flex-1 border rounded-xl px-4 py-2">

                    <div id="captchaBox" class="px-4 py-2 bg-gray-200 rounded-md font-mono tracking-widest">

                    </div>

                    <button type="button" onclick="generateCaptcha()" class="text-gray-500">
                        ⟳
                    </button>
                </div>



                <button type="submit" class="w-full bg-primary-700 hover:bg-primary-800 text-white py-2 rounded-xl">
                    Access Dashboard →
                </button>

            </form>



        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsencrypt/3.3.2/jsencrypt.min.js"></script>
    <script>
        let currentTab;
        let captchaValue = '';

        function switchTab(tab) {
            currentTab = tab;
            document.getElementById('schoolField').classList.toggle('hidden', tab !== 'school');
            document.getElementById('departmentField').classList.toggle('hidden', tab !== 'department');
            document.getElementById('schoolTab').classList.toggle('bg-white', tab === 'school');
            document.getElementById('departmentTab').classList.toggle('bg-white', tab === 'department');
            document.getElementById('loginType').value = tab;
        }

        function togglePassword() {
            let input = document.getElementById('password');
            input.type = input.type === "password" ? "text" : "password";
        }

        function generateCaptcha() {
            const chars = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
            let result = "";

            for (let i = 0; i < 5; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            captchaValue = result;
            document.getElementById('captchaCode').value = result;
            document.getElementById('captchaBox').innerText = result;

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
        generateCaptcha();
    </script>
@endsection

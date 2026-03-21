@extends('layouts.login')

@section('content')

<div class="w-[1000px] bg-white rounded-2xl shadow-2xl overflow-hidden flex">

    <!-- LEFT PANEL (Same as Login) -->
    <div class="w-1/2 bg-primary-900 text-white flex flex-col justify-center items-center p-12">
        <h2 class="text-3xl font-semibold mb-4">
            SC / ST Welfare Portal
        </h2>
        <p class="text-gray-300 text-center text-sm">
            Register your institution to access centralized monitoring services.
        </p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="w-1/2 p-10">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-primary-800">
                    Create Account
                </h2>
                <p class="text-sm text-gray-500">
                    School Registration
                </p>
            </div>

            <a href="{{ route('login') }}"
                class="text-sm text-primary-700 font-medium hover:underline">
                Sign In
            </a>
        </div>

        <!-- Progress -->
        <div class="mb-8">
            <div class="w-full bg-gray-200 h-2 rounded-full">
                <div id="progressBar"
                    class="h-2 bg-primary-700 rounded-full transition-all duration-300"
                    style="width:25%"></div>
            </div>
        </div>

        <!-- Steps -->
        <div id="step1" class="space-y-4">
            <input placeholder="School Name"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
            <input placeholder="School Code / UDISE"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
        </div>

        <div id="step2" class="space-y-4 hidden">
            <input placeholder="Official Email"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
            <input placeholder="Contact Number"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
        </div>

        <div id="step3" class="space-y-4 hidden">
            <input type="password" placeholder="Create Password"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
            <input type="password" placeholder="Confirm Password"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-primary-700">
        </div>

        <div id="step4" class="space-y-4 hidden">
            <div class="bg-gray-50 p-6 rounded-xl text-sm text-gray-600">
                Review your information and submit registration.
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between mt-8">
            <button onclick="prevStep()" id="backBtn"
                class="px-4 py-2 border border-gray-300 rounded-lg hidden">
                Back
            </button>

            <button onclick="nextStep()"
                class="px-6 py-2 bg-primary-700 text-white rounded-xl hover:bg-primary-800">
                Continue
            </button>
        </div>

    </div>

</div>

<script>
    let step = 1;

    function updateUI() {
        for (let i = 1; i <= 4; i++) {
            document.getElementById('step' + i).classList.toggle('hidden', i !== step);
        }

        document.getElementById('progressBar').style.width = (step / 4 * 100) + '%';
        document.getElementById('backBtn').classList.toggle('hidden', step === 1);
    }

    function nextStep() {
        if (step < 4) step++;
        updateUI();
    }

    function prevStep() {
        if (step > 1) step--;
        updateUI();
    }

    updateUI();
</script>

@endsection
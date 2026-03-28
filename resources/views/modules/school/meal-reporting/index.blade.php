@extends('layouts.app')

@section('content')
 @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `
                <ul style="text-align:center;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `
            });
        </script>
    @endif

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
    <div class="p-8 bg-gray-100 min-h-screen">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Mid-Day Meal Reporting
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Update daily meal status, quality, and inventory.
                </p>
            </div>

            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-medium">
                ✔ Compliant Today
            </span>
        </div>


        <div class="grid lg:grid-cols-12 gap-6">

            <!-- LEFT SECTION -->
            <div class="lg:col-span-8 bg-white rounded-xl shadow-sm p-6">

                <h2 class="font-semibold text-gray-700 mb-6">
                    Today's Meal Entry
                </h2>

                <form action="{{ route('meal.report') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Hidden Fields -->
                    <input type="hidden" name="meal_type" id="meal_type" value="lunch">
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                     <input type="hidden" name="district" value="{{ SchoolLogin()->district }}">

                    <!-- Meal Time -->
                    <div class="grid grid-cols-3 gap-4 mb-6">

                        <button type="button" onclick="selectMeal(this,'breakfast')"
                            class="meal-btn border rounded-xl py-4 text-sm">
                            <p class="text-xs">BREAKFAST</p>
                            <p>7:30 AM</p>
                        </button>

                        <button type="button" onclick="selectMeal(this,'lunch')"
                            class="meal-btn border-2 border-primary-900 bg-primary-50 rounded-xl py-4 text-sm">
                            <p class="text-xs">LUNCH</p>
                            <p>12:30 PM</p>
                        </button>

                        <button type="button" onclick="selectMeal(this,'dinner')"
                            class="meal-btn border rounded-xl py-4 text-sm">
                            <p class="text-xs">DINNER</p>
                            <p>8:00 PM</p>
                        </button>

                    </div>

                    <!-- Menu -->
                    <div class="mb-6">
                        <label class="text-sm text-gray-600">Menu Served</label>
                        <input type="text" name="menu" class="mt-2 w-full border rounded-lg px-4 py-2"
                            placeholder="Rice, Dal, Mixed Veg, Salad">
                    </div>

                    <!-- Rating -->
                    <div class="mb-6">
                        <label class="text-sm text-gray-600">Food Quality Rating</label>

                        <div class="flex gap-2 mt-3 text-2xl text-gray-300 cursor-pointer" id="starBox">
                            <span onclick="rate(1)">★</span>
                            <span onclick="rate(2)">★</span>
                            <span onclick="rate(3)">★</span>
                            <span onclick="rate(4)">★</span>
                            <span onclick="rate(5)">★</span>
                        </div>
                    </div>

                    <!-- Upload -->
                    <div class="mb-6">
                        <label class="text-sm text-gray-600">Upload Meal Photo</label>

                        <input type="file" name="reportimage" id="photoInput" class="hidden">

                        <div onclick="document.getElementById('photoInput').click()"
                            class="mt-3 border-2 border-dashed rounded-xl h-40 flex items-center justify-center cursor-pointer text-gray-400">
                            Click to upload
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary-900 text-white px-6 py-2.5 rounded-lg text-sm">
                            Submit Report
                        </button>
                    </div>

                </form>
            </div>


            <!-- RIGHT SECTION -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Stock Status -->
                <div class="bg-white rounded-xl shadow-sm p-6">

                    <h2 class="font-semibold text-gray-700 mb-6">
                        Stock Status
                    </h2>

                    <div class="space-y-4 text-sm">

                        <div class="flex justify-between">
                            <div>
                                <p>Rice</p>
                                <span class="text-green-600 text-xs">Good</span>
                            </div>
                            <span>450 kg</span>
                        </div>

                        <div class="flex justify-between">
                            <div>
                                <p>Dal (Pulses)</p>
                                <span class="text-green-600 text-xs">Good</span>
                            </div>
                            <span>120 kg</span>
                        </div>

                        <div class="flex justify-between">
                            <div>
                                <p>Cooking Oil</p>
                                <span class="text-yellow-600 text-xs">Low</span>
                            </div>
                            <span>15 L</span>
                        </div>

                        <div class="flex justify-between">
                            <div>
                                <p>Spices</p>
                                <span class="text-red-600 text-xs">Critical</span>
                            </div>
                            <span>5 kg</span>
                        </div>

                    </div>

                    <button class="mt-6 text-primary-900 text-sm">
                        Request Stock Replenishment →
                    </button>

                </div>


                <!-- Inspection Alert -->
                <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-5 text-sm">

                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-circle-exclamation text-yellow-600 mt-1"></i>
                        <div>
                            <p class="font-medium text-yellow-800">
                                Inspection Alert
                            </p>
                            <p class="text-yellow-700 mt-1 text-xs">
                                District Food Safety Officer visit scheduled for
                                <strong>Monday, Oct 30.</strong> Ensure hygiene standards are met.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>



    <script>
        // function selectMeal(button) {
        //     document.querySelectorAll('.meal-btn').forEach(btn => {
        //         btn.classList.remove('border-2', 'border-primary-900', 'bg-primary-50', 'text-primary-900');
        //         btn.classList.add('border', 'text-gray-600');
        //     });

        //     button.classList.remove('border', 'text-gray-600');
        //     button.classList.add('border-2', 'border-primary-900', 'bg-primary-50', 'text-primary-900');
        // }

        // function rate(stars) {
        //     let allStars = document.querySelectorAll('.flex span');
        //     allStars.forEach((star, index) => {
        //         star.style.color = index < stars ? '#facc15' : '#d1d5db';
        //     });
        // }

        function selectMeal(el, type) {
            document.querySelectorAll('.meal-btn').forEach(btn => {
                btn.classList.remove('border-2', 'border-primary-900', 'bg-primary-50');
            });

            el.classList.add('border-2', 'border-primary-900', 'bg-primary-50');
            document.getElementById('meal_type').value = type;
        }

        function rate(val) {
            document.getElementById('rating').value = val;

            let stars = document.querySelectorAll('#starBox span');

            stars.forEach((star, index) => {
                if (index < val) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.add('text-gray-300');
                    star.classList.remove('text-yellow-400');
                }
            });
        }
    </script>
@endsection

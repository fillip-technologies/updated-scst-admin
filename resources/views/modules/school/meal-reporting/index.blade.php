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
                <div class="mb-3">
                    <label class="block text-sm mb-1">Report Type</label>
                    <select name="report_type" id="report_type"
                        class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="">Select Report Type</option>
                        @foreach (academicType() as $academic)
                        <option value="{{ $academic }}">{{ $academic }}</option>
                        @endforeach
                    </select>
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

                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-semibold text-gray-700">Stock Status</h2>

                    <button onclick="enableEdit()"
                        class="bg-pink-600 text-white text-xs px-4 
                        py-4 rounded-lg">
                        Edit
                    </button>
                </div>

                <div id="stockContainer" class="space-y-4 text-sm">

                    <!-- ITEM -->
                    <div class="flex justify-between stock-item">
                        <div>
                            <p>Rice</p>
                            <span class="text-green-600 text-xs">Good</span>
                        </div>

                        <div>
                            <span class="view-mode">450 kg</span>
                            <input type="number" value="450"
                                class="edit-mode hidden border rounded px-2 py-1 w-20">
                        </div>
                    </div>

                    <div class="flex justify-between stock-item">
                        <div>
                            <p>Dal (Pulses)</p>
                            <span class="text-green-600 text-xs">Good</span>
                        </div>

                        <div>
                            <span class="view-mode">120 kg</span>
                            <input type="number" value="120"
                                class="edit-mode hidden border rounded px-2 py-1 w-20">
                        </div>
                    </div>

                    <div class="flex justify-between stock-item">
                        <div>
                            <p>Cooking Oil</p>
                            <span class="text-yellow-600 text-xs">Low</span>
                        </div>

                        <div>
                            <span class="view-mode">15 L</span>
                            <input type="number" value="15"
                                class="edit-mode hidden border rounded px-2 py-1 w-20">
                        </div>
                    </div>

                    <div class="flex justify-between stock-item">
                        <div>
                            <p>Spices</p>
                            <span class="text-red-600 text-xs">Critical</span>
                        </div>

                        <div>
                            <span class="view-mode">5 kg</span>
                            <input type="number" value="5"
                                class="edit-mode hidden border rounded px-2 py-1 w-20">
                        </div>
                    </div>

                </div>

                <!-- ACTION BUTTONS -->
                <div class="mt-6 flex gap-2">
                    <button onclick="addItem()"
                        class="hidden bg-gray-600 text-white px-3 py-1 rounded text-xs"
                        id="addBtn">
                        + Add
                    </button>

                    <button onclick="saveStock()"
                        class="hidden bg-green-600 text-white px-3 py-1 rounded text-xs"
                        id="saveBtn">
                        Save
                    </button>
                </div>

            </div>

            <!-- Inspection Alert (UNCHANGED) -->
            <!-- <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-5 text-sm">
                <div class="flex gap-3 items-start">
                    <i class="fa-solid fa-circle-exclamation text-yellow-600 mt-1"></i>
                    <div>
                        <p class="font-medium text-yellow-800">Inspection Alert</p>
                        <p class="text-yellow-700 mt-1 text-xs">
                            District Food Safety Officer visit scheduled for
                            <strong>Monday, Oct 30.</strong> Ensure hygiene standards are met.
                        </p>
                    </div>
                </div>
            </div> -->

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

  
function enableEdit() {
    document.querySelectorAll(".view-mode").forEach(el => el.classList.add("hidden"));
    document.querySelectorAll(".edit-mode").forEach(el => el.classList.remove("hidden"));

    document.getElementById("saveBtn").classList.remove("hidden");
    document.getElementById("addBtn").classList.remove("hidden");
}

function saveStock() {
    document.querySelectorAll(".stock-item").forEach(item => {
        let input = item.querySelector("input");
        let span = item.querySelector(".view-mode");

        let unit = span.innerText.includes("L") ? " L" : " kg";
        span.innerText = input.value + unit;
    });

    document.querySelectorAll(".view-mode").forEach(el => el.classList.remove("hidden"));
    document.querySelectorAll(".edit-mode").forEach(el => el.classList.add("hidden"));

    document.getElementById("saveBtn").classList.add("hidden");
    document.getElementById("addBtn").classList.add("hidden");
}

function addItem() {
    let container = document.getElementById("stockContainer");

    let div = document.createElement("div");
    div.className = "flex justify-between stock-item";

    div.innerHTML = `
        <div>
            <input type="text" placeholder="Item name"
                class="border px-2 py-1 rounded text-xs">
            <span class="text-gray-500 text-xs">New</span>
        </div>

        <div>
            <span class="view-mode hidden">0 kg</span>
            <input type="number" value="0"
                class="edit-mode border rounded px-2 py-1 w-20">
        </div>
    `;

    container.appendChild(div);
}

</script>
@endsection
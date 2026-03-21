<div class="grid grid-cols-2 gap-6">

    <!-- School Logo Upload -->
    <div class="col-span-2">
        <label class="text-sm font-medium text-gray-700">
            School Logo
        </label>

        <div class="mt-2 flex items-center gap-6">

            <!-- Preview -->
            <div>
                <img id="logoPreview" src="{{ asset($editschl->school_logo ?? '') }}"
                    class="w-24 h-24 object-cover rounded-xl border border-gray-300 {{ $mode == 'edit' ? '' : 'hidden' }}">
            </div>

            <!-- Upload Box -->
            <label
                class="flex-1 cursor-pointer border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-600 transition">

                <input type="file" name="school_logo" accept="image/*" class="hidden" onchange="previewLogo(event)">
                <input type="hidden" name="old_file" value="{{ $editschl->school_logo ?? '' }}" >

                <div class="text-gray-500 text-sm">
                    <i class="fa-solid fa-upload mb-2 text-lg"></i>
                    <p>Click to upload logo</p>
                    <p class="text-xs mt-1">PNG, JPG up to 2MB</p>
                </div>
            </label>

        </div>
    </div>


    <!-- School Name -->
    <div class="col-span-2">
        <label class="text-sm font-medium text-gray-700">
            School Name <span class="text-red-500">*</span>
        </label>
        <input type="text" name="school_name" value="{{ old('school_name', $editschl->school_name ?? '') }}"
            placeholder="e.g. Dr. B.R. Ambedkar Residential School"
            class="mt-2 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-primary-600 focus:border-primary-600 outline-none">
    </div>

    <!-- School Code -->
    <div>
        <label class="text-sm font-medium text-gray-700">
            School Code <span class="text-red-500">*</span>
        </label>
        <input type="text" name="school_code" value="{{ old('school_code', $editschl->school_code ?? '') }}"
            placeholder="e.g. BR-PTN-001"
            class="mt-2 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-primary-600 focus:border-primary-600 outline-none">
    </div>

    <!-- Establishment Year -->
    <div>
        <label class="text-sm font-medium text-gray-700">
            Establishment Year
        </label>
        <input type="text" name="establishment_year"
            value="{{ old('establishment_year', $editschl->establishment_year ?? '') }}" placeholder="e.g. 2015"
            class="mt-2 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-primary-600 focus:border-primary-600 outline-none">
    </div>

    <!-- District -->
    <div>
        <label class="text-sm font-medium text-gray-700">
            District <span class="text-red-500">*</span>
        </label>
        <select name="district"
            class="mt-2 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm bg-white
                   focus:ring-2 focus:ring-primary-600 focus:border-primary-600 outline-none">
            <option selected>Select District</option>
            @foreach (districts() as $di)
                <option value="{{ $di }}" @selected(old('district', $editschl->district ?? '') === $di)>
                    {{ $di }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Block -->
    <div>
        <label class="text-sm font-medium text-gray-700">
            Block
        </label>
        <input type="text" name="block" value="{{ old('block', $editschl->block ?? '') }}"
            placeholder="Enter Block Name"
            class="mt-2 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm
                   focus:ring-2 focus:ring-primary-600 focus:border-primary-600 outline-none">
    </div>

    <!-- Category -->
    <div>
        <label class="text-sm font-medium text-gray-700">
            Category
        </label>
        <select name="category"
            class="mt-2 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm bg-white
                   focus:ring-2 focus:ring-primary-600 focus:border-primary-600 outline-none">
            <option selected>Select Category</option>
            @foreach (category() as $cat)
                <option value="{{ $cat }}" @selected(old('category', $editschl->category ?? '') === $cat)>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
    </div>

</div>


<script>
    function previewLogo(event) {
        const input = event.target;
        const preview = document.getElementById('logoPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

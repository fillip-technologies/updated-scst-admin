<div x-data="{
    form: {
        label: 'Facilities',
        title: 'Infrastructure for Holistic Student Growth',
        description: 'The school provides a structured environment with essential facilities that support academics, residential life, health, safety and all-round development.',
        feature1: 'Modern Classrooms',
        feature2: 'Science Laboratories',
        feature3: 'Computer Education',
        feature4: 'Residential Hostels',
        feature5: 'Nutritious Meals',
        feature6: 'Sports Facilities',
        feature7: 'Safe & Secure Campus',
        feature8: 'Health & Student Welfare',
    }
}" class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Infrastructure / Facilities Section</h2>
            <p class="mt-2 text-sm text-gray-500">
                Update the text content for the homepage infrastructure section. Images remain fixed in the design.
            </p>
        </div>

        <form class="p-6 sm:p-8" action="{{ route('infrastructure.save') }}" method="POST">
            @csrf
            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="infra_label" class="mb-2 block text-sm font-medium text-gray-700">Section Label</label>
                    <input  type="text" name="infra_label"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="infra_title" class="mb-2 block text-sm font-medium text-gray-700">Section Title</label>
                    <input id="infra_title"  type="text" name="infra_title"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="infra_description"
                        class="mb-2 block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="infra_description"  rows="5" name="infra_description"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                </div>

                <div class="md:col-span-2 rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500">Facility Features</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">

                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 1 Title
                            </label>
                            <input type="text" name="feature1"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 2 Title
                            </label>
                            <input type="text"  name="feature2"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 3 Title
                            </label>
                            <input type="text"  name="feature3"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 4 Title
                            </label>
                            <input type="text"  name="feature4"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 5 Title
                            </label>
                            <input type="text"  name="feature5"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 6 Title
                            </label>
                            <input type="text"  name="feature6"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 7 Title
                            </label>
                            <input type="text"  name="feature7"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <label for="feature" class="mb-2 block text-sm font-medium text-gray-700">
                                Feature 8 Title
                            </label>
                            <input type="text"  name="feature8"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end border-t border-primary-800/10 pt-6">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Save / Update
                </button>
            </div>
        </form>
    </div>

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Infrastructure section text preview.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Infrastructure</span>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">
            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80"
                    alt="Campus facility preview 1" class="h-32 w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=900&q=80"
                    alt="Campus facility preview 2" class="h-32 w-full object-cover">
            </div>
            <div class="col-span-2 overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=1200&q=80"
                    alt="Campus facility preview 3" class="h-40 w-full object-cover">
            </div>
        </div>

        <div class="mt-6 rounded-3xl border border-primary-800/10 bg-gray-50 p-5">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary-700" x-text="form.label"></p>
            <h3 class="mt-3 text-2xl font-semibold leading-tight text-gray-800" x-text="form.title"></h3>
            <p class="mt-4 text-sm leading-6 text-gray-500" x-text="form.description"></p>

            <div class="mt-6 grid grid-cols-1 gap-3">
                <template
                    x-for="(feature, index) in [form.feature1, form.feature2, form.feature3, form.feature4, form.feature5, form.feature6, form.feature7, form.feature8]"
                    :key="index">
                    <div
                        class="flex items-center gap-3 rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-primary-800/10">
                        <span
                            class="flex h-8 w-8 items-center justify-center rounded-full bg-primary-900 text-sm font-semibold text-white"
                            x-text="index + 1"></span>
                        <p class="text-sm font-medium text-gray-700" x-text="feature"></p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

@php
    print_r($compusdata);
@endphp

<div x-data="{
    form: {
        title: 'Campus Overview',
        paragraph1: 'The campus is designed to provide a balanced environment where students can grow academically, socially and personally within a secure residential setting.',
        paragraph2: 'Modern facilities, open spaces and structured student support systems help create a strong foundation for holistic development.',
        feature1Title: 'Spacious Campus',
        feature1Description: 'Well-planned academic and residential spaces that support learning and student life.',
        feature2Title: 'Residential Facility',
        feature2Description: 'Safe hostel accommodation with structured routines and supervised care for students.',
        feature3Title: 'Modern Labs',
        feature3Description: 'Dedicated laboratory spaces that encourage practical learning and scientific exploration.',
        feature4Title: 'Sports Facilities',
        feature4Description: 'Outdoor and indoor activity spaces that promote fitness, teamwork and discipline.',
        image: 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1200&q=80',
        fileName: '',
    },
    handleFileChange(event) {
        const file = event.target.files[0];
        if (!file) return;
        this.form.fileName = file.name;
        const reader = new FileReader();
        reader.onload = (e) => {
            this.form.image = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}" class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.15fr)_400px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Campus Overview Section</h2>
            <p class="mt-2 text-sm text-gray-500">
                Update the campus overview content, feature cards and supporting campus image.
            </p>
        </div>

        <form class="p-6 sm:p-8" action="{{ route('inf.save.campus') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="campus_overview_title" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Title</label>
                    <input id="campus_overview_title" name="campus_overview_title"
                        value="{{ old('campus_overview_title', $compusdata->campus_overview_title ?? '') }}"
                        type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="campus_paragraph_1" class="mb-2 block text-sm font-medium text-gray-700">Description
                        Paragraph 1</label>
                    <textarea id="campus_paragraph_1" name="campus_paragraph_1" rows="4"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('campus_paragraph_1', $compusdata->campus_paragraph_1 ?? '') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="campus_paragraph_2" class="mb-2 block text-sm font-medium text-gray-700">Description
                        Paragraph 2</label>
                    <textarea id="campus_paragraph_2" name="campus_paragraph_2" rows="4"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('campus_paragraph_2', $compusdata->campus_paragraph_2 ?? '') }}</textarea>
                </div>

                <div class="md:col-span-2 rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500">Feature Cards</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                        {{-- Feature 1 --}}
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <div>
                                <label for="campus_feature_1_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 1 Title</label>
                                <input id="campus_feature_1_title" name="feature_1_title" type="text" value="{{ old('feature_1_title',$compusdata->feature_1_title ?? "") }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="mt-4">
                                <label for="campus_feature_1_description"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 1 Description</label>
                                <textarea id="campus_feature_1_description" name="feature_1_description" rows="4"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('feature_1_description',$compusdata->feature_1_description ?? "") }}</textarea>
                            </div>
                        </div>

                        {{-- Feature 2 --}}
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <div>
                                <label for="campus_feature_2_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 2 Title</label>
                                <input id="campus_feature_2_title" name="feature_2_title" type="text" value="{{ old('feature_2_title',$compusdata->feature_2_title ?? "") }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="mt-4">
                                <label for="campus_feature_2_description"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 2 Description</label>
                                <textarea id="campus_feature_2_description" name="feature_2_description" rows="4"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('feature_2_description',$compusdata->feature_2_description ?? "") }}</textarea>
                            </div>
                        </div>

                        {{-- Feature 3 --}}
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <div>
                                <label for="campus_feature_3_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 3 Title</label>
                                <input id="campus_feature_3_title" name="feature_3_title" type="text" value="{{ old('feature_3_title',$compusdata->feature_3_title ?? "") }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="mt-4">
                                <label for="campus_feature_3_description"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 3 Description</label>
                                <textarea id="campus_feature_3_description" name="feature_3_description" rows="4"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('feature_3_description',$compusdata->feature_3_description ?? "") }}</textarea>
                            </div>
                        </div>

                        {{-- Feature 4 --}}
                        <div class="rounded-2xl border border-primary-800/10 bg-white p-4 shadow-sm">
                            <div>
                                <label for="campus_feature_4_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 4 Title</label>
                                <input id="campus_feature_4_title" name="feature_4_title" type="text" value="{{ old('') }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="mt-4">
                                <label for="campus_feature_4_description"
                                    class="mb-2 block text-sm font-medium text-gray-700">Feature 4 Description</label>
                                <textarea id="campus_feature_4_description" name="feature_4_description" rows="4"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="campus_overview_image" class="mb-2 block text-sm font-medium text-gray-700">Campus
                        Image</label>
                    <div
                        class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[240px_minmax(0,1fr)]">
                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img :src="form.image" alt="Campus overview preview"
                                    class="h-48 w-full object-cover">
                            </div>

                            <div class="flex flex-col justify-center">
                                <p class="text-sm font-medium text-gray-700">Image Preview</p>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Upload the campus image displayed alongside the campus overview content.
                                </p>

                                <input id="campus_overview_image" type="file" accept="image/*"
                                    name="campus_overview_image" @change="handleFileChange($event)"
                                    class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                                <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'">
                                </p>
                            </div>
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
                <p class="mt-1 text-sm text-gray-500">Campus overview section appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Campus Overview</span>
        </div>

        <div class="mt-6 rounded-3xl border border-primary-800/10 bg-gray-50 p-5">
            <h3 class="text-2xl font-semibold leading-tight text-gray-800" x-text="form.title"></h3>
            <p class="mt-4 text-sm leading-6 text-gray-500" x-text="form.paragraph1"></p>
            <p class="mt-4 text-sm leading-6 text-gray-500" x-text="form.paragraph2"></p>

            <div class="mt-6 grid grid-cols-1 gap-3">
                <template
                    x-for="(feature, index) in [
                    { title: form.feature1Title, description: form.feature1Description },
                    { title: form.feature2Title, description: form.feature2Description },
                    { title: form.feature3Title, description: form.feature3Description },
                    { title: form.feature4Title, description: form.feature4Description }
                ]"
                    :key="index">
                    <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-primary-800/10">
                        <h4 class="text-sm font-semibold text-gray-800" x-text="feature.title"></h4>
                        <p class="mt-2 text-sm leading-6 text-gray-500" x-text="feature.description"></p>
                    </div>
                </template>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm">
                <img :src="form.image" alt="Campus overview image" class="h-64 w-full object-cover">
            </div>
        </div>
    </div>
</div>

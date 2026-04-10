<div
    {{-- x-data="{
        form: {
            label: 'About the School',
            title: 'Dr. B.R. Ambedkar SC/ST Residential School, Patna',
            description: 'The school is committed to academic excellence, inclusive growth and holistic development for students through a structured residential learning environment.',
            bullet1: 'Safe residential campus with disciplined learning environment',
            bullet2: 'Experienced faculty focused on academic and personal growth',
            bullet3: 'Balanced approach across academics, sports and co-curricular activities',
            studentsCount: '650+',
            ratio: '25:1',
            passPercentage: '98%',
            image: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1200&q=80',
        }
    }" --}}
    class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">

    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">About Section</h2>
            <p class="mt-2 text-sm text-gray-500">
                Manage the homepage About section content, bullet highlights, statistics and campus image.
            </p>
        </div>

        <form class="p-6 sm:p-8" action="{{!empty($about) ?  route('about.update') :  route('about.save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="about_label" class="mb-2 block text-sm font-medium text-gray-700">Section Label</label>
                    <input
                        id="about_label"
                        type="text"
                        name="about_label"
                        readonly
                        value="{{ old('about_label',$about->about_label ?? '') }}"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="about_title" class="mb-2 block text-sm font-medium text-gray-700">Title</label>
                    <input
                        id="about_title"
                        value="{{ old('about_title',$about->about_title ?? '') }}"
                        type="text"
                        name="about_title"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="about_description" class="mb-2 block text-sm font-medium text-gray-700">Description <span class="font-normal text-xs text-red-400">(Max 40 Words or 300 character Allowed *)</span></label>
                    <textarea
                        id="about_description"
                        rows="5"
                        name="about_description"
                        maxlength="300"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('about_description',$about->about_description ?? '') }}</textarea>
                </div>

                <div class="md:col-span-2 rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500">Bullet Points <span class="font-normal text-xs text-red-400"> (Max 15 Words or 150 character Allowed *)</span></h3>
                    <div class="mt-4 grid grid-cols-1 gap-4">
                        <div>
                            <label for="about_bullet_1" class="mb-2 block text-sm font-medium text-gray-700">Bullet Point 1</label>
                            <input
                                id="about_bullet_1"
                                value="{{ old('about_bullate_1',$about->about_bullet_1 ?? '') }}"
                                type="text"
                                name="about_bullet_1"
                                maxlength="120"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div>
                            <label for="about_bullet_2" class="mb-2 block text-sm font-medium text-gray-700">Bullet Point 2</label>
                            <input
                                id="about_bullet_2"
                                value="{{ old('about_bullate_2',$about->about_bullet_2 ?? '') }}"
                                type="text"
                                name="about_bullet_2"
                                 maxlength="120"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div>
                            <label for="about_bullet_3" class="mb-2 block text-sm font-medium text-gray-700">Bullet Point 3</label>
                            <input
                                id="about_bullet_3"
                                value="{{ old('about_bullate_3',$about->about_bullet_3 ?? '') }}"
                                type="text"
                                name="about_bullet_3"
                                 maxlength="120"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                    <h3 class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500">Statistics</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label for="students_count" class="mb-2 block text-sm font-medium text-gray-700">Students Count</label>
                            <input
                                id="students_count"
                                value="{{ old('students_count',$about->students_count ?? '') }}"
                                type="text"
                                name="students_count"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div>
                            <label for="student_ratio" class="mb-2 block text-sm font-medium text-gray-700">Student-Teacher Ratio</label>
                            <input
                                id="student_ratio"
                                name="student_ratio"
                                value="{{ old('student_ratio',$about->student_ratio ?? '') }}"
                                type="text"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div>
                            <label for="pass_percentage" class="mb-2 block text-sm font-medium text-gray-700">Pass Percentage</label>
                            <input
                                id="pass_percentage"
                                value="{{ old('pass_percentage',$about->pass_percentage ?? '') }}"
                                type="text"
                                name="pass_percentage"
                                class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="about_image" class="mb-2 block text-sm font-medium text-gray-700">Campus Image Upload</label>
                    <div class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[240px_minmax(0,1fr)]">
                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img
                                    src="{{ asset($about->about_image ?? '')  }}"
                                    alt="Campus image preview"
                                    class="h-44 w-full object-cover">
                            </div>

                            <div class="flex flex-col justify-center">
                                <p class="text-sm font-medium text-gray-700">Image Preview</p>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Update the campus image used on the homepage About section.
                                </p>

                                <input
                                    id="about_image"
                                    x-model="form.image"
                                    type="file"
                                    name="about_image"
                                    placeholder="Paste image URL"
                                    class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end border-t border-primary-800/10 pt-6">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    {{ !empty($about) ? "Update" : "Save" }}
                </button>
            </div>
        </form>


    </div>

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Homepage About section appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">About</span>
        </div>

        <div class="mt-6 space-y-5">
            <div class="rounded-3xl border border-primary-800/10 bg-gray-50 p-5">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary-700">{{ $about->about_label ?? "" }}</p>
                <h3 class="mt-3 text-2xl font-semibold leading-tight text-gray-800">{{ $about->about_title  ?? ''}}</h3>
                <p class="mt-4 text-sm leading-6 text-gray-500">{{ $about->about_description ?? ''}}</p>

                <div class="mt-5 space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="mt-1 h-2.5 w-2.5 rounded-full bg-accent-500"></span>
                        <p class="text-sm leading-6 text-gray-600">{{ $about->about_bullet_1 ?? ''}}</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="mt-1 h-2.5 w-2.5 rounded-full bg-accent-500"></span>
                        <p class="text-sm leading-6 text-gray-600">{{ $about->about_bullet_2 ?? '' }}</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="mt-1 h-2.5 w-2.5 rounded-full bg-accent-500"></span>
                        <p class="text-sm leading-6 text-gray-600">{{ $about->about_bullet_3 ?? ''}}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="rounded-2xl bg-primary-900 p-4 text-white shadow-sm">
                    <p class="text-xs uppercase tracking-[0.18em] text-gray-200">Students</p>
                    <p class="mt-2 text-2xl font-semibold">{{ $about->students_count ?? "" }}</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-primary-800/10">
                    <p class="text-xs uppercase tracking-[0.18em] text-gray-500">Ratio</p>
                    <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $about->student_ratio ?? "" }}</p>
                </div>
                <div class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-primary-800/10">
                    <p class="text-xs uppercase tracking-[0.18em] text-gray-500">Pass %</p>
                    <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $about->pass_percentage ?? '' }}</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm">
                <img
                    src="{{ asset($about->about_image ?? "") }}"
                    alt="Campus preview"
                    class="h-64 w-full object-cover">
            </div>
        </div>
    </div>
</div>
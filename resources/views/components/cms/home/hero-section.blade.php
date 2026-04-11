@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let errorMessages = `
                    <ul style="text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">• {{ $error }}</li>
                        @endforeach
                    </ul>
                `;

        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: errorMessages,
            confirmButtonColor: '#d33'
        });
    });
</script>
@endif

<div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Edit Hero Section</h2>
            <p class="mt-2 text-sm text-gray-500">
                Update the content and image used in the homepage hero section.
            </p>
        </div>

        <form class="p-6 sm:p-8" action="{{!empty($home) ? route('hero.update') : route('hero.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="school_id" value="{{SchoolLogin()->id}}">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="hero_background" class="mb-2 block text-sm font-medium text-gray-700">
                        Hero Background Image
                    </label>

                    <div class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[260px_minmax(0,1fr)]">
                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img
                                    src="{{ asset($home->bgimage ?? "") }}"
                                    alt="Hero background preview"
                                    class="h-48 w-full object-cover">
                            </div>

                            <div class="flex flex-col justify-center">
                                <p class="text-sm font-medium text-gray-700">Image Preview</p>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Upload a wide hero banner image for the homepage.
                                </p>

                                <input
                                    id="hero_background"
                                    type="file"
                                    accept="image/*"

                                    name="bgimage"
                                    class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="badge_text" class="mb-2 block text-sm font-medium text-gray-700">Category Badge Text</label>
                    <input
                        id="badge_text"
                        type="text"
                        name="badge_text"
                        value="{{ old('badge_text',$home->badge_text ?? "") }}"
                        placeholder="Residential • SC/ST Welfare"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="rating_value" class="mb-2 block text-sm font-medium text-gray-700">Rating Value</label>
                    <input
                        id="rating_value"
                        type="text"
                        name="rating_value"
                        value="{{ old('rating_value',$home->rating_value ?? "") }}"
                        placeholder="4.6"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>
                </div>

                <div class="md:col-span-2">
                    <label for="school_title" class="mb-2 block text-sm font-medium text-gray-700">School Title</label>
                    <input
                        id="school_title"
                        type="text"
                        name="school_title"
                        value="{{ old('school_title',$home->school_title ?? "") }}"
                        placeholder="Dr. B.R. Ambedkar Residential School"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="location_text" class="mb-2 block text-sm font-medium text-gray-700">Location Text</label>
                    <input
                        id="location_text"
                        type="text"
                        name="location_text"
                        value="{{ old('location_text',$home->location_text ?? "") }}"
                        placeholder="Patna, Bihar"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="students_count" class="mb-2 block text-sm font-medium text-gray-700">Students Count</label>
                    <input
                        id="students_count"
                        type="text"
                        name="students_count"
                        value="{{ old('students_count',$home->students_count ?? "") }}"
                        placeholder="650 Students"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="class_range" class="mb-2 block text-sm font-medium text-gray-700">Class Range</label>
                    <input
                        id="class_range"
                        type="text"
                        name="class_range"
                        value="{{ old('class_range',$home->class_range ?? "") }}"
                        placeholder="Class 6 - 12"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="back_button_text" class="mb-2 block text-sm font-medium text-gray-700">Back Button Text</label>
                    <input
                        id="back_button_text"
                        type="text"
                        value="{{ old('back_button_text',$home->back_button_text ?? "") }}"
                        name="back_button_text"
                        placeholder="Back to Schools"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>
            </div>

            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-primary-800/10 pt-6 sm:flex-row sm:justify-end">
                <a href="{{ route('school.website-cms') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-5 py-3 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    {{ !empty($home) ? "Update" : "Save" }}

                </button>
            </div>
        </form>

    </div>

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Hero section layout preview.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Homepage</span>
        </div>

        <div class="mt-6 overflow-hidden rounded-3xl bg-primary-900 shadow-sm">
            <div class="relative min-h-[520px]">
                <img
                    src="{{ asset($home->bgimage ?? "" ) }}
                    alt="Homepage hero preview"
                    class="absolute inset-0 h-full w-full object-cover opacity-35">
                <div class="absolute inset-0 bg-gradient-to-t from-primary-900 via-primary-900/85 to-primary-800/40"></div>

                <div class="relative flex h-full min-h-[520px] flex-col justify-end p-6 text-white">
                    <div class="inline-flex w-fit items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-accent-500"></span>
                        {{ $home->badge_text ?? "" }}
                    </div>

                    <div class="mt-5 inline-flex w-fit items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm backdrop-blur-sm">
                        <i class="fa-solid fa-star text-accent-500"></i>
                        {{ $home->rating_value ?? ""}}
                    </div>

                    <h3 class="mt-6 text-3xl font-semibold leading-tight">
                        {{$home->school_title ?? ""}}
                    </h3>

                    <div class="mt-5 space-y-3 text-sm text-gray-100">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-location-dot text-accent-500"></i>
                            <span>{{ $home->location_text ?? ""}}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-user-group text-accent-500"></i>
                            <span>{{ $home->students_count ?? ""}}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-book-open text-accent-500"></i>
                            <span>{{ $home->class_range  ?? ""}}</span>
                        </div>
                    </div>

                    <button type="button"
                        class="mt-8 inline-flex w-fit items-center gap-2 rounded-xl border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-white/20">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        {{ $home->back_button_text ?? "" }}
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-primary-800/10 bg-primary-900/5 p-4">
            <p class="text-sm font-medium text-gray-700">CMS Note</p>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                Use this page only for homepage hero content management. Other homepage sections should be handled in their own CMS panes.
            </p>
        </div>
    </div>
</div>

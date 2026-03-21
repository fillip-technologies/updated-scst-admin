<div
    x-data="{
        form: {
            image: 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1400&q=80',
            fileName: '',
            title: 'Infrastructure for Holistic Student Growth',
            subtitle: 'Explore the facilities, learning spaces and residential environment that support student development across academics, health and co-curricular life.',
            breadcrumb: 'Infrastructure',
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
    }"
    class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.15fr)_400px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Hero Section</h2>
            <p class="mt-2 text-sm text-gray-500">
                Update the infrastructure page hero banner and supporting text content.
            </p>
        </div>

        <form class="p-6 sm:p-8" action="{{ route('inf.save.hero') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="infra_hero_image" class="mb-2 block text-sm font-medium text-gray-700">
                        Hero Background Image
                    </label>

                    <div class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[240px_minmax(0,1fr)]">
                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img
                                    :src="form.image"
                                    alt="Infrastructure hero preview"
                                    class="h-48 w-full object-cover">
                            </div>

                            <div class="flex flex-col justify-center">
                                <p class="text-sm font-medium text-gray-700">Image Preview</p>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Upload a wide hero image for the infrastructure page.
                                </p>

                                <input
                                    id="infra_hero_image"
                                    type="file"
                                    accept="image/*"
                                    name="infra_hero_image"
                                    @change="handleFileChange($event)"
                                    class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                                <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="infra_hero_title" class="mb-2 block text-sm font-medium text-gray-700">Hero Title</label>
                    <input
                        id="infra_hero_title"

                        name="infra_hero_title"
                        type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div class="md:col-span-2">
                    <label for="infra_hero_subtitle" class="mb-2 block text-sm font-medium text-gray-700">Hero Subtitle / Description</label>
                    <textarea
                        id="infra_hero_subtitle"

                        rows="5"
                        name="infra_hero_subtitle"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                </div>

                <div>
                    <label for="infra_breadcrumb" class="mb-2 block text-sm font-medium text-gray-700">Breadcrumb Title</label>
                    <input
                        id="infra_breadcrumb"
                       
                        type="text"
                        name="infra_breadcrumb"
                        placeholder="Infrastructure"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
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
                <p class="mt-1 text-sm text-gray-500">Infrastructure page hero appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Hero</span>
        </div>

        <div class="mt-6 overflow-hidden rounded-3xl bg-primary-900 shadow-sm">
            <div class="relative min-h-[500px]">
                <img
                    :src="form.image"
                    alt="Infrastructure hero preview"
                    class="absolute inset-0 h-full w-full object-cover opacity-35">
                <div class="absolute inset-0 bg-gradient-to-t from-primary-900 via-primary-900/85 to-primary-800/40"></div>

                <div class="relative flex h-full min-h-[500px] flex-col justify-end p-6 text-white">
                    <div class="inline-flex w-fit items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm backdrop-blur-sm">
                        <i class="fa-solid fa-chevron-right text-xs text-accent-500"></i>
                        <span x-text="form.breadcrumb || 'Infrastructure'"></span>
                    </div>

                    <h3 class="mt-6 text-3xl font-semibold leading-tight" x-text="form.title"></h3>
                    <p class="mt-4 max-w-xl text-sm leading-6 text-gray-100" x-text="form.subtitle"></p>
                </div>
            </div>
        </div>
    </div>
</div>

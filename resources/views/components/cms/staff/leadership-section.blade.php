
<div {{-- x-data="{
        form: {
            image: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=900&q=80',
            fileName: '',
            name: 'Dr. Anil Kumar',
            designation: 'Principal',
            bio: 'Dr. Anil Kumar leads the institution with a focus on academic excellence, student welfare and inclusive residential education.',
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
    }" --}} class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.15fr)_400px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <h2 class="text-xl font-semibold text-gray-800">Leadership Section</h2>
            <p class="mt-2 text-sm text-gray-500">
                Update the leadership profile shown on the staff page.
            </p>
        </div>

        <form class="p-6 sm:p-8"
            action="{{ isset($leaders) ? route('staff.update.leader') : route('staff.save.leader') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="leader_image" class="mb-2 block text-sm font-medium text-gray-700">Leader Image</label>
                    <div
                        class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-[220px_minmax(0,1fr)]">
                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img src="{{ asset($leaders->leader_image ?? '') }}" alt="Leader preview"
                                    class="h-48 w-full object-cover">
                            </div>

                            <div class="flex flex-col justify-center">
                                <p class="text-sm font-medium text-gray-700">Image Preview</p>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Upload the leadership profile image from your computer.
                                </p>
                                <input type="hidden" name="old_image" value="{{ $leaders->leader_image }}">
                                <input id="leader_image" type="file" accept="image/*" name="leader_image"
                                    @change="handleFileChange($event)"
                                    class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                                <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="leader_name" class="mb-2 block text-sm font-medium text-gray-700">Leader Name</label>
                    <input id="leader_name" name="leader_name" value="{{ $leaders->leader_name ?? '' }}" type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="leader_designation"
                        class="mb-2 block text-sm font-medium text-gray-700">Designation</label>
                    <input id="leader_designation" name="leader_designation"
                        value="{{ $leaders->leader_designation ?? '' }}" type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="leader_bio" class="mb-2 block text-sm font-medium text-gray-700">Description /
                        Bio</label>
                    <textarea id="leader_bio" name="leader_bio" rows="6"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ $leaders->leader_bio ?? '' }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end border-t border-primary-800/10 pt-6">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    {{ isset($leaders) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Leadership profile appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Leadership</span>
        </div>

        <div class="mt-6 rounded-3xl border border-primary-800/10 bg-gray-50 p-6 text-center">
            <div class="mx-auto h-28 w-28 overflow-hidden rounded-full ring-4 ring-primary-900/10">
                <img src="{{ asset($leaders->leader_image ?? '') }}" alt="Leadership preview"
                    class="h-full w-full object-cover">
            </div>
            <h3 class="mt-5 text-2xl font-semibold text-gray-800">{{ $leaders->leader_name ?? '' }}</h3>
            <p class="mt-2 text-sm font-medium text-primary-900">{{ $leaders->leader_designation ?? '' }}</p>
            <p class="mt-4 text-sm leading-6 text-gray-500">{{ $leaders->leader_bio ?? '' }}</p>
        </div>
    </div>
</div>

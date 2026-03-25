<div x-data="alumniData()" x-init="init()" class="relative space-y-8">

    <!-- Main Card Wrapper -->
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div
            class="flex flex-col gap-4 border-b border-primary-800/10 px-6 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Alumni Section</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Manage homepage alumni cards with a simple add, edit and delete workflow.
                </p>
            </div>

            <button type="button" @click.prevent.stop="openCreate()"
                class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Alumni
            </button>
        </div>

        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-6">
                <!-- Section Title -->
                <div>
                    <label for="alumni_section_title" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Title</label>
                    <input id="alumni_section_title" x-model="sectionTitle" type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <!-- Section Description -->
                <div>
                    <label for="alumni_section_description" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Description</label>
                    <textarea id="alumni_section_description" x-model="sectionDescription" rows="4"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                </div>

                <!-- Existing Alumni Cards -->
                <div class="border-t border-primary-800/10 pt-8">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Existing Alumni Cards</h3>
                            <p class="mt-1 text-sm text-gray-500">Preview and manage all homepage alumni cards.</p>
                        </div>
                        <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900"
                            x-text="`${alumni.length} Alumni`"></span>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <template x-for="(item, index) in alumni" :key="`${item.alumni_name}-${index}`">
                            <div
                                class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                                <div class="flex flex-col items-center p-6 text-center">
                                    <div class="h-24 w-24 overflow-hidden rounded-full ring-4 ring-primary-900/10">
                                        <img :src="'/' + item.alumni_photo" :alt="item.alumni_name"
                                            class="h-full w-full object-cover">
                                    </div>

                                    <h3 class="mt-4 text-lg font-semibold text-gray-800" x-text="item.alumni_name"></h3>
                                    <p class="mt-2 text-sm leading-6 text-gray-500" x-text="item.alumni_details"></p>

                                    <div class="mt-5 flex items-center gap-3">
                                        <button type="button" @click="openEdit(index)"
                                            class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                            <i class="fa-solid fa-pen text-[10px]"></i>
                                            Edit
                                        </button>
                                        <form action="{{ route('alumni.delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                             <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                                             <input type="hidden" name="index" :value="index">
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-medium text-red-500 transition hover:bg-red-50">
                                                <i class="fa-solid fa-trash text-[10px]"></i>
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <!-- Add/Edit Modal -->
    <div x-show="editorOpen" x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 flex items-center justify-center bg-primary-900/40 p-4" style="display: none;"
        @click.self="editorOpen = false">
        <div class="w-full max-w-4xl rounded-3xl border border-primary-800/10 bg-white shadow-2xl">
            <div class="flex items-start justify-between border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800"
                        x-text="editingIndex === null ? 'Add Alumni' : 'Edit Alumni'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Upload an alumni photo and update the card details.
                    </p>
                </div>

                <button type="button" @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form :action="editingIndex === null ? '{{ route('alumni.save') }}' : '{{ route('alumni.update') }}'"
                method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                <input type="hidden" name="index" :value="editingIndex">

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">
                        <!-- Photo Upload -->
                        <div
                            class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                            <label for="alumni_photo" class="mb-2 block text-sm font-medium text-gray-700">Alumni Photo
                                Upload</label>
                            <input id="alumni_photo" type="file" name="alumni_photo" accept="image/*"
                                @change="handleFileChange($event)"
                                class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                            <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>

                            <div class="mt-4 flex justify-center">
                                <div class="h-32 w-32 overflow-hidden rounded-full ring-4 ring-primary-900/10">
                                    <img :src="form.photo ? '/' + form.photo :
                                        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=900&q=80'"
                                        alt="Alumni preview" class="h-full w-full object-cover">
                                </div>
                            </div>
                        </div>

                        <!-- Name & Details -->
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label for="alumni_name" class="mb-2 block text-sm font-medium text-gray-700">Alumni
                                    Name</label>
                                <input id="alumni_name" type="text" name="alumni_name" x-model="form.name"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="alumni_details" class="mb-2 block text-sm font-medium text-gray-700">Alumni
                                    Details</label>
                                <textarea id="alumni_details" rows="5" name="alumni_details" x-model="form.details"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                                <button type="button" @click="editorOpen = false"
                                    class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-4 py-2.5 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    Cancel
                                </button>

                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>

<script>
    function alumniData() {
        return {
            sectionTitle: 'Our Alumni',
            sectionDescription: 'Showcase notable alumni and their journeys on the homepage.',
            alumni: [], // start empty
            editorOpen: false,
            editingIndex: null,
            form: {
                photo: '',
                fileName: '',
                name: '',
                details: ''
            },

            openCreate() {
                this.editingIndex = null;
                this.form = {
                    photo: '',
                    fileName: '',
                    name: '',
                    details: ''
                };
                this.editorOpen = true;
            },

            openEdit(index) {
                this.editingIndex = index;
                this.form = {
                    photo: this.alumni[index].alumni_photo,
                    name: this.alumni[index].alumni_name,
                    details: this.alumni[index].alumni_details,
                    fileName: ''
                };
                this.editorOpen = true;
            },

            handleFileChange(event) {
                const file = event.target.files[0];
                if (!file) return;
                this.form.fileName = file.name;
                const reader = new FileReader();
                reader.onload = (e) => this.form.photo = e.target.result;
                reader.readAsDataURL(file);
            },

            saveAlumni() {
                const payload = {
                    alumni_name: this.form.name,
                    alumni_photo: this.form.photo,
                    alumni_details: this.form.details
                };

                if (this.editingIndex === null) {
                    this.alumni.push(payload);
                } else {
                    this.alumni[this.editingIndex] = payload;
                }

                this.editorOpen = false;
            },

            deleteAlumni(index) {
                this.alumni.splice(index, 1);
                if (this.editingIndex === index) this.editorOpen = false;
            },

            init() {
                try {

                    this.alumni = @json($alumnis ?? '[]');
                } catch (e) {
                    console.error('Alumni JSON parse error', e);
                    this.alumni = [];
                }
            }
        }
    }
</script>

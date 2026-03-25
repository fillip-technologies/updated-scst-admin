<div x-data='{
    activities: @json($activities ?? []),

    editorOpen: false,
    editingIndex: null,

    form: {
        title: "",
        image: "",
        fileName: ""
    },

    openCreate() {
        this.editingIndex = null;
        this.form = { title: "", image: "", fileName: "" };
        this.editorOpen = true;
    },

    openEdit(index) {
        this.editingIndex = index;
        this.form = { ...this.activities[index], fileName: "" };
        this.editorOpen = true;
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
    },

    saveActivity() {
        if (!this.form.title) return;

        if (this.editingIndex === null) {
            this.activities.push({
                title: this.form.title,
                image: this.form.image,
            });
        } else {
            this.activities[this.editingIndex] = {
                title: this.form.title,
                image: this.form.image,
            };
        }

        this.editorOpen = false;
    },

    deleteActivity(index) {
        this.activities.splice(index, 1);

        if (this.editingIndex === index) {
            this.editorOpen = false;
        }
    }
}'
    class="relative space-y-8">

    <!-- HEADER -->
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="flex justify-between px-6 py-5 sm:px-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">School Activities Section</h2>
            </div>

            <button @click="openCreate()" class="bg-primary-900 text-white px-4 py-2 rounded-xl">
                Add Activity
            </button>
        </div>

        <!-- GRID -->
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

                <template x-for="(activity, index) in activities" :key="index">

                    <div
                        class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                        <div class="relative overflow-hidden">
                            <img :src="'/' + activity.image"
                                class="h-56 w-full object-cover transition duration-300 group-hover:scale-105">
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800" x-text="activity.title"></h3>

                            <div class="mt-5 flex items-center gap-3">
                                <button @click="openEdit(index)"
                                    class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 px-3 py-2 text-xs">
                                    Edit
                                </button>

                                <form method="POST" action="{{ route('activites.delete') }}">
                                    @csrf
                                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                                    <input type="hidden" name="index" :value="index">

                                    <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs text-red-500">
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

    <!-- MODAL -->
    <div x-show="editorOpen" class="fixed inset-0 flex items-center justify-center bg-black/40"
        @click.self="editorOpen=false">

        <div class="bg-white p-6 rounded-2xl w-full max-w-xl">

            <h3 class="text-lg font-semibold mb-4" x-text="editingIndex === null ? 'Add Activity' : 'Edit Activity'">
            </h3>

            <form
                :action="editingIndex === null ?
                    '{{ route('activites.save') }}' :
                    '{{ route('activites.update') }}'"
                method="POST" enctype="multipart/form-data" @submit.prevent="saveActivity(); $el.submit();">
                @csrf

                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                <input type="hidden" name="editing_index" :value="editingIndex">

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">

                        <!-- IMAGE -->
                        <div class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5">

                            <input type="file" name="activity_image" accept="image/*"
                                @change="handleFileChange($event)" class="mt-4 block w-full">

                            <p class="text-xs mt-2" x-text="form.fileName || 'No file selected'"></p>

                            <img :src="form.image ?
                                (form.image.startsWith('data:') ?
                                    form.image :
                                    '/' + form.image) :
                                'https://images.unsplash.com/photo-1497633762265-9d179a990aa6'"
                                class="h-40 w-full object-cover mt-3">

                        </div>

                        <!-- TITLE -->
                        <div>
                            <input type="text" name="activity_title" x-model="form.title"
                                placeholder="Activity Title" class="w-full border px-4 py-2 rounded-lg">

                            <div class="flex justify-end gap-2 mt-4">
                                <button type="button" @click="editorOpen=false" class="border px-4 py-2 rounded-lg">
                                    Cancel
                                </button>

                                <button type="submit" class="bg-primary-900 text-white px-4 py-2 rounded-lg">
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



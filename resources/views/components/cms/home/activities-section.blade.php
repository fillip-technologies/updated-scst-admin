<div x-data="{
    activities: [{
            title: 'Cultural Activities',
            image: 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=900&q=80',
        },
        {
            title: 'Classroom Learning',
            image: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
        },
        {
            title: 'Residential & Hostel Life',
            image: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=900&q=80',
        },
        {
            title: 'Sports & Physical Training',
            image: 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=80',
        },
        {
            title: 'NCC & Leadership Training',
            image: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80',
        }
    ],
    editorOpen: false,
    editingIndex: null,
    form: {
        title: '',
        image: '',
        fileName: ''
    },
    openCreate() {
        this.editingIndex = null;
        this.form = { title: '', image: '', fileName: '' };
        this.editorOpen = true;
    },
    openEdit(index) {
        this.editingIndex = index;
        this.form = { ...this.activities[index], fileName: '' };
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
}" class="relative space-y-8">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div
            class="flex flex-col gap-4 border-b border-primary-800/10 px-6 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">School Activities Section</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Manage homepage activity cards with a simple add, edit and delete workflow.
                </p>
            </div>

            <button type="button" @click.prevent.stop="openCreate()"
                class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Activity
            </button>
        </div>

        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                <template x-for="(activity, index) in activities" :key="`${activity.title}-${index}`">
                    <div
                        class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative overflow-hidden">
                            <img :src="activity.image" :alt="activity.title"
                                class="h-56 w-full object-cover transition duration-300 group-hover:scale-105">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-900/70 via-primary-900/15 to-transparent">
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800" x-text="activity.title"></h3>

                            <div class="mt-5 flex items-center gap-3">
                                <button type="button" @click="openEdit(index)"
                                    class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    <i class="fa-solid fa-pen text-[10px]"></i>
                                    Edit
                                </button>

                                <button type="button" @click="deleteActivity(index)"
                                    class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-medium text-red-500 transition hover:bg-red-50">
                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div x-show="editorOpen" x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 flex items-center justify-center bg-primary-900/40 p-4" style="display: none;"
        @click.self="editorOpen = false">
        <div class="w-full max-w-3xl rounded-3xl border border-primary-800/10 bg-white shadow-2xl">
            <div class="flex items-start justify-between border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800"
                        x-text="editingIndex === null ? 'Add Activity' : 'Edit Activity'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Upload an activity image and update the title using this simple editor.
                    </p>
                </div>

                <button type="button" @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('activites.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">
                        <div
                            class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                            <label for="activity_image" class="mb-2 block text-sm font-medium text-gray-700">Activity
                                Image Upload</label>

                            <input id="activity_image" type="file" accept="image/*" name="activity_image"
                                @change="handleFileChange($event)"
                                class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                            <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>

                            <div
                                class="mt-4 overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img :src="form.image ||
                                    'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=900&q=80'"
                                    alt="Activity preview" class="h-52 w-full object-cover">
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="activity_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Activity Title</label>
                                <input id="activity_title" name="activity_title" type="text"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                                <button type="button" @click="editorOpen = false"
                                    class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-4 py-2.5 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    Cancel
                                </button>

                                <button type="submit" @click="saveActivity()"
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

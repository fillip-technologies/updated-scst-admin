<div x-data="quizComponent()" class="relative space-y-8">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div
            class="flex flex-col gap-4 border-b border-primary-800/10 px-6 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">School Quiz Competitions</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Manage homepage quiz competition cards with a simple add, edit and delete workflow.
                </p>
            </div>

            <button type="button" @click.prevent.stop="openCreate()"
                class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Quiz
            </button>
        </div>

        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="quiz_section_title" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Title</label>
                    <input id="quiz_section_title" type="text" value="School Quiz" readonly
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="quiz_section_description" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Description</label>
                    <textarea id="quiz_section_description" rows="4"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20" readonly>Test your knowledge and challenge your classmates in a fun and interactive school quiz!</textarea>
                </div>

                <div class="border-t border-primary-800/10 pt-8">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Existing Quiz Cards</h3>
                            <p class="mt-1 text-sm text-gray-500">Preview and manage all quiz competition cards.</p>
                        </div>
                        <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900"
                            x-text="`${quizzes.length} Quizzes`"></span>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

                        <template x-for="(items, key) in quizzes" :key="key">
                            <div
                                class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                                <div class="relative overflow-hidden">
                                    <!-- Image -->
                                    <img :src="items.quiz_image.startsWith('data:') ? items.quiz_image : '/' + items.quiz_image"
                                        :alt="items.quiz_title"
                                        class="h-56 w-full object-cover transition duration-300 group-hover:scale-105">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary-900/70 via-primary-900/15 to-transparent">
                                    </div>

                                    <!-- Status Badge -->
                                    <span
                                        class="absolute left-4 top-4 rounded-full px-3 py-1 text-xs font-semibold shadow-sm"
                                        :class="{
                                            'bg-accent-500 text-black': items.quiz_status === 'Ongoing',
                                            'bg-white text-primary-900': items.quiz_status === 'Upcoming',
                                            'bg-primary-900 text-white': items.quiz_status === 'Completed'
                                        }"
                                        x-text="items.quiz_status">
                                    </span>
                                </div>

                                <div class="p-5">
                                    <!-- Title -->
                                    <h3 class="text-lg font-semibold text-gray-800" x-text="items.quiz_title"></h3>

                                    <!-- Description -->
                                    <p class="mt-2 text-sm leading-6 text-gray-500" x-text="items.quiz_description"></p>

                                    <!-- Button Text -->
                                    <div class="mt-4 inline-flex rounded-lg bg-primary-900/5 px-3 py-2 text-xs font-medium text-primary-900"
                                        x-text="items.quiz_button_text">
                                    </div>

                                    <!-- Edit / Delete Buttons -->
                                    <div class="mt-5 flex items-center gap-3">
                                        <button type="button" @click="openEdit(key)"
                                            class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                            <i class="fa-solid fa-pen text-[10px]"></i> Edit
                                        </button>
                                        <form method="POST" action="{{ route('quize.delete') }}">
                                                @csrf
                                                @method('DELETE')
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
        </div>
    </div>

    <div x-show="editorOpen" x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 flex items-center justify-center bg-primary-900/40 p-4"
        @click.self="editorOpen = false" style="display: none;">
        <div class="w-full max-w-4xl rounded-3xl border border-primary-800/10 bg-white shadow-2xl">
            <div class="flex items-start justify-between border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800"
                        x-text="editingIndex === null ? 'Add Quiz' : 'Edit Quiz'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Upload a quiz banner image and update the quiz card content.
                    </p>
                </div>

                <button type="button" @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>


            <!-------- edit ------>
            <form x-ref="quizForm"
                :action="editingIndex === null ?
                    '{{ route('quiz.save') }}' :
                    '{{ route('quize.update') }}'"
                method="POST" enctype="multipart/form-data">
                @csrf

                <!-- PUT method for update -->
                {{-- <template x-if="editingIndex !== null">
                    <input type="hidden" name="_method" value="POST">
                </template> --}}

                <!-- Hidden fields -->
                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                <input type="hidden" name="quiz_index" :value="editingIndex">

                <!-- Send existing image path so backend can keep it if no new file -->
                <input type="hidden" name="old_quiz_image" :value="form.quiz_image">

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">

                        <!-- IMAGE -->
                        <div class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5">
                            <label class="mb-2 block text-sm font-medium text-gray-700">
                                Quiz Banner Image Upload
                            </label>

                            <input type="file" name="quiz_image" accept="image/*" @change="handleFileChange($event)"
                                class="mt-4 block w-full rounded-xl border px-4 py-3 text-sm">

                            <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>

                            <div class="mt-4 overflow-hidden rounded-2xl border bg-white">
                                <img :src="form.image ? form.image : (form.quiz_image ? '/' + form.quiz_image :
                                    'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=900&q=80'
                                    )"
                                    class="h-52 w-full object-cover">
                            </div>
                        </div>

                        <!-- FORM FIELDS -->
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <!-- STATUS -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Status</label>
                                <select name="quiz_status" x-model="form.quiz_status"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                                    <option value="">Select Status</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Upcoming">Upcoming</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>

                            <!-- BUTTON TEXT -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Button Text</label>
                                <input type="text" name="quiz_button_text" x-model="form.quiz_button_text"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                            </div>

                            <!-- TITLE -->
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-gray-700">Quiz Title</label>
                                <input type="text" name="quiz_title" x-model="form.quiz_title"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="quiz_description" x-model="form.quiz_description" rows="5"
                                    class="w-full rounded-xl border px-4 py-3 text-sm"></textarea>
                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="md:col-span-2 flex justify-end gap-3">
                                <button type="button" @click="resetForm()" class="border px-4 py-2 rounded-xl">
                                    Cancel
                                </button>

                                <button type="submit" class="bg-primary-900 text-white px-4 py-2 rounded-xl">
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
    function quizComponent() {
        return {
            quizzes: @json($quizes ?? []), // use DB fields

            editorOpen: false,
            editingIndex: null,

            form: {
                id: null,
                image: '', // Base64 preview
                fileName: '',
                quiz_image: '', // DB image path
                quiz_status: 'Ongoing',
                quiz_title: '',
                quiz_description: '',
                quiz_button_text: 'View Details'
            },

            openCreate() {
                this.editingIndex = null;
                this.resetForm();
                this.editorOpen = true;
            },

            openEdit(index) {
                this.editingIndex = index;
                const item = this.quizzes[index];

                this.form = {
                    id: item.id || null, // optional, if you have ID
                    image: '',
                    fileName: '',
                    quiz_image: item.quiz_image || '',
                    quiz_status: item.quiz_status || 'Ongoing',
                    quiz_title: item.quiz_title || '',
                    quiz_description: item.quiz_description || '',
                    quiz_button_text: item.quiz_button_text || 'View Details'
                };

                this.editorOpen = true;
            },

            handleFileChange(event) {
                const file = event.target.files[0];
                if (!file) return;
                this.form.fileName = file.name;
                const reader = new FileReader();
                reader.onload = (e) => this.form.image = e.target.result;
                reader.readAsDataURL(file);
            },

            resetForm() {
                this.form = {
                    id: null,
                    image: '',
                    fileName: '',
                    quiz_image: '',
                    quiz_status: 'Ongoing',
                    quiz_title: '',
                    quiz_description: '',
                    quiz_button_text: 'View Details'
                };
            },

            saveQuiz() {
                const payload = {
                    ...this.form,
                    quiz_image: this.form.fileName ? this.form.image : this.form.quiz_image
                };

                if (this.editingIndex === null) this.quizzes.push(payload);
                else this.quizzes[this.editingIndex] = payload;

                this.editorOpen = false;
            },

            deleteQuiz(index) {
                this.quizzes.splice(index, 1);
                if (this.editingIndex === index) this.editorOpen = false;
            }
        }
    }
</script>

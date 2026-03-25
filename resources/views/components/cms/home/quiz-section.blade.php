<div x-data="{
    sectionTitle: 'School Quiz Competitions',
    sectionDescription: 'Manage quiz competition cards displayed on the homepage slider section.',
    quizzes: [{
            image: 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=900&q=80',
            status: 'Ongoing',
            title: 'Inter-House General Knowledge Quiz',
            description: 'An engaging quiz event designed to test current affairs, logic and teamwork.',
            buttonText: 'View Details'
        },
        {
            image: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80',
            status: 'Upcoming',
            title: 'Science Talent Challenge',
            description: 'Students compete in science-based rounds focused on innovation and observation.',
            buttonText: 'View Details'
        },
        {
            image: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=80',
            status: 'Completed',
            title: 'National Constitution Quiz',
            description: 'A themed competition promoting civic awareness, leadership and participation.',
            buttonText: 'View Details'
        }
    ],
    editorOpen: false,
    editingIndex: null,
    form: {
        image: '',
        fileName: '',
        status: 'Ongoing',
        title: '',
        description: '',
        buttonText: 'View Details'
    },
    openCreate() {
        this.editingIndex = null;
        this.form = {
            image: '',
            fileName: '',
            status: 'Ongoing',
            title: '',
            description: '',
            buttonText: 'View Details'
        };
        this.editorOpen = true;
    },
    openEdit(index) {
        this.editingIndex = index;
        this.form = { ...this.quizzes[index], fileName: '' };
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
    saveQuiz() {
        const payload = {
            image: this.form.image,
            status: this.form.status,
            title: this.form.title,
            description: this.form.description,
            buttonText: this.form.buttonText
        };
        if (this.editingIndex === null) {
            this.quizzes.push(payload);
        } else {
            this.quizzes[this.editingIndex] = payload;
        }
        this.editorOpen = false;
    },
    deleteQuiz(index) {
        this.quizzes.splice(index, 1);
        if (this.editingIndex === index) {
            this.editorOpen = false;
        }
    }
}" class="relative space-y-8">
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
                    <input id="quiz_section_title" x-model="sectionTitle" type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="quiz_section_description" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Description</label>
                    <textarea id="quiz_section_description" x-model="sectionDescription" rows="4"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
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
                        @foreach ($quizes as $key => $items)
                            <div
                                class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                                <div class="relative overflow-hidden">
                                    {{-- ✅ Image Fix --}}
                                    <img src="{{ asset($items->quiz_image)??  '' }}"
                                        alt="{{ $items->quiz_title ?? ""}}"
                                        class="h-56 w-full object-cover transition duration-300 group-hover:scale-105">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-primary-900/70 via-primary-900/15 to-transparent">
                                    </div>

                                    {{-- ✅ Status Fix --}}
                                    <span
                                        class="absolute left-4 top-4 rounded-full px-3 py-1 text-xs font-semibold shadow-sm
                    {{ $items->quiz_status === 'Ongoing'
                        ? 'bg-accent-500 text-black'
                        : ($items->quiz_status === 'Upcoming'
                            ? 'bg-white text-primary-900'
                            : 'bg-primary-900 text-white') }}">
                                        {{ $items->quiz_status ?? "" }}
                                    </span>
                                </div>

                                <div class="p-5">
                                    {{-- ✅ Title --}}
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $items->quiz_title ?? "" }}
                                    </h3>

                                    {{-- ✅ Description --}}
                                    <p class="mt-2 text-sm leading-6 text-gray-500">
                                        {{ $items->quiz_description ?? "no data" }}
                                    </p>

                                    {{-- ✅ Button Text --}}
                                    <div
                                        class="mt-4 inline-flex rounded-lg bg-primary-900/5 px-3 py-2 text-xs font-medium text-primary-900">
                                        {{ $items->quiz_button_text }}
                                    </div>

                                    <div class="mt-5 flex items-center gap-3">
                                        {{-- ✅ Edit --}}
                                        <button type="button" @click="openEdit({{ $key }})"
                                            class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                            <i class="fa-solid fa-pen text-[10px]"></i>
                                            Edit
                                        </button>

                                        {{-- ✅ Delete --}}
                                        <button type="button" @click="deleteQuiz({{ $key }})"
                                            class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-medium text-red-500 transition hover:bg-red-50">
                                            <i class="fa-solid fa-trash text-[10px]"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="editorOpen" x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 flex items-center justify-center bg-primary-900/40 p-4" style="display: none;"
        @click.self="editorOpen = false">
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

                <form action="{{ route('quiz.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                    <div class="p-6 sm:p-8">
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">
                            <div
                                class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                                <label for="quiz_image" class="mb-2 block text-sm font-medium text-gray-700">Quiz
                                    Banner
                                    Image Upload</label>

                                <input id="quiz_image" type="file" accept="image/*"
                                    @change="handleFileChange($event)" name="quiz_image"
                                    class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                                <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'">
                                </p>

                                <div
                                    class="mt-4 overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                    <img :src="form.image ||
                                        'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=900&q=80'"
                                        alt="Quiz preview" class="h-52 w-full object-cover">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                <div>
                                    <label for="quiz_status"
                                        class="mb-2 block text-sm font-medium text-gray-700">Status
                                        Badge</label>
                                    <select id="quiz_status" name="quiz_status"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                        <option selected>Select Status Badge</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Upcoming">Upcoming</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>

                                <div class="md:col-span-1">
                                    <label for="quiz_button_text"
                                        class="mb-2 block text-sm font-medium text-gray-700">Button Text</label>
                                    <input id="quiz_button_text" type="text" name="quiz_button_text"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="quiz_title" class="mb-2 block text-sm font-medium text-gray-700">Quiz
                                        Title</label>
                                    <input id="quiz_title" type="text" name="quiz_title"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="quiz_description"
                                        class="mb-2 block text-sm font-medium text-gray-700">Short Description</label>
                                    <textarea id="quiz_description" rows="5" name="quiz_description"
                                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                                </div>

                                <div class="md:col-span-2 flex flex-col gap-3 sm:flex-row sm:justify-end">
                                    <button type="button" @click="editorOpen = false"
                                        class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-4 py-2.5 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                        Cancel
                                    </button>

                                    <button type="submit" @click="saveQuiz()"
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

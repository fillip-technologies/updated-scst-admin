<div x-data="academicSection()" class="relative grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.15fr)_400px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Academic Infrastructure Section</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage the infrastructure cards shown on the academic infrastructure section.
                    </p>
                </div>

                <button type="button" @click.prevent.stop="openCreate()"
                    class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add Infrastructure Card
                </button>
            </div>
        </div>

        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="academic_infra_title" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Title</label>
                    <input id="academic_infra_title" x-model="sectionTitle" type="text"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                </div>

                <div>
                    <label for="academic_infra_description" class="mb-2 block text-sm font-medium text-gray-700">Section
                        Description</label>
                    <textarea id="academic_infra_description" x-model="sectionDescription" rows="4"
                        class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                </div>

                <div class="border-t border-primary-800/10 pt-8">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Existing Infrastructure Cards</h3>
                            <p class="mt-1 text-sm text-gray-500">Preview and manage all academic infrastructure cards.
                            </p>
                        </div>
                        <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900"
                            x-text="`${cards.length} Cards`"></span>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <template x-for="(card, index) in cards" :key="index">
                            <div
                                class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                                <!-- IMAGE -->
                                <div class="relative overflow-hidden">
                                    <img :src="card.infra_card_image ?
                                        '/' + card.infra_card_image :
                                        'https://images.unsplash.com/photo-1509062522246-3755977927d7'"
                                        :alt="card.infra_card_title"
                                        class="h-52 w-full object-cover transition duration-300 group-hover:scale-105">
                                </div>

                                <!-- CONTENT -->
                                <div class="p-5">
                                    <h3 class="text-lg font-semibold text-gray-800" x-text="card.infra_card_title"></h3>

                                    <p class="mt-2 text-sm leading-6 text-gray-500 line-clamp-3"
                                        x-text="card.infra_card_description"></p>

                                    <!-- ACTION -->
                                    <div class="mt-5 flex items-center gap-3">
                                        <button type="button" @click="openEdit(index)"
                                            class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                            <i class="fa-solid fa-pen text-[10px]"></i>
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('inf.delete.acadmi') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                                            <input type="hidden" name="infra_index" :value="index">

                                            <button type="submit" @click="deleteCard(index)"
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

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Academic infrastructure section appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Preview</span>
        </div>

        <div class="mt-6 rounded-3xl border border-primary-800/10 bg-gray-50 p-5">
            <h3 class="text-2xl font-semibold text-gray-800" x-text="sectionTitle"></h3>
            <p class="mt-3 text-sm leading-6 text-gray-500" x-text="sectionDescription"></p>

            <div class="mt-6 space-y-4">
                <template x-for="(card, index) in cards" :key="index">
                    <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">

                        <!-- IMAGE -->
                        <img :src="card.infra_card_image ?
                            '/' + card.infra_card_image :
                            'https://images.unsplash.com/photo-1509062522246-3755977927d7'"
                            :alt="card.infra_card_title" class="h-36 w-full object-cover">

                        <div class="p-4">

                            <!-- TITLE -->
                            <h4 class="text-sm font-semibold text-gray-800" x-text="card.infra_card_title"></h4>

                            <!-- DESCRIPTION -->
                            <p class="mt-2 text-sm leading-6 text-gray-500" x-text="card.infra_card_description"></p>

                            <!-- LINK -->
                            <template x-if="card.infra_card_link">
                                <div class="mt-3 inline-flex rounded-lg bg-primary-900/5 px-3 py-2 text-xs font-medium text-primary-900"
                                    x-text="card.infra_card_link"></div>
                            </template>

                        </div>
                    </div>
                </template>
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
                        x-text="editingIndex === null ? 'Add Infrastructure Card' : 'Edit Infrastructure Card'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Upload an image and update the infrastructure card content.
                    </p>
                </div>

                <button type="button" @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 sm:p-8">
                <form x-ref="infraForm"
                    :action="editingIndex === null ?
                        '{{ route('inf.save.acadmi') }}' :
                        '{{ route('inf.update.acadmi') }}'"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    <!-- ✅ update ke liye index / id -->
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                    <input type="hidden" name="infra_index" :value="editingIndex">

                    <!-- ✅ old image -->
                    <input type="hidden" name="old_infra_image" :value="form.infra_card_image">

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">

                        <!-- IMAGE -->
                        <div class="rounded-2xl border border-dashed p-5">
                            <label class="mb-2 block text-sm font-medium">Infrastructure Image</label>

                            <input type="file" name="infra_card_image" accept="image/*"
                                @change="handleFileChange($event)"
                                class="mt-4 block w-full rounded-xl border px-4 py-3 text-sm">

                            <p class="mt-3 text-xs" x-text="form.fileName || 'No file selected'"></p>

                            <!-- ✅ preview -->
                            <div class="mt-4 overflow-hidden rounded-2xl border bg-white">
                                <img :src="form.image ?
                                    form.image :
                                    (form.infra_card_image ?
                                        '/' + form.infra_card_image :
                                        'https://images.unsplash.com/photo-1509062522246-3755977927d7'
                                    )"
                                    class="h-52 w-full object-cover">
                            </div>
                        </div>

                        <!-- FORM -->
                        <div class="grid grid-cols-1 gap-5">

                            <!-- TITLE -->
                            <div>
                                <label class="mb-2 block text-sm font-medium">Title</label>
                                <input type="text" name="infra_card_title" x-model="form.infra_card_title"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                            </div>

                            <!-- DESCRIPTION -->
                            <div>
                                <label class="mb-2 block text-sm font-medium">Description</label>
                                <textarea name="infra_card_description" x-model="form.infra_card_description" rows="4"
                                    class="w-full rounded-xl border px-4 py-3 text-sm"></textarea>
                            </div>

                            <!-- LINK -->
                            <div>
                                <label class="mb-2 block text-sm font-medium">Link</label>
                                <input type="text" name="infra_card_link" x-model="form.infra_card_link"
                                    class="w-full rounded-xl border px-4 py-3 text-sm">
                            </div>

                            <!-- BUTTON -->
                            <div class="flex justify-end gap-3">
                                <button type="button" @click="resetForm()" class="border px-4 py-2 rounded-xl">
                                    Cancel
                                </button>

                                <button type="submit" class="bg-primary-900 text-white px-4 py-2 rounded-xl">
                                    Save
                                </button>
                            </div>

                        </div>
                    </div>
                </form>


            </div>


        </div>
    </div>
</div>
<script>
    function academicSection() {
        return {
            sectionTitle: 'Academic Infrastructure',
            sectionDescription: 'Manage the facilities and learning spaces presented on the infrastructure page.',

            // ✅ FIX: JSON properly parse
            cards: (() => {
                try {
                    let raw = @json($academics ?? '[]');
                    return (typeof raw === 'string') ? JSON.parse(raw) : raw;
                } catch (e) {
                    return [];
                }
            })(),

            editorOpen: false,
            editingIndex: null,

            // ✅ FIX: same keys as DB
            form: {
                infra_card_title: '',
                infra_card_description: '',
                infra_card_link: '',
                infra_card_image: '',
                image: '',
                fileName: ''
            },

            // ✅ CREATE
            openCreate() {
                this.editingIndex = null;

                this.form = {
                    infra_card_title: '',
                    infra_card_description: '',
                    infra_card_link: '',
                    infra_card_image: '',
                    image: '',
                    fileName: ''
                };

                this.editorOpen = true;
            },

            // ✅ EDIT (DATA LOAD FIX)
            openEdit(index) {
                let card = this.cards[index];
                if (!card) return;

                this.editingIndex = index;

                this.form = {
                    infra_card_title: card.infra_card_title,
                    infra_card_description: card.infra_card_description,
                    infra_card_link: card.infra_card_link,
                    infra_card_image: card.infra_card_image,
                    image: '',
                    fileName: ''
                };

                this.editorOpen = true;
            },

            // ✅ IMAGE HANDLE
            handleFileChange(event) {
                const file = event.target.files[0];
                if (!file) return;

                this.form.fileName = file.name;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.form.image = e.target.result; // preview only
                };
                reader.readAsDataURL(file);
            },

            // ❌ REMOVE this if using Laravel submit
            saveCard() {
                const payload = {
                    infra_card_title: this.form.infra_card_title,
                    infra_card_description: this.form.infra_card_description,
                    infra_card_link: this.form.infra_card_link,
                    infra_card_image: this.form.image
                };

                if (this.editingIndex === null) {
                    this.cards.push(payload);
                } else {
                    this.cards[this.editingIndex] = payload;
                }

                this.editorOpen = false;
            },

            deleteCard(index) {
                this.cards.splice(index, 1);

                if (this.editingIndex === index) {
                    this.editorOpen = false;
                }
            }
        }
    }
</script>

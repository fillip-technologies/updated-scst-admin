<div x-data="faqComponent()" class="relative">
    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
        <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
            <div
                class="flex flex-col gap-4 border-b border-primary-800/10 px-6 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">FAQ Section</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage homepage frequently asked questions with a simple add, edit and delete workflow.
                    </p>
                </div>

                <button type="button" @click.prevent.stop="openCreate()"
                    class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add FAQ
                </button>
            </div>

            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="faq_section_title" class="mb-2 block text-sm font-medium text-gray-700">Section
                            Title</label>
                        <input id="faq_section_title" x-model="sectionTitle" type="text"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    </div>

                    <div>
                        <label for="faq_section_description"
                            class="mb-2 block text-sm font-medium text-gray-700">Section Description</label>
                        <textarea id="faq_section_description" x-model="sectionDescription" rows="4"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                    </div>

                    <div class="border-t border-primary-800/10 pt-8">
                        <div class="mb-5 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Existing FAQ Items</h3>
                                <p class="mt-1 text-sm text-gray-500">Preview and manage all FAQ entries shown on the
                                    homepage.</p>
                            </div>
                            <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900"
                                x-text="`${faqs.length} FAQs`"></span>
                        </div>

                        <div class="space-y-4">
                            <!-- ✅ Alpine Live Data (for edit/delete preview) -->
                            <template x-for="(faq, index) in faqs" :key="index">
                                <div class="rounded-2xl border border-primary-800/10 bg-white p-5 shadow-sm">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                        <div class="min-w-0">
                                            <h3 class="text-base font-semibold text-gray-800" x-text="faq.faq_question">
                                            </h3>

                                            <p class="mt-2 text-sm leading-6 text-gray-500 line-clamp-3"
                                                x-text="faq.faq_answer"></p>
                                        </div>

                                        <div class="flex items-center gap-3">

                                            <button type="button" @click="openEdit(index)"
                                                class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900">
                                                Edit
                                            </button>
                                            <form method="POST" action="{{ route('faq.delete.index') }}">
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

        <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Preview</h2>
                    <p class="mt-1 text-sm text-gray-500">FAQ section preview panel.</p>
                </div>
                <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">FAQ</span>
            </div>

            <div class="mt-6 rounded-3xl border border-dashed border-primary-800/20 bg-primary-900/5 p-6 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-primary-900 shadow-sm ring-1 ring-primary-800/10">
                    <i class="fa-solid fa-comments text-xl"></i>
                </div>
                <h3 class="mt-5 text-lg font-semibold text-gray-800">Preview Coming Soon</h3>
                <p class="mt-3 text-sm leading-6 text-gray-500">Coming Later</p>
            </div>

            <div class="mt-6 rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                <h3 class="text-base font-semibold text-gray-800" x-text="sectionTitle"></h3>
                <p class="mt-2 text-sm leading-6 text-gray-500" x-text="sectionDescription"></p>

                <div class="mt-5 space-y-3">
                    @forelse ($faqs ?? [] as $faq)
                        <div class="rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-primary-800/10">

                            <!-- ✅ FIX -->
                            <p class="text-sm font-medium text-gray-800">
                                {{ $faq->faq_question ?? '' }}
                            </p>

                            <p class="mt-2 text-sm leading-6 text-gray-500 line-clamp-2">
                                {{ $faq->faq_answer ?? '' }}
                            </p>

                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No FAQs found</p>
                    @endforelse
                </div>
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
                        x-text="editingIndex === null ? 'Add FAQ' : 'Edit FAQ'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Update the question and answer using this simple editor.
                    </p>
                </div>

                <button type="button" @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form x-ref="quizForm"
                :action="editingIndex === null ?
                    '{{ route('quiz.save') }}' :
                    '{{ route('quize.update', ':id') }}'.replace(':id', form.id)"
                method="POST" enctype="multipart/form-data">
                @csrf

                <!-- PUT method for edit -->
                <template x-if="editingIndex !== null">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <!-- Hidden fields -->
                <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                <input type="hidden" name="quiz_index" :value="editingIndex">

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">

                        <!-- IMAGE -->
                        <div class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5">
                            <label class="mb-2 block text-sm font-medium text-gray-700">
                                Quiz Banner Image Upload
                            </label>

                            <input type="file" name="quiz_image" accept="image/*"
                                @change="handleFileChange($event)"
                                class="mt-4 block w-full rounded-xl border px-4 py-3 text-sm">

                            <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>

                            <div class="mt-4 overflow-hidden rounded-2xl border bg-white">
                                <img :src="form.image ?
                                    form.image :
                                    (form.quiz_image ? '/' + form.quiz_image :
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
                                <button type="button" @click="editorOpen = false; resetForm()"
                                    class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-4 py-2.5 text-sm font-medium text-primary-900">
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
    function faqComponent() {
        return {
            sectionTitle: 'Frequently Asked Questions',
            sectionDescription: 'Manage the common questions and answers displayed on the homepage FAQ accordion.',
            faqs: @json($faqs ?? []),

            editorOpen: false,
            editingIndex: null,

            form: {
                question: '',
                answer: ''
            },

            openCreate() {
                this.editingIndex = null;
                this.form = {
                    question: '',
                    answer: ''
                };
                this.editorOpen = true;
            },

            openEdit(index) {
                this.editingIndex = index;

                let faq = this.faqs[index];

                this.form = {
                    question: faq.faq_question ?? faq.question,
                    answer: faq.faq_answer ?? faq.answer
                };

                this.editorOpen = true;
            },

            saveFaq() {
                if (!this.form.question || !this.form.answer) {
                    alert('Both fields are required');
                    return;
                }

                const payload = {
                    faq_question: this.form.question,
                    faq_answer: this.form.answer
                };

                if (this.editingIndex === null) {
                    this.faqs.push(payload);
                } else {
                    this.faqs[this.editingIndex] = payload;
                }

                this.editorOpen = false;
            },

            deleteFaq(index) {
                this.faqs.splice(index, 1);

                if (this.editingIndex === index) {
                    this.editorOpen = false;
                }
            }
        }
    }
</script>

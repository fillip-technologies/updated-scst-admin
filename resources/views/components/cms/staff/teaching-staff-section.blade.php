@if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "Validation Errors",
            html: `
                <ul style="text-align:center; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li style="margin-bottom:5px;">{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: "OK",
            confirmButtonColor: "#d33"
        });
    </script>
@endif
<div x-data="staffSection()" class="relative grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.15fr)_400px]">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Teaching Staff Section</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage staff cards for the teaching staff section.
                    </p>
                </div>

                <button type="button" @click.prevent.stop="openCreate()"
                    class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add Staff Member
                </button>
            </div>
        </div>

        <div class="p-6 sm:p-8">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Existing Staff Cards</h3>
                    <p class="mt-1 text-sm text-gray-500">Preview and manage all teaching staff members.</p>
                </div>
                <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900"
                    x-text="`${staff.length} Staff Members`"></span>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <template x-for="(member, index) in staff" :key="`${member.name}-${index}`">
                    <div
                        class="group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex flex-col items-center p-6 text-center">
                            <div class="h-24 w-24 overflow-hidden rounded-full ring-4 ring-primary-900/10">
                                <img :src="'/' + member.image" :alt="member.name"
                                    class="h-full w-full object-cover">
                            </div>

                            <h3 class="mt-4 text-lg font-semibold text-gray-800" x-text="member.name"></h3>
                            <p class="mt-2 text-sm text-primary-900" x-text="member.subject"></p>
                            <p class="mt-2 text-sm leading-6 text-gray-500" x-text="member.email"></p>

                            <div class="mt-5 flex items-center gap-3">
                                <button type="button" @click="openEdit(index)"
                                    class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    <i class="fa-solid fa-pen text-[10px]"></i>
                                    Edit
                                </button>

                                <form method="POST" action="{{ route('staff.delete.teacher') }}">
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

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Teaching staff cards appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Teaching Staff</span>
        </div>

        <div class="mt-6 space-y-4">
            <template x-for="(member, index) in staff" :key="`preview-${index}`">
                <div class="rounded-2xl border border-primary-800/10 bg-gray-50 p-4">
                    <div class="flex items-center gap-4">
                        <div class="h-16 w-16 overflow-hidden rounded-full ring-2 ring-primary-900/10">
                            <img :src="'/' + member.image" :alt="member.name" class="h-full w-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-sm font-semibold text-gray-800" x-text="member.name"></h4>
                            <p class="mt-1 text-sm text-primary-900" x-text="member.subject"></p>
                            <p class="mt-1 text-sm text-gray-500" x-text="member.email"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div x-show="editorOpen" x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 flex items-center justify-center bg-primary-900/40 p-4" style="display: none;"
        @click.self="editorOpen = false">
        <div class="w-full max-w-4xl rounded-3xl border border-primary-800/10 bg-white shadow-2xl">
            <div class="flex items-start justify-between border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800"
                        x-text="editingIndex === null ? 'Add Staff Member' : 'Edit Staff Member'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Upload a staff image and update the teaching staff card details.
                    </p>
                </div>

                <button type="button" @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 sm:p-8">
                <form
                    :action="editingIndex === null ?
                        '{{ route('staff.save.teacher') }}' :
                        '{{ route('staff.update.teacher') }}'"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                    <input type="hidden" name="index" :value="editingIndex">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[260px_minmax(0,1fr)]">
                        <!-- IMAGE -->
                        <div
                            class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                            <label for="staff_image" class="mb-2 block text-sm font-medium text-gray-700">Staff Image
                                Upload</label>

                            <input id="staff_image" type="file" accept="image/*" @change="handleFileChange($event)"
                                name="staff_image"
                                class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm
                       file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white
                       hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                            <p class="mt-3 text-xs text-gray-500" x-text="form.fileName || 'No file selected'"></p>

                            <div class="mt-4 flex justify-center">
                                <div class="h-32 w-32 overflow-hidden rounded-full ring-4 ring-primary-900/10">
                                    <img :src="form.image ? (form.image.startsWith('data:') ? form.image : '/' + form.image) :
                                        'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=900&q=80'"
                                        alt="Staff preview" class="h-full w-full object-cover">
                                </div>
                            </div>
                        </div>

                        <!-- FORM FIELDS -->
                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label for="staff_name" class="mb-2 block text-sm font-medium text-gray-700">Staff
                                    Name</label>
                                <input id="staff_name" name="staff_name" type="text" x-model="form.name"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition
                           focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="staff_subject"
                                    class="mb-2 block text-sm font-medium text-gray-700">Subject
                                    / Department</label>
                                <input id="staff_subject" name="staff_subject" type="text" x-model="form.subject"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition
                           focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="staff_email" class="mb-2 block text-sm font-medium text-gray-700">Email
                                    Address</label>
                                <input id="staff_email" name="staff_email" type="email" x-model="form.email"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition
                           focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

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
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function staffSection() {
        return {
            staff: [],

            editorOpen: false,
            editingIndex: null,

            form: {
                image: '',
                fileName: '',
                name: '',
                subject: '',
                email: ''
            },

            // LOAD DATA FROM LARAVEL
            init() {
                this.staff = (@json($teacher ?? [])).map(item => ({
                    name: item.staff_name || '',
                    subject: item.staff_subject || '',
                    email: item.staff_email || '',
                    image: item.staff_image || ''
                }));
            },

            // ADD NEW
            openCreate() {
                this.editingIndex = null;

                this.form.name = '';
                this.form.subject = '';
                this.form.email = '';
                this.form.image = '';
                this.form.fileName = '';

                this.editorOpen = true;
            },

            // ✅ FIXED EDIT
            openEdit(index) {
                const member = this.staff[index];

                this.editingIndex = index;

                this.form.name = member.name;
                this.form.subject = member.subject;
                this.form.email = member.email;
                this.form.image = member.image;
                this.form.fileName = '';

                this.editorOpen = true;
            },

            // IMAGE CHANGE
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

            // SAVE (ADD + EDIT)
            saveStaff() {
                const payload = {
                    name: this.form.name,
                    subject: this.form.subject,
                    email: this.form.email,
                    image: this.form.image
                };

                if (this.editingIndex === null) {
                    this.staff.push(payload);
                } else {
                    this.staff.splice(this.editingIndex, 1, payload);
                }

                this.editorOpen = false;
            },

            // DELETE
            deleteStaff(index) {
                this.staff.splice(index, 1);
            }
        }
    }
</script>

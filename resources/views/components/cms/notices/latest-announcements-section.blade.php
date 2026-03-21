<div
    x-data="{
        notices: [
            {
                title: 'Admission Open for Session 2026-27',
                description: 'Applications are now open for eligible students seeking admission to residential classes.',
                category: 'Admission',
                publishDate: '2026-03-10',
                badge: 'New',
                attachmentName: 'admission-notice.pdf',
                attachmentFile: ''
            },
            {
                title: 'Annual Sports Week Schedule Released',
                description: 'Students can view the detailed events calendar and participation instructions.',
                category: 'Events',
                publishDate: '2026-03-08',
                badge: 'None',
                attachmentName: 'sports-week-schedule.pdf',
                attachmentFile: ''
            },
            {
                title: 'Mid-Term Examination Timetable',
                description: 'The academic timetable for mid-term assessments has been published.',
                category: 'Academic',
                publishDate: '2026-03-05',
                badge: 'New',
                attachmentName: 'midterm-timetable.pdf',
                attachmentFile: ''
            }
        ],
        editorOpen: false,
        editingIndex: null,
        form: {
            title: '',
            description: '',
            category: 'General',
            publishDate: '',
            badge: 'None',
            attachmentName: '',
            attachmentFile: ''
        },
        openCreate() {
            this.editingIndex = null;
            this.form = {
                title: '',
                description: '',
                category: 'General',
                publishDate: '',
                badge: 'None',
                attachmentName: '',
                attachmentFile: ''
            };
            this.editorOpen = true;
        },
        openEdit(index) {
            this.editingIndex = index;
            this.form = { ...this.notices[index] };
            this.editorOpen = true;
        },
        handleAttachmentChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            this.form.attachmentName = file.name;
            this.form.attachmentFile = file.name;
        },
        saveNotice() {
            const payload = { ...this.form };
            if (this.editingIndex === null) {
                this.notices.unshift(payload);
            } else {
                this.notices[this.editingIndex] = payload;
            }
            this.editorOpen = false;
        },
        deleteNotice(index) {
            this.notices.splice(index, 1);
            if (this.editingIndex === index) {
                this.editorOpen = false;
            }
        },
        badgeClass(value) {
            if (value === 'New') return 'bg-accent-500 text-black';
            return 'bg-primary-900/10 text-primary-900';
        },
        categoryClass(value) {
            const map = {
                Admission: 'bg-primary-900 text-white',
                Events: 'bg-accent-500 text-black',
                Academic: 'bg-primary-700 text-white',
                General: 'bg-primary-900/10 text-primary-900'
            };
            return map[value] || map.General;
        }
    }"
    class="relative">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-primary-800/10 px-6 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Notices Management</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Add, edit and remove notices displayed on the public notices page.
                </p>
            </div>

            <button type="button"
                @click.prevent.stop="openCreate()"
                class="relative z-10 inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                <i class="fa-solid fa-plus text-xs"></i>
                Add Notice
            </button>
        </div>

        <div class="p-6 sm:p-8">
            <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Existing Notices</h3>
                    <p class="mt-1 text-sm text-gray-500">Manage published notices in a clean website-style list.</p>
                </div>
                <span class="w-fit rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900" x-text="`${notices.length} Notices`"></span>
            </div>

            <div class="space-y-4">
                <template x-for="(notice, index) in notices" :key="`${notice.title}-${index}`">
                    <div class="rounded-2xl border border-primary-800/10 bg-white p-5 shadow-sm">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h3 class="text-base font-semibold text-gray-800" x-text="notice.title"></h3>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold" :class="categoryClass(notice.category)" x-text="notice.category"></span>
                                    <template x-if="notice.badge === 'New'">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold" :class="badgeClass(notice.badge)" x-text="notice.badge"></span>
                                    </template>
                                </div>

                                <div class="mt-3 flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                    <span class="inline-flex items-center gap-2">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span x-text="notice.publishDate"></span>
                                    </span>
                                    <template x-if="notice.attachmentName">
                                        <span class="inline-flex items-center gap-2">
                                            <i class="fa-regular fa-file-lines"></i>
                                            <span x-text="notice.attachmentName"></span>
                                        </span>
                                    </template>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <button type="button"
                                    @click="openEdit(index)"
                                    class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    <i class="fa-solid fa-pen text-[10px]"></i>
                                    Edit
                                </button>
                                <button type="button"
                                    @click="deleteNotice(index)"
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

    <div
        x-show="editorOpen"
        x-transition.opacity.duration.200ms
        class="fixed inset-0 z-40 overflow-y-auto bg-primary-900/40 p-4 sm:p-6"
        style="display: none;"
        @click.self="editorOpen = false">
        <div class="flex min-h-full items-center justify-center">
        <div class="w-full max-w-xl rounded-3xl border border-primary-800/10 bg-white shadow-2xl sm:max-w-2xl">
            <div class="flex items-start justify-between border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800" x-text="editingIndex === null ? 'Add Notice' : 'Edit Notice'"></h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Update the announcement details and optional attachment.
                    </p>
                </div>

                <button
                    type="button"
                    @click="editorOpen = false"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="notice_title" class="mb-2 block text-sm font-medium text-gray-700">Notice Title</label>
                        <input
                            id="notice_title"
                            x-model="form.title"
                            type="text"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    </div>

                    <div class="md:col-span-2">
                        <label for="notice_description" class="mb-2 block text-sm font-medium text-gray-700">Notice Description</label>
                        <textarea
                            id="notice_description"
                            x-model="form.description"
                            rows="5"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                    </div>

                    <div>
                        <label for="notice_category" class="mb-2 block text-sm font-medium text-gray-700">Notice Category</label>
                        <select
                            id="notice_category"
                            x-model="form.category"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            <option>Admission</option>
                            <option>Events</option>
                            <option>Academic</option>
                            <option>General</option>
                        </select>
                    </div>

                    <div>
                        <label for="notice_publish_date" class="mb-2 block text-sm font-medium text-gray-700">Publish Date</label>
                        <input
                            id="notice_publish_date"
                            x-model="form.publishDate"
                            type="date"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                    </div>

                    <div>
                        <label for="notice_badge" class="mb-2 block text-sm font-medium text-gray-700">Badge Status</label>
                        <select
                            id="notice_badge"
                            x-model="form.badge"
                            class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            <option>New</option>
                            <option>None</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="notice_attachment" class="mb-2 block text-sm font-medium text-gray-700">Attachment File (PDF optional)</label>
                        <input
                            id="notice_attachment"
                            type="file"
                            accept=".pdf,.doc,.docx"
                            @change="handleAttachmentChange($event)"
                            class="block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                        <p class="mt-3 text-xs text-gray-500" x-text="form.attachmentName || 'No attachment selected'"></p>
                    </div>

                    <div class="md:col-span-2 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:justify-end">
                        <button type="button"
                            @click="editorOpen = false"
                            class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-4 py-2.5 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                            Cancel
                        </button>

                        <button type="button"
                            @click="saveNotice()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                            <i class="fa-solid fa-floppy-disk text-xs"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

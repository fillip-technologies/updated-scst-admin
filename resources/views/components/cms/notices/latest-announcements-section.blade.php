<div x-data="" class="relative">
    <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
        <div
            class="flex flex-col gap-4 border-b border-primary-800/10 px-6 py-5 sm:flex-row sm:items-end sm:justify-between sm:px-8">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Notices Management</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Add, edit and remove notices displayed on the public notices page.
                </p>
            </div>

            <button type="button" @click.prevent.stop="openCreate()"
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
                <span class="w-fit rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900"
                    x-text="`${notices.length} Notices`"></span>
            </div>

            <div class="space-y-4">
                <template x-for="(notice, index) in notices" :key="`${notice.title}-${index}`">
                    <div class="rounded-2xl border border-primary-800/10 bg-white p-5 shadow-sm">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h3 class="text-base font-semibold text-gray-800" x-text="notice.title"></h3>
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold"
                                        :class="categoryClass(notice.category)" x-text="notice.category"></span>
                                    <template x-if="notice.badge === 'New'">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold"
                                            :class="badgeClass(notice.badge)" x-text="notice.badge"></span>
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
                                <button type="button" @click="openEdit(index)"
                                    class="inline-flex items-center gap-2 rounded-lg border border-primary-800/20 bg-white px-3 py-2 text-xs font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    <i class="fa-solid fa-pen text-[10px]"></i>
                                    Edit
                                </button>
                                <button type="button" @click="deleteNotice(index)"
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
        class="fixed inset-0 z-40 overflow-y-auto bg-primary-900/40 p-4 sm:p-6" style="display: none;"
        @click.self="editorOpen = false">
        <div class="flex min-h-full items-center justify-center">
            <div class="w-full max-w-xl rounded-3xl border border-primary-800/10 bg-white shadow-2xl sm:max-w-2xl">
                <div class="flex items-start justify-between border-b border-primary-800/10 px-6 py-5 sm:px-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800"
                            x-text="editingIndex === null ? 'Add Notice' : 'Edit Notice'"></h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Update the announcement details and optional attachment.
                        </p>
                    </div>

                    <button type="button" @click="editorOpen = false"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-primary-800/15 bg-white text-gray-500 transition hover:bg-primary-900/5 hover:text-primary-900">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="p-4 sm:p-6 lg:p-8">

                    <form action="{{ route('notice.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="notice_title" class="mb-2 block text-sm font-medium text-gray-700">Notice
                                    Title</label>
                                <input id="notice_title" name="notice_title" type="text"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="md:col-span-2">
                                <label for="notice_description"
                                    class="mb-2 block text-sm font-medium text-gray-700">Notice Description</label>
                                <textarea id="notice_description" name="notice_description" rows="5"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                            </div>

                            <div>
                                <label for="notice_category" class="mb-2 block text-sm font-medium text-gray-700">Notice
                                    Category</label>
                                <select id="notice_category" name="notice_category"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                    <option selected>Select Notice Category</option>
                                    <option value="Admission">Admission</option>
                                    <option value="Events">Events</option>
                                    <option value="Academic">Academic</option>
                                    <option value="General">General</option>
                                </select>
                            </div>

                            <div>
                                <label for="notice_publish_date"
                                    class="mb-2 block text-sm font-medium text-gray-700">Publish Date</label>
                                <input id="notice_publish_date" name="notice_publish_date" type="date"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="notice_badge" class="mb-2 block text-sm font-medium text-gray-700">Badge
                                    Status</label>
                                <select id="notice_badge" name="notice_badge"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                    <option selected>Badge Status Select</option>
                                    <option value="Nnew">New</option>
                                    <option value="None">None</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label for="notice_attachment"
                                    class="mb-2 block text-sm font-medium text-gray-700">Attachment File (PDF
                                    optional)</label>
                                <input id="notice_attachment" type="file" name="notice_attachment"
                                    accept=".pdf,.doc,.docx" @change="handleAttachmentChange($event)"
                                    class="block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">

                                <p class="mt-3 text-xs text-gray-500"
                                    x-text="form.attachmentName || 'No attachment selected'"></p>
                            </div>

                            <div class="md:col-span-2 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:justify-end">
                                <button type="button" @click="editorOpen = false"
                                    class="inline-flex items-center justify-center rounded-xl border border-primary-800/20 bg-white px-4 py-2.5 text-sm font-medium text-primary-900 transition hover:border-primary-700 hover:bg-primary-900/5">
                                    Cancel
                                </button>

                                <button type="submit" @click="saveNotice()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

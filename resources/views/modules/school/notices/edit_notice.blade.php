@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 lg:p-8">

                    <form action="{{ route('notice.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="index" value="{{ $index }}">
                        <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="notice_title" class="mb-2 block text-sm font-medium text-gray-700">Notice
                                    Title</label>
                                <input id="notice_title" name="notice_title" type="text" value="{{ old('notice_title',$editdata->notice_title ?? "") }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="md:col-span-2">
                                <label for="notice_description"
                                    class="mb-2 block text-sm font-medium text-gray-700">Notice Description</label>
                                <textarea id="notice_description" name="notice_description" rows="5"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('notice_description',$editdata->notice_description ?? "") }}</textarea>
                            </div>

                            <div>
                                <label for="notice_category" class="mb-2 block text-sm font-medium text-gray-700">Notice
                                    Category</label>
                                <select id="notice_category" name="notice_category"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                    <option selected>Select Notice Category</option>
                                    <option value="Admission" @selected($editdata->notice_category === 'Admission') >Admission</option>
                                    <option value="Events"  @selected($editdata->notice_category === 'Events') >Events</option>
                                    <option value="Academic" @selected($editdata->notice_category === 'Academic') >Academic</option>
                                    <option value="General"  @selected($editdata->notice_category === 'General')>General</option>
                                </select>
                            </div>

                            <div>
                                <label for="notice_publish_date"
                                    class="mb-2 block text-sm font-medium text-gray-700">Publish Date</label>
                                <input id="notice_publish_date" name="notice_publish_date" type="date" value="{{ old('notice_publish_date',$editdata->notice_publish_date) }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="notice_badge" class="mb-2 block text-sm font-medium text-gray-700">Badge
                                    Status</label>
                                <select id="notice_badge" name="notice_badge"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                    <option >Badge Status Select</option>
                                    <option value="Nnew" @selected($editdata->notice_badge === 'New')>New</option>
                                    <option value="None" @selected($editdata->notice_badge === 'None')>None</option>
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
                                    x-text="form.attachmentName || 'No attachment selected'">
                                    <iframe src="{{ asset($editdata->notice_attachment) }}" frameborder="0"></iframe>
                                </p>
                            </div>

                            <div class="md:col-span-2 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:justify-end">


                                <button type="submit" @click="saveNotice()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
@endsection

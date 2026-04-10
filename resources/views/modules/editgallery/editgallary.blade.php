@extends('layouts.app')

@section('content')


<form action="{{ route('gallery.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
        <input type="hidden" name="index" value="{{ $index }}">
        <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
            <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <h2 class="text-xl font-semibold text-gray-800">Gallery Cards Management</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Edit the four fixed homepage gallery cards shown below the hero banner.
                </p>
            </div>

            <div class="p-6 sm:p-8">
                <div class="rounded-3xl border border-primary-800/10 bg-gray-50 p-5 sm:p-6">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Card Editor</h3>
                            <p class="mt-1 text-sm text-gray-500">Update the selected homepage gallery card.</p>
                        </div>
                        <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900">
                            Editing <span x-text="cards[selectedIndex].title"></span>
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[280px_minmax(0,1fr)]">
                        <div
                            class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                            <label for="gallery_card_image" class="mb-2 block text-sm font-medium text-gray-700">
                                Gallery Image
                            </label>

                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img src="{{ asset($data->gallery_card_image ?? "") }}" alt="Gallery card preview" class="h-56 w-full object-cover">
                            </div>

                            <p class="mt-4 text-sm font-medium text-gray-700">Preview</p>
                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Update the image URL or integrate file upload handling for this fixed card slot.
                            </p>

                            <input x-model="form.image" type="file" name="gallery_card_image"
                                placeholder="Paste image URL"
                                class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="gallery_card_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Title</label>
                                <input  type="text" name="gallery_card_title" value="{{old('gallery_card_title', $data->gallery_card_title ?? "") }}"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="gallery_card_subtitle" class="mb-2 block text-sm font-medium text-gray-700">
                                    Subtitle / Description
                                </label>
                                <textarea x-model="form.subtitle" rows="5" name="gallery_card_subtitle"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ old('gallery_card_subtitle',$data->gallery_card_subtitle ?? "") }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

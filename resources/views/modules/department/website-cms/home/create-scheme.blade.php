@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Department CMS</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-800">Create Scheme / Initiative</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                        Add a new department scheme card from this dedicated create page.
                    </p>
                </div>
            </div>

            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.department.cms.schemes') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-gray-600">
                    Back
                </a>
            </div>

            <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
                <div class="rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                    <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
                        <h2 class="text-xl font-semibold text-gray-800">Create Scheme Form</h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Fill in the scheme title, description, and tags for a new initiative card.
                        </p>
                    </div>

                    <form class="p-6 sm:p-8">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="scheme_title" class="mb-2 block text-sm font-medium text-gray-700">Title</label>
                                <input id="scheme_title" type="text" name="title" placeholder="Enter scheme title"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="scheme_description" class="mb-2 block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="scheme_description" name="description" rows="5" placeholder="Enter scheme description"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                            </div>

                            <div>
                                <label for="scheme_tags" class="mb-2 block text-sm font-medium text-gray-700">Tags</label>
                                <input id="scheme_tags" type="text" name="tags" placeholder="Enter tags (comma separated)"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div class="flex justify-end border-t border-primary-800/10 pt-4">
                                <button type="button"
                                    class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <x-cms.department-website-cms.schemes.schemes-preview
                    :cards="[
                        [
                            'title' => 'Scheme Title',
                            'description' => 'Scheme description will appear here.',
                            'tags' => '',
                        ],
                    ]" />
            </div>
        </div>
    </div>
@endsection

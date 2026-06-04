{{-- @props([
    'cards' => [
        [
            'title' => 'Post-Matric Scholarship Program',
            'description' => 'Financial support for eligible students to continue higher education with reduced barriers and timely assistance.',
            'tags' => 'Scholarship, Education, Student Support',
        ],
    ],
    'buttonText' => null,
    'createRoute' => null,
]) --}}



{{-- @php
    print_r($editdata);
@endphp --}}
<section class="space-y-6">
    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
        <div class="rounded-2xl border border-primary-800/10 bg-white shadow-sm">
            <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Schemes Form</h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Manage multiple department scheme cards and keep the preview in sync as you edit.
                        </p>
                    </div>

                    {{-- <a href="{{ $createRoute ?? route('admin.department.cms.schemes.create') }}"
                class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                + Add Scheme
            </a> --}}
                </div>
            </div>

            <form class="p-6 sm:p-8"
                action="{{ !empty($editdata) ? route('update.schema', $editdata->id) : route('add.schemas') }}"
                method="POST">
                @csrf
                <div class="space-y-5">

                    <div class="rounded-2xl border border-primary-800/10 bg-gray-50 p-5">
                        <div class="border-b border-primary-800/10 pb-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-primary-700">Scheme
                                    Card</p>
                                <p class="mt-1 text-sm font-medium text-gray-800">Card</p>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-1 gap-5">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700"">Title</label>
                                <input type="text" name="title" placeholder="Enter scheme title" id=""
                                    value="{{ !empty($editdata) ? $editdata->title : '' }}"
                                    class="scheme-title w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                @error('title')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700"
                                    for="">Description</label>
                                <textarea name="description" rows="4"
                                    class="scheme-description w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm
                                     transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                                     {{ old('description', !empty($editdata) ? $editdata->description : '') }}
                        </textarea>

                                @error('description')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Tags</label>
                                <input type="text" name="tags" placeholder="Enter tags (comma separated)"
                                    value="{{ !empty($editdata) ? $editdata->tags : '' }}"
                                    class="scheme-tags w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm
                                 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2
                                  focus:ring-primary-800/20">
                                @error('tags')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>


                <div class="mt-5 flex justify-end items-center gap-3 border-t border-primary-800/10 pt-5">

                    {{-- Back Button --}}
                    @if (!empty($editdata))
                        <a href="{{ url('admin/department/website-cms/home/schemes') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                            ← Back
                        </a>
                    @endif

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                        {{ !empty($editdata) ? 'Update' : 'Save' }}
                    </button>

                </div>

            </form>
        </div>
        <x-cms.department-website-cms.schemes.schemes-preview :datas="$datas" />
    </div>
</section>

@php
    $buttonText = $buttonText ?? 'Save';
@endphp

<div class="rounded-2xl border border-primary-800/10 bg-white shadow-sm">
    <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
        <h2 class="text-xl font-semibold text-gray-800">Leader Message Form</h2>
        <p class="mt-2 text-sm text-gray-500">
            Update profile details and homepage message content for the selected department leader.
        </p>
    </div>

    <form class="p-6 sm:p-8">
        <div class="mb-6 rounded-2xl border border-primary-800/10 bg-primary-900/5 px-4 py-3">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-primary-700">Editing</p>
            <p class="mt-1 text-sm font-medium text-gray-800">{{ $leader['label'] }}</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="leader_name" class="mb-2 block text-sm font-medium text-gray-700">Name</label>
                <input id="leader_name" type="text" name="name" placeholder="Enter full name"
                    value="{{ $leader['name'] }}"
                    class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
            </div>

            <div>
                <label for="leader_designation" class="mb-2 block text-sm font-medium text-gray-700">Designation</label>
                <input id="leader_designation" type="text" name="designation" placeholder="Enter designation"
                    value="{{ $leader['designation'] }}"
                    class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
            </div>

            <div>
                <label for="leader_image" class="mb-2 block text-sm font-medium text-gray-700">Profile Image</label>
                <input id="leader_image" type="file" name="image" placeholder="Choose profile image"
                    class="block w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-600 shadow-sm file:mr-4 file:rounded-xl file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
            </div>

            <div>
                <label for="leader_message" class="mb-2 block text-sm font-medium text-gray-700">Message</label>
                <textarea id="leader_message" name="message" rows="8"
                    placeholder="Enter leader message"
                    class="w-full rounded-2xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">{{ $leader['message'] }}</textarea>
            </div>

            <div class="flex justify-end border-t border-primary-800/10 pt-2">
                <button type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-primary-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800">
                    {{ $buttonText }}
                </button>
            </div>
        </div>
    </form>
</div>

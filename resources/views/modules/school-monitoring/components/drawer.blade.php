<aside
    class="fixed inset-y-0 right-0 z-30 hidden w-full max-w-xl overflow-y-auto border-l border-gray-200 bg-white p-5 shadow-lg"
    data-school-drawer>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-gray-900" data-drawer-name>Select a school</h2>
            <p class="text-sm text-gray-600" data-drawer-district></p>
        </div>

        <button type="button" class="rounded-md border border-gray-300 px-3 py-2 text-sm" data-close-drawer>
            Close
        </button>
    </div>

    <div class="mt-5 space-y-5">
        <section class="grid gap-3 text-sm md:grid-cols-2">
            <div class="rounded-md bg-gray-50 p-3">Students: <span data-drawer-students>0</span></div>
            <div class="rounded-md bg-gray-50 p-3">Teachers: <span data-drawer-teachers>0</span></div>
            <div class="rounded-md bg-gray-50 p-3">Dropouts: <span data-drawer-dropouts>0</span></div>
            <div class="rounded-md bg-gray-50 p-3">Pass %: <span data-drawer-pass>0</span></div>
            <div class="rounded-md bg-gray-50 p-3">Attendance %: <span data-drawer-attendance>0</span></div>
            <div class="rounded-md bg-gray-50 p-3">Last Report: <span data-drawer-report-time>-</span></div>
        </section>

        <section>
            <h3 class="text-base font-semibold text-gray-900">Issues List</h3>
            <ul class="mt-2 space-y-2 text-sm text-gray-700" data-drawer-issues></ul>
        </section>

        <section class="grid gap-3 text-sm md:grid-cols-2">
            <div class="rounded-md bg-gray-50 p-3">Books: <span data-drawer-books>Data not available</span></div>
            <div class="rounded-md bg-gray-50 p-3">Meals: <span data-drawer-meals>Data not available</span></div>
        </section>

        <section class="space-y-3">
            <h3 class="text-base font-semibold text-gray-900">Send Notice</h3>
            <form method="POST" action="{{ url('/admin/send-notice') }}" class="space-y-3">
                @csrf
                <input type="hidden" name="school_id" data-notice-school-id>
                <textarea
                    name="message"
                    rows="4"
                    placeholder="Enter notice message"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">{{ old('message') }}</textarea>
                <button type="submit" class="rounded-md border border-gray-300 px-4 py-2 text-sm">
                    Send Notice
                </button>
            </form>
        </section>

        @include('modules.school-monitoring.components.action-buttons')
    </div>
</aside>

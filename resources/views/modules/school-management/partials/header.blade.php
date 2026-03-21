<div class="mb-8 flex items-center justify-between">

    <div>
        <h1 class="text-2xl font-semibold text-gray-900">
            School Management
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Manage and monitor all registered schools.
        </p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('export.school') }}" class="px-4 py-2 rounded-xl border border-gray-300 text-sm hover:bg-gray-50">
            Export List
        </a>

        <a href="{{ url('admin/school-management/create') }}"
            class="px-4 py-2 rounded-xl bg-primary-900 text-white text-sm hover:bg-primary-800">
            + Add School
        </a>
    </div>

</div>

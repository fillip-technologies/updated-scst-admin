@extends('modules.user-management.index')

@section('user-content')

<div class="bg-white rounded-2xl border p-6 max-w-3xl">

    <h2 class="text-xl font-semibold mb-6">Create Role</h2>

    <form class="space-y-6">

        <div>
            <label class="text-sm font-medium text-gray-600">Role Name</label>
            <input type="text"
                   class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
        </div>

        <div>
            <label class="text-sm font-medium text-gray-600">Description</label>
            <textarea rows="3"
                      class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm"></textarea>
        </div>

        <div class="flex justify-end gap-4 pt-6 border-t">
            <button type="submit"
                    class="px-6 py-2 text-sm bg-primary-900 text-white rounded-lg">
                Create Role
            </button>
        </div>

    </form>

</div>

@endsection
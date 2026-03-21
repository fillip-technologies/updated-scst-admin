@extends('modules.user-management.index')

@section('user-content')

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 max-w-4xl">

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">
            Create New User
        </h2>

        <a href="{{ route('user.management.users') }}"
            class="text-sm text-blue-600 hover:underline">
            Back to Users
        </a>
    </div>

    <form class="space-y-6">

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="text-sm font-medium text-gray-600">Full Name</label>
                <input type="text"
                    class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Email</label>
                <input type="email"
                    class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Phone</label>
                <input type="text"
                    class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Role</label>
                <select class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>School Principal</option>
                    <option>District Officer</option>
                    <option>Department Admin</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">District</label>
                <select class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Patna</option>
                    <option>Gaya</option>
                    <option>Muzaffarpur</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Status</label>
                <select class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>

        </div>

        <div class="flex justify-end gap-4 pt-6 border-t">
            <a href="{{ route('user.management.users') }}"
                class="px-4 py-2 text-sm border rounded-lg text-gray-600 hover:bg-gray-100">
                Cancel
            </a>

            <button type="submit"
                class="px-6 py-2 text-sm bg-primary-900 text-white rounded-lg hover:bg-primary-800">
                Create User
            </button>
        </div>

    </form>

</div>

@endsection
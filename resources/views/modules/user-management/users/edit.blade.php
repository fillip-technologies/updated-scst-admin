@extends('modules.user-management.index')

@section('user-content')

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 max-w-4xl">

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit User
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
                <input type="text" value="Dr. Rajesh Kumar"
                    class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Email</label>
                <input type="email" value="rajesh@mail.com"
                    class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm">
            </div>

        </div>

        <div class="flex justify-end gap-4 pt-6 border-t">
            <a href="{{ route('user.management.users') }}"
                class="px-4 py-2 text-sm border rounded-lg text-gray-600 hover:bg-gray-100">
                Cancel
            </a>

            <button type="submit"
                class="px-6 py-2 text-sm bg-primary-900 text-white rounded-lg hover:bg-primary-800">
                Update User
            </button>
        </div>

    </form>

</div>

@endsection
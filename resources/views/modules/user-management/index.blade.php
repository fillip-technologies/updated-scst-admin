@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            User & Role Management
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Manage system access, roles, permissions and audit logs
        </p>
    </div>

    <div class="flex gap-8 border-b border-gray-200 mb-6">

        <a href="{{ route('user.management.users') }}"
            class="pb-3 {{ request()->routeIs('user.management.users') ? 'border-b-2 border-blue-700 text-blue-700 font-medium' : 'text-gray-500' }}">
            Users
        </a>

        <a href="{{ route('user.management.roles') }}"
            class="pb-3 {{ request()->routeIs('user.management.roles') ? 'border-b-2 border-blue-700 text-blue-700 font-medium' : 'text-gray-500' }}">
            Roles
        </a>

        <a href="{{ route('user.management.permissions') }}"
            class="pb-3 {{ request()->routeIs('user.management.permissions') ? 'border-b-2 border-blue-700 text-blue-700 font-medium' : 'text-gray-500' }}">
            Permissions Matrix
        </a>

        <a href="{{ route('user.management.logs') }}"
            class="pb-3 {{ request()->routeIs('user.management.logs') ? 'border-b-2 border-blue-700 text-blue-700 font-medium' : 'text-gray-500' }}">
            Access Logs
        </a>

    </div>

    @yield('user-content')

</div>

@endsection
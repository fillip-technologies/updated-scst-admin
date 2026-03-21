@extends('modules.user-management.index')

@section('user-content')

@php
$modules = [
"Dashboard Overview",
"School Management",
"Performance Analytics",
];

$roles = [
"Director" => "Monitoring",
"Department Admin" => "Admin",
"District Officer" => "Monitoring",
"School Principal" => "Reporting"
];

$permissions = ["View","Create","Edit","Delete","Approve","Export"];
@endphp


<!-- HEADER -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">
            Permission Matrix
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Configure granular access control for each role.
        </p>
    </div>

    <div class="flex gap-3">
        <button class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
            Reset Defaults
        </button>
        <button class="px-5 py-2 text-sm bg-primary-900 text-white rounded-lg hover:bg-primary-800">
            Save Changes
        </button>
    </div>
</div>


<!-- TABLE -->
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-x-auto">

    <table class="w-full text-sm min-w-[1100px]">

        <!-- HEADER -->
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="p-5 text-left w-64 font-semibold text-gray-700">
                    Module
                </th>

                @foreach($roles as $role => $type)
                <th class="p-5 text-left">
                    <div class="font-semibold text-gray-800">
                        {{ $role }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        {{ $type }}
                    </div>
                </th>
                @endforeach
            </tr>
        </thead>


        <tbody class="divide-y divide-gray-200">

            @foreach($modules as $module)

            <tr class="hover:bg-gray-50 align-top">

                <!-- MODULE NAME -->
                <td class="p-5 font-medium text-gray-700">
                    {{ $module }}
                </td>


                <!-- DIRECTOR (ALL CHECKED) -->
                <td class="p-5">
                    <div class="grid grid-cols-2 gap-y-3 gap-x-10">
                        @foreach($permissions as $perm)
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                checked
                                class="w-4 h-4 rounded"
                                style="accent-color:#0F2E4D">
                            <span>{{ $perm }}</span>
                        </label>
                        @endforeach
                    </div>
                </td>


                <!-- DEPARTMENT ADMIN (ALL CHECKED) -->
                <td class="p-5">
                    <div class="grid grid-cols-2 gap-y-3 gap-x-10">
                        @foreach($permissions as $perm)
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                checked
                                class="w-4 h-4 rounded"
                                style="accent-color:#0F2E4D">
                            <span>{{ $perm }}</span>
                        </label>
                        @endforeach
                    </div>
                </td>


                <!-- DISTRICT OFFICER (VIEW + EXPORT ONLY) -->
                <td class="p-5">
                    <div class="grid grid-cols-2 gap-y-3 gap-x-10">
                        @foreach($permissions as $perm)

                        @php
                        $allowed = in_array($perm, ['View','Export']);
                        @endphp

                        <label class="flex items-center gap-2 {{ $allowed ? '' : 'text-gray-400' }}">
                            <input type="checkbox"
                                {{ $allowed ? 'checked' : '' }}
                                class="w-4 h-4 rounded"
                                style="accent-color:#0F2E4D">
                            <span>{{ $perm }}</span>
                        </label>

                        @endforeach
                    </div>
                </td>


                <!-- SCHOOL PRINCIPAL (ONLY VIEW, OTHERS DISABLED) -->
                <td class="p-5">
                    <div class="grid grid-cols-2 gap-y-3 gap-x-10">
                        @foreach($permissions as $perm)

                        @php
                        $allowed = $perm == 'View';
                        @endphp

                        <label class="flex items-center gap-2 {{ $allowed ? '' : 'text-gray-400' }}">
                            <input type="checkbox"
                                {{ $allowed ? 'checked' : 'disabled' }}
                                class="w-4 h-4 rounded"
                                style="accent-color:#0F2E4D">
                            <span>{{ $perm }}</span>
                        </label>

                        @endforeach
                    </div>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection
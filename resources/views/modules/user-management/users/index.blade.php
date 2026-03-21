@extends('modules.user-management.index')

@section('user-content')

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

    <!-- FILTER SECTION -->
    <div class="flex justify-between mb-4">
        <input type="text"
               placeholder="Search by name or email..."
               class="w-1/3 border border-gray-300 rounded-lg px-3 py-2 text-sm">

        <div class="flex gap-3">
            <select class="border rounded-lg px-3 py-2 text-sm">
                <option>All Roles</option>
            </select>

            <select class="border rounded-lg px-3 py-2 text-sm">
                <option>All Districts</option>
            </select>

            <select class="border rounded-lg px-3 py-2 text-sm">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>

            <button class="text-red-500 text-sm">Reset</button>
        </div>
    </div>

    <!-- BULK ACTION BAR -->
    <div id="bulkActionBar"
         class="hidden bg-blue-50 border border-blue-200 rounded-xl px-6 py-3 mb-4 flex justify-between items-center">

        <div class="text-sm text-blue-700 font-medium">
            <span id="selectedCount">0</span> users selected
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                Activate
            </button>
            <button class="px-4 py-2 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                Deactivate
            </button>
            <button class="px-4 py-2 text-sm bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">
                Send Notification
            </button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="border rounded-xl overflow-hidden">
        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-4">
                        <input type="checkbox" id="selectAll"
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                    </th>
                    <th class="p-4 text-left">USER DETAILS</th>
                    <th class="p-4 text-left">ROLE & ACCESS</th>
                    <th class="p-4 text-left">CONTACT INFO</th>
                    <th class="p-4 text-left">STATUS</th>
                    <th class="p-4 text-right">ACTIONS</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @for($i=1;$i<=6;$i++)
                <tr class="group hover:bg-gray-50 transition">

                    <!-- CHECKBOX -->
                    <td class="p-4">
                        <input type="checkbox"
                               class="rowCheckbox w-4 h-4 text-blue-600 border-gray-300 rounded">
                    </td>

                    <!-- USER DETAILS -->
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                {{ chr(64+$i) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800">
                                    User {{ $i }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    ID: USER-00{{ $i }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- ROLE -->
                    <td class="p-4">
                        <div class="text-gray-700">School Principal</div>
                        <div class="text-xs text-gray-400">Patna</div>
                    </td>

                    <!-- CONTACT -->
                    <td class="p-4">
                        <div class="text-gray-700">user{{ $i }}@mail.com</div>
                        <div class="text-xs text-gray-400">+91 98765 43{{ $i }}0</div>
                    </td>

                    <!-- STATUS -->
                    <td class="p-4">
                        <span class="px-3 py-1 text-xs bg-green-100 text-green-600 rounded-full">
                            Active
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td class="p-4 text-right">

                        <div class="flex justify-end gap-5
                                    opacity-0 translate-x-2
                                    group-hover:opacity-100
                                    group-hover:translate-x-0
                                    transition-all duration-200">

                            <!-- VIEW -->
                            <button class="text-gray-400 hover:text-blue-600 transition">
                                <i class="fa-regular fa-eye"></i>
                            </button>

                            <!-- EDIT -->
                            <button class="text-gray-400 hover:text-yellow-600 transition">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>

                            <!-- DELETE -->
                            <button class="text-gray-400 hover:text-red-600 transition">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>

                        </div>

                    </td>

                </tr>
                @endfor

            </tbody>

        </table>
    </div>

</div>


<!-- JAVASCRIPT -->
<script>

    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.rowCheckbox');
    const bulkBar = document.getElementById('bulkActionBar');
    const selectedCount = document.getElementById('selectedCount');

    function updateSelection() {
        let count = document.querySelectorAll('.rowCheckbox:checked').length;
        selectedCount.textContent = count;
        bulkBar.classList.toggle('hidden', count === 0);
    }

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateSelection();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateSelection);
    });

</script>

@endsection
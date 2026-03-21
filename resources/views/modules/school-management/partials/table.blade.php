@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                confirmButtonColor: '#3085d6'
            });
        });
    </script>
@endif

<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-full text-sm">

            <thead class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">
                        <input type="checkbox">
                    </th>
                    <th class="px-6 py-4 text-left">School Name</th>
                    <th class="px-6 py-4 text-left">District</th>
                    <th class="px-6 py-4 text-left">Principal & Contact</th>
                    <th class="px-6 py-4 text-left">Students</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($datas as $schools)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- Checkbox -->
                        <td class="px-6 py-5">
                            <input type="checkbox">
                        </td>

                        <!-- School Name + Image -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">

                                <!-- Image Upload Preview -->
                                <div x-data="{ image: null }" class="relative">

                                    <label class="cursor-pointer">

                                        <!-- If new image selected -->
                                        <template x-if="image">
                                            <img :src="image" class="w-10 h-10 rounded-lg object-cover">
                                        </template>

                                        <!-- If no new image -->
                                        <template x-if="!image">
                                            @if ($schools->school_logo)
                                                <img src="{{ asset($schools->school_logo) }}"
                                                    class="w-10 h-10 rounded-lg object-cover">
                                            @else
                                                <div
                                                    class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                                    <i class="fa-regular fa-image"></i>
                                                </div>
                                            @endif
                                        </template>

                                        <input type="file" class="hidden"
                                            @change="image = URL.createObjectURL($event.target.files[0])">
                                    </label>

                                </div>

                                <!-- School Info -->
                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ $schools->school_name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $schools->school_code }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <!-- District -->
                        <td class="px-6 py-5 text-gray-700">
                            {{ $schools->district }}
                        </td>

                        <!-- Principal -->
                        <td class="px-6 py-5">
                            <p class="font-medium text-gray-900">
                                {{ $schools->principle_name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $schools->principle_contact }}
                            </p>
                        </td>

                        <!-- Students -->
                        <td class="px-6 py-5 font-medium text-gray-900">
                            {{ $schools->total_students_enrolled }}
                        </td>

                        <!-- Status Toggle (keep UI, just dynamic default) -->
                        <td class="px-6 py-5">
                            <form action="{{ route('status.update', encrypt($schools->id)) }}" method="POST">
                                @csrf
                            

                                <div x-data="{ active: {{ $schools->account_status === 'active' ? 'true' : 'false' }} }"
                                    @click="
                active = !active;
                $refs.statusInput.value = active ? 'active' : 'inactive';
                $nextTick(() => $el.closest('form').submit());
            "
                                    :class="active ? 'bg-green-500' : 'bg-red-500'"
                                    class="w-11 h-6 rounded-full relative cursor-pointer transition duration-300">

                                    <!-- Hidden Input -->
                                    <input type="hidden" name="account_status" x-ref="statusInput"
                                        :value="active ? 'active' : 'inactive'">

                                    <!-- Toggle Circle -->
                                    <div :class="active ? 'translate-x-5' : 'translate-x-1'"
                                        class="w-4 h-4 bg-white rounded-full absolute top-1 transition-all duration-300">
                                    </div>
                                </div>
                            </form>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-5 flex items-center gap-4 text-gray-500">

                            <a href="{{ route('show.school', encrypt($schools->id)) }}" class="hover:text-primary-600">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <a href="{{ route('edit.school', encrypt($schools->id)) }}" class="hover:text-primary-600">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>

                            <form action="{{ route('delete.school', encrypt($schools->id)) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this school?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:text-red-600">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>

    </div>

    @include('modules.school-management.partials.pagination')

</div>

<section class="space-y-4">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900">School List</h2>
        <p class="text-sm text-gray-500">
            <span data-visible-count class="font-medium text-gray-700">
                {{ $schools->count() }}
            </span> schools visible
        </p>
    </div>

    <!-- LIST -->
    <div class="grid gap-4" data-school-list>
        @foreach ($schools as $school)

        <article
            class="bg-white border border-gray-200 rounded-xl p-5 space-y-4 shadow-sm hover:shadow-md transition duration-200"
            data-school-card
        >

            <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">

                <!-- LEFT -->
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h3 class="text-base font-semibold text-gray-900">
                            {{ $school['school_name'] ?? "" }}
                        </h3>

                        @include('modules.school-monitoring.partials.badge', [
                            'status' => $school['reporting_status']
                        ])
                    </div>

                    <p class="text-sm text-gray-600 mt-1">
                        {{ $school['district'] ?? "" }}
                    </p>
                </div>

                <!-- STATUS -->
                <div class="flex items-center gap-2 text-sm text-gray-600 bg-gray-50 px-3 py-1 rounded-md w-fit">
                    @include('modules.school-monitoring.partials.status-dot', [
                        'status' => $school['reporting_status']
                    ])
                    <span class="capitalize">
                        {{ str_replace('_', ' ', $school['reporting_status']) }}
                    </span>
                </div>

            </div>

            <!-- DATA -->
            <div class="grid gap-3 text-sm sm:grid-cols-2 xl:grid-cols-4">

                <div>
                    <span class="text-gray-500">Students:</span>
                    <span class="font-medium text-gray-800">
                        {{ $school['student_count'] }}
                    </span>
                </div>

                <div>
                    <span class="text-gray-500">Teachers:</span>
                    <span class="font-medium text-gray-800">
                        {{ $school['teacher_count'] }}
                    </span>
                </div>

                <div>
                    <span class="text-gray-500">Dropout:</span>
                    <span class="font-medium text-red-500">
                        {{ $school['dropout_count'] }}
                    </span>
                </div>

                <div>
                    <span class="text-gray-500">Pass %:</span>
                    <span class="font-medium text-green-600">
                        {{ $school['pass_percentage'] }}%
                    </span>
                </div>

            </div>

            <!-- BUTTONS -->
            <div class="flex items-center gap-2 pt-2 border-t border-gray-100">

                <a href="{{ route('details.schools',encrypt($school->id)) }}"

                    class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-100 transition"

                >
                    View Details
            </a>

                {{-- <button
                    type="button"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-100 transition"
                    data-school-action
                >
                    Action
                </button> --}}

            </div>

        </article>

        @endforeach
    </div>

    <!-- EMPTY -->
    <div class="@if (count($schools) > 0) hidden @endif bg-white border border-gray-200 rounded-lg p-4 text-sm text-gray-600 text-center"
         data-empty-state>
        No schools match the current filters.
    </div>

</section>

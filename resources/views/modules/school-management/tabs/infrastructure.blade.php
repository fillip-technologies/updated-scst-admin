<div class="space-y-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Total Classrooms -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Total Classrooms
            </label>

            <input
                type="number"
                name="total_classrooms"  value="{{ old('total_classrooms',$editschl->total_classrooms ?? '') }}"
                placeholder="e.g. 12"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                       text-sm placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
        </div>


        <!-- Hostel Capacity -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Hostel Capacity
            </label>

            <input
                type="number"
                name="hostel_capacity"value="{{ old('hostel_capacity',$editschl->hostel_capacity ?? '') }}"
                placeholder="e.g. 500"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                       text-sm placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
        </div>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Total Students Enrolled -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Total Students Enrolled
            </label>

            <input
                type="number"
                name="total_students_enrolled"
                placeholder="e.g. 450" value="{{ old('total_students_enrolled',$editschl->total_students_enrolled ?? '') }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                       text-sm placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
        </div>


        <!-- Total Teachers Sanctioned -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Total Teachers Sanctioned
            </label>

            <input
                type="number"
                name="total_teachers_sanctioned"  value="{{ old('total_teachers_sanctioned',$editschl->total_teachers_sanctioned ?? '') }}"
                placeholder="e.g. 25"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50
                       text-sm placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white">
        </div>

    </div>

</div>

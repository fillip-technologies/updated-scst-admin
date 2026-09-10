@extends('layouts.app')

@section('content')
@php
    $months = selectmonths();
    $selectedMonth = $months[request('month')] ?? '';
    $currentMonth =  date('F');
@endphp

    <div class="max-w-7xl mx-auto p-6 space-y-8">

        <form action="{{ route('manualistutech.search') }}" method="GET" class="mb-3">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- School -->
                <div>
                    <label class="block mb-1 font-medium">School</label>
                    <select name="school_id" class="w-full border rounded-lg p-2">
                        <option value="">Select School</option>
                        <option value="{{ request('school_id') }}" @selected(request('school_id') == getSingleSchool(request('school_id'))->id)>
                            {{ getSingleSchool(request('school_id'))->school_name }}
                        </option>
                    </select>
                </div>

                <!-- Month -->
                <div>
                    <label class="block mb-1 font-medium">Month</label>

                    <select name="month" class="w-full border rounded-lg p-2">

                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}"
                                {{ request('month', date('m')) == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Year -->
                <div>
                    <label class="block mb-1 font-medium">Year</label>

                    <select name="year" class="w-full border rounded-lg p-2">

                        @for ($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}" {{ request('year', date('Y')) == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor

                    </select>
                </div>

                <!-- Button -->
                <div class="flex items-end gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Filter
                    </button>
                    @php
                        $school = getSingleSchool(request('school_id'));
                    @endphp
                    <a href="{{ route('manulareport', ['school_id' => request('school_id'), 'name' => $school->school_name]) }}"
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Back
                    </a>
                </div>
            </div>

        </form>

        <p class="text-blue-600">
            To view Student or Teacher Attendance Reports, please apply the filters.
        </p>
        <div>

            <h2 class="text-lg font-bold mb-3">
                1. Student and Teachers Attendance Reports
            </h2>

            <div class="overflow-x-auto">

                <table class="w-full border border-black border-collapse text-center text-xs">

                    <thead>
                        <tr>

                            <th class="border border-black p-2 w-32">
                                कुल नामांकित<br>
                                छात्र / छात्राओं<br>
                                की संख्या
                            </th>

                            <th class="border border-black p-2 w-36">
                                {{$selectedMonth}} माह में<br>
                                छात्र / छात्राओं<br>
                                की औसत उपस्थिति
                            </th>

                            <th class="border border-black p-2 w-40">
                                {{$selectedMonth}}  माह में<br>
                                छात्र / छात्राओं<br>
                                की औसत उपस्थिति प्रतिशत
                            </th>

                            <th class="border border-black p-2 w-56">
                                कुल पदस्थापित शिक्षकों की संख्या<br>
                                (नियोजित एवं शिक्षा मित्रा द्वारा<br>
                                प्रतिनियुक्ति शिक्षक सहित)
                            </th>

                            <th class="border border-black p-2 w-36">
                                {{$selectedMonth}}  माह में<br>
                                शिक्षकों की<br>
                                औसत उपस्थिति
                            </th>

                            <th class="border border-black p-2 w-40">
                               {{$selectedMonth}}  माह में<br>
                                शिक्षकों की<br>
                                औसत उपस्थिति प्रतिशत
                            </th>

                            <th class="border border-black p-2 w-28">
                                अनुपस्थिति
                            </th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>

                            <td class="border border-black py-2">
                                {{ $totalStudents ?? '-' }}
                            </td>

                            <td class="border border-black py-2">
                                {{ $averageStudentAttendance ?? '-' }}
                            </td>

                            <td class="border border-black py-2">
                                {{ $studentPercentage ?? '-' }}%
                            </td>

                            <td class="border border-black py-2">
                                {{ $totalTeachers ?? '-' }}
                            </td>

                            <td class="border border-black py-2">
                                {{ $averageTeacherAttendance ?? '-' }}
                            </td>

                            <td class="border border-black py-2">
                                {{ $teacherPercentage ?? '-' }}%
                            </td>

                            <td class="border border-black py-2">
                                {{ $absentStudents ?? '-' }}
                            </td>

                        </tr>
                    </tbody>

                </table>

            </div>

        </div>


        <div>

            <h2 class="text-lg font-bold mb-3">
                2. Weekly Test Report
            </h2>

            <div class="overflow-x-auto">

                <table class="w-full border border-black border-collapse text-center text-xs">

                    <thead>

                        <tr class="bg-gray-100">
                            @foreach ($weeklyReport ?? [] as $week)
                                <th colspan="4" class="border border-black py-2">
                                    दिनांक—{{ $week['date'] }} को आयोजित साप्ताहिक टेस्ट से संबंधित
                                </th>
                            @endforeach
                        </tr>

                        <tr>

                            @for ($i = 0; $i < 3; $i++)
                                <th class="border border-black p-2">
                                    81–100% अंक<br>
                                    लाने वाले छात्रों<br>
                                    का प्रतिशत
                                </th>

                                <th class="border border-black p-2">
                                    61–80% अंक<br>
                                    लाने वाले छात्रों<br>
                                    का प्रतिशत
                                </th>

                                <th class="border border-black p-2">
                                    45–60% अंक<br>
                                    लाने वाले छात्रों<br>
                                    का प्रतिशत
                                </th>

                                <th class="border border-black p-2">
                                    45% से कम अंक<br>
                                    लाने वाले<br>
                                    छात्र / छात्राओं<br>
                                    का प्रतिशत
                                </th>
                            @endfor

                        </tr>

                    </thead>

                    <tbody>
                        <tr>

                            @forelse ($weeklyReport ?? [] as $week)
                                <td class="border border-black py-2">
                                    {{ $week['81_100'] }}
                                </td>

                                <td class="border border-black py-2">
                                    {{ $week['61_80'] }}
                                </td>

                                <td class="border border-black py-2">
                                    {{ $week['45_60'] }}
                                </td>

                                <td class="border border-black py-2">
                                    {{ $week['below45'] }}
                                </td>

                            @empty
                            @endforelse

                        </tr>
                    </tbody>

                </table>

            </div>

        </div>



        <h3 class="font-bold text-lg mb-2">
            3. Lesson Plan Completion
        </h3>

        <div class="overflow-x-auto">
            <table class="border border-black border-collapse text-center text-sm w-auto">

                <thead>
                    <tr>
                        <th class="border border-black px-4 py-2 w-24">
                            वर्ग
                        </th>

                        <th class="border border-black px-4 py-2 w-40">
                            सभी विषयों के<br>
                            कुल पाठों की संख्या
                        </th>

                        <th class="border border-black px-4 py-2 w-40">
                            पूर्ण कराये गये<br>
                            पाठों की संख्या
                        </th>

                        <th class="border border-black px-4 py-2 w-44">
                            कोर्स पूर्णता का प्रतिशत
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $totalTopics = 0;
                        $totalCompleted = 0;
                    @endphp

                    @forelse ($lessonPlans ?? [] as $plan)
                        @php
                            $totalTopics += $plan['total_topics'];
                            $totalCompleted += $plan['completed_topics'];
                        @endphp

                        <tr>
                            <td class="border border-black py-1">
                                {{ $plan['class_name'] }}
                            </td>

                            <td class="border border-black py-1">
                                {{ $plan['total_topics'] }}
                            </td>

                            <td class="border border-black py-1">
                                {{ $plan['completed_topics'] }}
                            </td>

                            <td class="border border-black py-1">
                                {{ number_format($plan['percentage'], 2) }}%
                            </td>
                        </tr>

                    @empty
                        '-'
                    @endforelse

                    <tr class="font-bold">
                        <td class="border border-black py-1">
                            Total
                        </td>

                        <td class="border border-black py-1">
                            {{ $totalTopics }}
                        </td>

                        <td class="border border-black py-1">
                            {{ $totalCompleted }}
                        </td>

                        <td class="border border-black py-1">
                            {{ $totalTopics > 0 ? number_format(($totalCompleted * 100) / $totalTopics, 2) : '0.00' }}%
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
@endsection



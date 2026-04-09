@extends('layouts.app')

@section('content')

<div class="p-6">

    @foreach ($results as $studentId => $studentResults)

        <div class="bg-white shadow rounded-2xl p-6 mb-6">

            <!-- STUDENT HEADER -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    👨‍🎓 {{ $studentResults->first()->student->name }}
                </h2>

                <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                    Roll: {{ $studentResults->first()->student->id }}
                </span>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">Subject</th>
                            <th class="py-2">Marks</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">File</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($studentResults as $result)
                            <tr class="border-b">

                                <!-- SUBJECT -->
                                <td class="py-2">
                                    {{ $result->subject->subjects }}
                                </td>

                                <!-- MARKS -->
                                <td class="py-2">
                                    {{ $result->marks ?? '-' }}
                                </td>

                                <!-- STATUS -->
                                <td class="py-2">
                                    @if ($result->is_absent)
                                        <span class="text-red-500 text-xs">Absent</span>
                                    @else
                                        <span class="text-green-600 text-xs">Present</span>
                                    @endif
                                </td>

                                <!-- FILE -->
                                <td class="py-2">
                                    @if ($result->file)
                                        <a href="{{ asset('uploads/results/' . $result->file) }}"
                                           target="_blank"
                                           class="text-blue-600 text-xs underline">
                                            View
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    @endforeach

</div>

@endsection

@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-2xl border border-gray-200 shadow-[0_2px_8px_rgba(0,0,0,0.05)] p-5 mb-8">

        <div class="flex items-center justify-between gap-6 flex-wrap">

            <div class="flex items-center gap-4 justify-between">

                <form action="{{ route('school.list.search.mission') }}" method="GET">
                    <input type="hidden" name="school_id" value="{{SchoolLogin()->id ?? "" }}">
                    <select name="mission" id="mission" onchange="submit()"
                        class="px-4 py-2.5 rounded border border-gray-300 bg-gray-50 w-80
                   text-sm text-gray-700
                   focus:outline-none focus:ring-2 focus:ring-primary-600 focus:bg-white transition">

                        <option value="">Select Mission Aspire</option>

                        @foreach (mission_aspire() as $key => $mission)
                            <option value="{{ $key }}" @selected(request('mission') == $key)>
                                {{ $mission }}
                            </option>
                        @endforeach
                    </select>
                </form>


                {{-- <div id="filter">
                    <form action="" method="GET" id="formfield" class="flex gap-3"></form>
                </div> --}}

                <a href="{{ route('school.mission.aspire') }}"
                    class="text-sm font-medium text-white transition bg-blue-500 p-3 rounded-xl">
                    + Add Mission Aspire
                </a>
                <a href="{{ url('school/listing/mission/aspire') }}"
                    class="text-sm font-medium text-white transition bg-gray-400 p-3 rounded-xl">
                    + Reset
                </a>

            </div>
        </div>

    </div>
@endsection

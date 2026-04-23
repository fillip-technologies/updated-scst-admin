@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="bg-gray-100 min-h-screen flex justify-center">
        <div class="w-full max-w-3xl">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold text-gray-700">Upload Excel File</h2>
                </div>

                <form class="p-6 space-y-6" action="{{ route('upload.mission.aspire') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div> <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Select Missio Aspire</label>
                        <select id="class" name="mission_section"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                            <option value="">Select Mission Field</option>
                            @foreach (mission_aspire() as $key => $mission)
                                <option value="{{ $key }}">{{ $mission }}</option>
                            @endforeach

                        </select>
                        @error('mission_section')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="excel_file" class="block text-sm font-medium text-gray-700 mb-2">Upload Excel</label>
                        <input type="file" id="excel_file" name="upload_file"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800">
                        @error('upload_file')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition">
                            Upload
                        </button>

                        <a href="#"
                            class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

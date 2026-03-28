@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen">
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Bulk Upload</h1>
            <p class="text-sm text-gray-500">Upload student records using an Excel file.</p>
        </div>

        <div class="max-w-3xl items-center justify-center">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold text-gray-700">Upload Student Excel</h2>
                </div>

                <form class="p-6 space-y-6" action="{{ route('student.import') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <div>
                    <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Select Class</label>
                    <select
                        id="class"
                        name="class"
                        class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-200">
                        <option value="">Select Class</option>
                        @foreach (getClass() as $class)
                            <option value={{ $class->id }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                    <div>
                        <label for="excel_file" class="block text-sm font-medium text-gray-700 mb-2">Upload Excel</label>
                        <input type="file" id="excel_file" name="upload_file"
                            class="w-full border rounded-lg px-4 py-2.5 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-primary-900 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-primary-800">
                    </div>

                    <div class="rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                        <a href="{{ asset('smapledata/sample_student.xlsx') }}" class="text-blue-600 underline font-medium">
                            Download Sample Excel
                        </a>
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

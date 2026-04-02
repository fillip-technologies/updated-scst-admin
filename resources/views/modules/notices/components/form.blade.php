<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Title --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Title</label>
        <input type="text" name="title"
            value="{{ $notice->title ?? '' }}"
            placeholder="Enter notice title"
            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
    </div>

    {{-- Description --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Description</label>
        <textarea name="description"
            placeholder="Enter description"
            class="w-full border rounded-lg px-4 py-2 h-28 focus:outline-none focus:ring-2 focus:ring-primary">{{ $notice->description ?? '' }}</textarea>
    </div>

    {{-- Date --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Date</label>
        <input type="date" name="date"
            value="{{ $notice->date ?? '' }}"
            class="w-full border rounded-lg px-4 py-2">
    </div>

    {{-- Category --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Category</label>
        <select name="category"
            class="w-full border rounded-lg px-4 py-2">
            <option value="">Select Category</option>
            <option value="Admission" {{ ($notice->category ?? '') == 'Admission' ? 'selected' : '' }}>Admission</option>
            <option value="Events" {{ ($notice->category ?? '') == 'Events' ? 'selected' : '' }}>Events</option>
            <option value="Academic" {{ ($notice->category ?? '') == 'Academic' ? 'selected' : '' }}>Academic</option>
        </select>
    </div>

    {{-- Is New --}}
    <div class="mb-4 flex items-center gap-2">
        <input type="checkbox" name="is_new"
            {{ ($notice->is_new ?? false) ? 'checked' : '' }}>
        <label>Mark as New</label>
    </div>

    {{-- PDF Upload --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Upload PDF</label>
        <input type="file" name="file" accept=".pdf"
            class="w-full border rounded-lg px-4 py-2">
    </div>

    {{-- Submit --}}
    <div class="mt-6">
        <button type="submit"
            class="bg-primary-700 text-white px-6 py-2 rounded-lg hover:bg-primary-700 hover:text-white transition">
            Upload Notice
        </button>
    </div>

</form>
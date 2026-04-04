<div class="flex items-center justify-between gap-4 px-6 py-5 border-b hover:bg-blue-50 transition">

    {{-- LEFT --}}
    <div class="flex items-start gap-4">

        {{-- Icon --}}
        <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">
            📄
        </div>

        <div>
            <div class="flex items-center gap-2">

                <h3 class="font-semibold text-gray-800">
                    {{ $notice->title ?? 'Sample Notice Title' }}
                </h3>

                @if($notice->is_new ?? false)
                    <span class="text-xs px-2 py-0.5 bg-yellow-300 rounded-full">
                        NEW
                    </span>
                @endif

            </div>

            <div class="text-sm text-gray-500 mt-1">
                📅 {{ $notice->date ?? '1 Feb 2025' }}

                <span class="ml-3 px-2 py-0.5 bg-gray-100 rounded text-xs">
                    {{ $notice->category ?? 'General' }}
                </span>
            </div>
        </div>

    </div>

    {{-- RIGHT ACTIONS --}}
    <div class="flex items-center gap-3">

        {{-- VIEW PDF --}}
        @if(!empty($notice->file))
            <a href="{{ asset($notice->file) }}" target="_blank"
               class="text-blue-600 hover:underline text-sm">
                View
            </a>
        @else
            <span class="text-gray-300 text-sm">No File</span>
        @endif

        {{-- EDIT --}}
        <a href="{{ route('admin.edit.notice', $notice->id ?? 1) }}"
           class="text-green-600 hover:underline text-sm">
            Edit
        </a>

        {{-- DELETE --}}
        <a href="{{ route('admin.notice.delete', $notice->id ?? 1) }}"
           onclick="return confirm('Are you sure?')"
           class="text-red-600 hover:underline text-sm">
            Delete
        </a>

    </div>

</div>


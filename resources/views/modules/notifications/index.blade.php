@extends('layouts.app')

@section('content')

@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#3085d6'
    });
});
</script>
@endif

@if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function () {
    let errorMessages = `
        <ul style="text-align:center;">
            @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    `;

    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: errorMessages,
        confirmButtonColor: '#d33'
    });
});
</script>
@endif
    <div class="p-6">

        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Notifications Center
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage alerts and broadcast messages to schools.
            </p>
        </div>

        <!-- Main Panel -->
        <div class="flex justify-center">

            <!-- LEFT PANEL -->
            <form action="{{ route('notification.send') }}" method="POST" class="w-full max-w-2xl">
                @csrf
                <div class="bg-white rounded-2xl border border-gray-200 shadow-lg shadow-slate-200/70 p-6 sm:p-8">

                    <!-- Title -->
                    <div class="mb-7 flex items-center gap-4 border-b border-gray-100 pb-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-900 text-white shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l9-7 9 7-9 7-9-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">
                                Send Broadcast
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Create and send a notification to the selected recipients.
                            </p>
                        </div>
                    </div>

                    <!-- Recipient -->
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-600">
                            Recipient Group
                        </label>
                        <select name="reciver"  id="reciver"
                            class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Select Recipient</option>
                            @forelse (RecipientGroup() as $rec)
                                <option value="{{ $rec }}">{{ $rec }}</option>
                            @empty
                                <p class="text-center">No Recipient Group</p>
                            @endforelse
                        </select>

                    </div>

                    <div class="mb-4" id="hiddenfield">

                    </div>

                    <!-- Subject -->
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-600">
                            Subject
                        </label>
                        <input type="text" placeholder="Enter subject..." name="subject"
                            class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <label class="text-sm font-medium text-gray-600">
                            Message
                        </label>
                        <textarea rows="4" placeholder="Type your message here..." name="message"
                            class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-primary-900 text-white py-3 rounded-lg font-medium hover:bg-primary-800 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Send Notification
                    </button>

                </div>
            </form>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $("#reciver").on('change', function() {
                var opvalue = $(this).val();
                if (opvalue === "Principals Only") {
                    $('#hiddenfield').html(`
                        <label class="text-sm font-medium text-gray-600">
                           All Principale
                        </label>
                        <div class="mt-2 border rounded-lg p-3 max-h-40 overflow-y-auto">

                   @forelse (getPrincipale() as $pri)
                 <label class="flex items-center gap-2 mb-2">
                        <input type="checkbox" name="reciver[]" value="{{ $pri->official_email }}">
                        <span>{{ $pri->principle_name }}</span>
                    </label>
                @empty
                    <p class="text-center text-gray-500">No Recipient Group</p>
                @endforelse

                </div>
                `);
                }
                else if (opvalue === "Specific District") {
                    $('#hiddenfield').html(`
                       <label class="text-sm font-medium text-gray-600">
                           All District
                        </label>
                        <select name="reciver" id="reciver"
                            class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Select Recipient</option>
                            @forelse (SinglegetDisc() as $rec)
                                <option value="{{ $rec->official_email }}">{{ $rec->district }}</option>
                            @empty
                                <p class="text-center">No Recipient Group</p>
                            @endforelse
                        </select>
                `);
                } else {
                    $('#hiddenfield').html("");
                }

            });
        });
    </script>
@endsection

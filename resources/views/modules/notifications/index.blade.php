@extends('layouts.app')

@section('content')
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

        <!-- Main Grid -->
        <div class="grid grid-cols-3 gap-6">

            <!-- LEFT PANEL -->
            <form action="{{ route('send.email') }}" action="" method="POST">
                @csrf
                <div class="col-span-1 bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                    <!-- Title -->
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l9-7 9 7-9 7-9-7z" />
                        </svg>
                        <h2 class="font-semibold text-gray-800">
                            Send Broadcast
                        </h2>
                    </div>

                    <!-- Recipient -->
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-600">
                            Recipient Group
                        </label>
                        <select name="reciver"
                            class="w-full mt-2 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Select Recipient</option>
                            @forelse (RecipientGroup() as $rec)
                                <option value="{{ $rec }}">{{ $rec }}</option>
                            @empty
                            <p class="text-center">No Recipient Group</p>
                            @endforelse
                        </select>
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



            <!-- RIGHT PANEL -->
            <div class="col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm">

                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="font-semibold text-gray-800">
                        Recent Notifications History
                    </h2>
                </div>

                <div class="divide-y">

                    <!-- Notification Item 1 -->
                    <div class="p-6 flex justify-between items-start">

                        <div class="flex gap-4">

                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    System Maintenance Scheduled
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    The portal will be down for maintenance on Sunday, 2 AM - 4 AM.
                                </p>

                                <div class="flex items-center gap-4 mt-3 text-xs">
                                    <span class="bg-gray-100 px-2 py-1 rounded-md text-gray-600">
                                        Sent to: All Schools
                                    </span>
                                    <span class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Delivered
                                    </span>
                                </div>
                            </div>

                        </div>

                        <span class="text-xs text-gray-400">
                            2 hours ago
                        </span>

                    </div>


                    <!-- Notification Item 2 -->
                    <div class="p-6 flex justify-between items-start">

                        <div class="flex gap-4">

                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4M12 8h.01" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    New Policy Update
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Updated dietary guidelines have been uploaded to the documents section.
                                </p>

                                <div class="flex items-center gap-4 mt-3 text-xs">
                                    <span class="bg-gray-100 px-2 py-1 rounded-md text-gray-600">
                                        Sent to: All Schools
                                    </span>
                                    <span class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Delivered
                                    </span>
                                </div>
                            </div>

                        </div>

                        <span class="text-xs text-gray-400">
                            Yesterday
                        </span>

                    </div>


                    <!-- Notification Item 3 -->
                    <div class="p-6 flex justify-between items-start">

                        <div class="flex gap-4">

                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v4m0 4h.01M10.29 3.86l-7.12 12.3A2 2 0 004.9 19h14.2a2 2 0 001.73-2.84l-7.12-12.3a2 2 0 00-3.46 0z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    Urgent: Weather Alert
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    All schools in Patna district to remain closed tomorrow due to heavy rains.
                                </p>

                                <div class="flex items-center gap-4 mt-3 text-xs">
                                    <span class="bg-gray-100 px-2 py-1 rounded-md text-gray-600">
                                        Sent to: All Schools
                                    </span>
                                    <span class="text-green-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Delivered
                                    </span>
                                </div>
                            </div>

                        </div>

                        <span class="text-xs text-gray-400">
                            2 days ago
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

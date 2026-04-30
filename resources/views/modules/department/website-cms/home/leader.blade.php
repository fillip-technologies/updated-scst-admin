@extends('layouts.app')

@section('content')

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-primary-700">Department CMS</p>
                    <h1 class="mt-2 text-3xl font-semibold text-gray-800">Leader Message Module</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
                        Manage leader profile details and homepage message content for Minister, Secretary, and IAS Officer sections.
                    </p>
                </div>
            </div>
            <x-cms.department-website-cms.leader.leader-section :type="$type" :allleaders="$allleaders" />
        </div>
    </div>
@endsection

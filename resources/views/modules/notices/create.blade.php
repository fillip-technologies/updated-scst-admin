@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Page Title --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Add New Notice
    </h2>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow p-6">

        @include('modules.notices.components.form', [
            'action' => route('admin.notices.store'),
            'method' => 'POST',
            'notice' => null
        ])

    </div>

</div>

@endsection
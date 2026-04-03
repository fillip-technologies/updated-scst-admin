@extends('layouts.app')

@section('content')

    {{-- Header --}}
    @include('modules.notices.components.header')

    {{-- Notices List --}}
    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        @forelse($notices ?? [] as $notice)
            @include('modules.notices.components.notice-item', ['notice' => $notice])
           
        @empty
            @include('modules.notices.components.empty-state')
        @endforelse

    </div>

@endsection

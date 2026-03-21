@extends('layouts.app')

@section('content')

{{-- Header --}}
@include('modules.school-management.partials.header')

{{-- Filter Bar --}}
@include('modules.school-management.partials.filter-bar')

{{-- Table --}}
@include('modules.school-management.partials.table',['datas'=>$schools])

@endsection

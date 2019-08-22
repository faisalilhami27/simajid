@extends('layouts.app')
@section('title', 'Donatur')
@section('content')
    <div class="layout-content" id="donatur" data="{{ $checkAccess }}"></div>
@stop
@push('scripts')
@endpush

@extends('layouts.app')
@section('title', 'Struktur Organisasi')
@section('content')
    <div class="layout-content" id="struktur" data="{{ $checkAccess }}"></div>
@stop
@push('scripts')
@endpush

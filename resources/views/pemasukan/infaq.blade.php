@extends('layouts.app')
@section('title', 'Pemasukan Infaq')
@section('content')
    <div class="layout-content" id="pemasukan_infaq" data="{{ $checkAccess }}"></div>
@stop
@push('scripts')
@endpush

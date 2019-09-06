@extends('layouts.app')
@section('title', 'Pengeluaran Keuangan')
@section('content')
    <div class="layout-content" id="pengeluaran" data="{{ $checkAccess }}"></div>
@stop
@push('scripts')
@endpush

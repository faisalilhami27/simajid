@extends('layouts.app')
@section('title', 'Donatur')
@section('content')
    <div class="layout-content" id="donatur" data="{{ $isAdministrator }}"></div>
@stop
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#tanggal_lahir').css('width', '100%');
        })
    </script>
@endpush

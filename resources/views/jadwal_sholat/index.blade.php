@extends('layouts.app')
@section('title', 'Jadwal Sholat')
@section('content')
    <div class="layout-content" id="jadwal"></div>
@stop
@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function () {
                $('.warning').fadeOut(1000);
            }, 5000)
        })
    </script>
@endpush

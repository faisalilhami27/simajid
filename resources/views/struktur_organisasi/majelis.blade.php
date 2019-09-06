@extends('layouts.app')
@section('title', 'Struktur Organisasi Majelis Taklim')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            @if($checkAccess['create'])
                <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                        data-target="#infoModalColoredHeader" id="btn-edit"
                        style="margin-bottom: 10px"><i class="icon icon-pencil-square-o"></i> Edit
                </button>
            @endif
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Struktur Organisasi Majelis Taklim {{ mosqueName() }}</strong>
                        </div>
                        <div class="card-body">
                            <h4>SUSUNAN PENGURUS Majelis Taklim {{ strtoupper(mosqueName()) }}</h4>
                            <div class="show-data"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="infoModalColoredHeader" role="dialog" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-insert">Update Struktur Organisasi Majelis Taklim</h4>
                    </div>
                    <form class="form" method="post" id="form">
                        <div class="modal-body">
                            <textarea name="ckeditor1" id="ckeditor1"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                            <button class="btn btn-primary" id="btn-insert-data" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('ckeditor1');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{{ route('struktur.show_majelis') }}',
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('.show-data').html(data.data);
                    $(".pembina").html("Ketua DKM {{ mosqueName() }}");
                }
            });

            $('#btn-edit').click(function (e) {
                e.preventDefault();
                var kode = "majelis";
                $.ajax({
                    url: "{{ route('struktur.edit') }}",
                    type: "GET",
                    data: "kode=" + kode,
                    dataType: 'json',
                    success: function (data) {
                        CKEDITOR.instances['ckeditor1'].setData(data.list)
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#btn-insert-data").click(function (e) {
                e.preventDefault();

                let value = CKEDITOR.instances['ckeditor1'].getData();
                let kode = "majelis";

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: '{{ route('struktur.update') }}',
                    type: 'PUT',
                    data: {
                        "value" : value,
                        "kode" : kode
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        notification(data.status, data.msg);
                        $('#infoModalColoredHeader').modal('hide');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function (resp) {
                        if (_.has(resp.responseJSON, 'errors')) {
                            _.map(resp.responseJSON.errors, function (val, key) {
                                $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                            })
                        }
                        alert(resp.responseJSON.message)
                    }
                })
            })
        });
    </script>
@endpush

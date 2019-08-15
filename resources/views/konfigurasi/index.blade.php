@extends('layouts.app')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel m-b-lg">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active tab1"><a href="#home-11" data-toggle="tab"><h3><span class="icon icon-gear"></span> Data Konfigurasi <span class="icon icon-gear"></span></h3></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home-11">
                                <div class="demo-form-wrapper">
                                    <form class="form form-horizontal" id="frm-website" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Nama Mesjid</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="nama_perusahaan" autocomplete="off" maxlength="50" name="nama_perusahaan" value="{{ $konfig[2]->nilai_konfig }}" class="form-control" type="text" placeholder="Nama Perusahaan">
                                                    <span class="icon icon-building input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="nama_mesjid-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Ketua DKM</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="nama_pemilik" autocomplete="off" maxlength="50" name="nama_pemilik" value="{{ $konfig[1]->nilai_konfig }}" class="form-control" type="text" placeholder="Pemilik Perusahaan">
                                                    <span class="icon icon-user input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="ketua-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Versi Aplikasi</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="versi" autocomplete="off" name="versi" value="{{ $konfig[4]->nilai_konfig }}" maxlength="12" class="form-control" type="text" placeholder="Nomor Telepon Perusahaan">
                                                    <span class="icon icon-level-up input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="versi-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Reset Password</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <div class="input-group">
                                                        <input class="form-control form-password" id="password" value="{{ $konfig[3]->nilai_konfig }}" name="password" maxlength="12" minlength="8" type="password" placeholder="Password">
                                                        <span class="input-group-addon">
                                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                              <input class="custom-control-input form-checkbox" type="checkbox">
                                                              <span class="custom-control-indicator"></span>
                                                              <span class="custom-control-label">Show</span>
                                                            </label>
                                                          </span>
                                                        <span class="text-danger">
                                                        <strong id="password-error"></strong>
                                                    </span>
                                                    </div>
                                                    <span class="icon icon-lock input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-6">Alamat Mesjid</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <textarea id="alamat" name="alamat" class="form-control" maxlength="700" rows="3" placeholder="Alamat Perusahaan">{{ $konfig[0]->nilai_konfig }}</textarea>
                                                    <span class="icon icon-bookmark input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="alamat-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right" type="submit" class="btn btn-primary btn-sm" id="btn-update">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.form-checkbox').click(function(){
                if($(this).is(':checked')){
                    $('.form-password').attr('type','text');
                }else{
                    $('.form-password').attr('type','password');
                }
            });

            $("#btn-update").click(function (event) {
                event.preventDefault();

                var perusahaan = $("#nama_perusahaan").val();
                var pemilik = $("#nama_pemilik").val();
                var password = $("#password").val();
                var alamat = $("#alamat").val();
                var versi = $("#versi").val();
                var formData = new FormData();

                formData.append('nama_mesjid', perusahaan);
                formData.append('password', password);
                formData.append('versi', versi);
                formData.append('ketua', pemilik);
                formData.append('alamat', alamat);

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "{{ URL('konfigurasi/update') }}",
                    data: formData,
                    success: function (data) {
                        if (data.status == 200) {
                            notification(data.status, data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        } else if (data.status == 502) {
                            notification(data.status, data.msg);
                        }
                    },
                    error: function (resp) {
                        if (_.has(resp.responseJSON, 'errors')) {
                            _.map(resp.responseJSON.errors, function (val, key) {
                                $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                            })
                        }
                        alert(resp.responseJSON.message)
                    }
                });
            });


            $("#email").keyup(function (e) {
                e.preventDefault();
                var email = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('user/cekUsername') }}",
                    type: "GET",
                    data: "email=" + email,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#email-error").html("");
                            $("#email-error").css("color", "green");
                            $("#btn-insert-data").removeAttr('disabled');
                        } else {
                            $("#email-error").html(data.msg);
                            $("#email-error").css("color", "red");
                            $("#btn-insert-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });
        });
    </script>
@endsection

@extends('layouts.app')
@section('content')
    @if(Auth::guard('pengurus')->check())
        @if(!is_null(Auth::user()->id_pengurus))
            @php ($name = Auth::user()->pengurus->nama)
            @if(!is_null(Auth::user()->pengurus->foto))
                @php ($photo = url('storage/'.Auth::user()->pengurus->foto))
            @else
                @php ($photo = Avatar::create(Auth::user()->pengurus->nama)->toBase64())
            @endif
        @else
            @php ($name = Auth::user()->username)
            @php ($photo = Avatar::create(Auth::user()->username)->toBase64())
        @endif
    @endif
    <div class="layout-content" id="profile" data="{{ $photo }}" user="{{ $getUser }}"></div>

@stop
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.form-checkbox').click(function () {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });

            $('.form-checkbox1').click(function () {
                if ($(this).is(':checked')) {
                    $('.form-password1').attr('type', 'text');
                } else {
                    $('.form-password1').attr('type', 'password');
                }
            });

            $('input[type=file]').change(function () {
                var val = $(this).val().toLowerCase(),
                    regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
                if (!(regex.test(val))) {
                    $(this).val('');
                    alert('Format yang diizinkan png atau jpg');
                } else if (this.files[0].size > 1000024) {
                    $(this).val('');
                    $("#images-error").html("Maximum file size of 1 MB").fadeIn(1000).fadeOut(5000);
                    $("#images-error").css("color", "red");
                }
            });

            $("#form-reset").submit(function (e) {
                e.preventDefault();
                var password = $("#password").val();
                var konf_password = $("#konf_password").val();

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('profile/changePassword') }}",
                    type: "PUT",
                    data: "password=" + password + "&password_confirmation=" + konf_password,
                    dataType: "json",
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
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
                    url: "{{ URL('pengurus/cekEmail') }}",
                    type: "POST",
                    data: "email=" + email,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#email-error").html("");
                            $("#email-error").css("color", "green");
                            $("#btn-update-data").removeAttr('disabled');
                        } else {
                            $("#email-error").html(data.msg);
                            $("#email-error").css("color", "red");
                            $("#btn-update-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#username").keyup(function (e) {
                e.preventDefault();
                var username = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('user/cekUsername') }}",
                    type: "POST",
                    data: "username=" + username,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#username-error").html("");
                            $("#username-error").css("color", "green");
                            $("#btn-update-data").removeAttr('disabled');
                        } else {
                            $("#username-error").html(data.msg);
                            $("#username-error").css("color", "red");
                            $("#btn-update-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#no_hp").keyup(function (e) {
                e.preventDefault();
                var noHp = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('pengurus/cekNoHp') }}",
                    type: "POST",
                    data: "noHp=" + noHp,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#no_hp-error").html("");
                            $("#no_hp-error").css("color", "green");
                            $("#btn-update-data").removeAttr('disabled');
                        } else {
                            $("#no_hp-error").html(data.msg);
                            $("#no_hp-error").css("color", "red");
                            $("#btn-update-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $(function () {

                // We can attach the `fileselect` event to all file inputs on the page
                $(document).on('change', ':file', function () {
                    var input = $(this),
                        numFiles = input.get(0).files ? input.get(0).files.length : 1,
                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [numFiles, label]);
                });

                // We can watch for our custom `fileselect` event like this
                $(document).ready(function () {
                    $(':file').on('fileselect', function (event, numFiles, label) {

                        var input = $(this).parents('.input-file').find(':text'),
                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                        if (input.length) {
                            input.val(log);
                        } else {
                            if (log) alert(log);
                        }

                    });
                });
            });
        });

        function loadingBeforeSend() {
            $("#btn-update-data").attr('disabled', 'disabled');
            $("#btn-update-data").text('Menyimpan data....');
        }

        function loadingAfterSend() {
            $("#btn-update-data").removeAttr('disabled');
            $("#btn-update-data").text('Submit');
        }
    </script>
@endpush

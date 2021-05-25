<!DOCTYPE html>
<!-- saved from url=(0028)https://ag.ambsuperslot.com/ -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="utf-8"><meta name="viewport" content="width=1480"><meta http-equiv="x-ua-compatible" content="ie=edge"><title>
	REWARD
</title>
<link rel="icon" href="{{ asset('img/logo.png') }}" type="image">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<style>
.waves-input-wrapper {
    display: block !important;
}
</style>
<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style><style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style><script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script></head>
<body class="login-page" aria-busy="true">
    <div id="myModalLoad" class="modal" data-backdrop="static" data-keyboard="false">
        <div class="d-flex justify-content-center" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #CFA137 !important;">
            <div class="spinner-border" role="status" style="width: 10rem; height: 10rem; font-size: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <form id="form-login" method="POST" action="{{ route('Auth.loginSave') }}" class="login-page">
        @csrf
        <div class="wrapper container h-100 d-flex justify-content-center align-items-center">
            <div class="login-section">
                <div class="card">
                    {{-- <div class="login-footer pt-4" style="padding-top: 1rem !important; border-bottom: 1px #fff solid; padding-bottom: 1rem !important;">
                        <a style="color: #fff;" id="txtLan">English<img src="img/Flag/usa.png" style="width: 20px; margin-left: .4rem;"></a>
                        <div id="divblock" style="display: none; left: 8rem;">
                            <div style="border-bottom: 1px #ddd solid; padding: 3px;">
                                <a onclick="SetLanguage(&#39;Thai&#39;);">
                                    <img src="./Agent Super Slot_files/thailand.png" style="width: 20px;"> ไทย
                                </a>
                            </div>
                            <div style="border-bottom: 1px #ddd solid; padding: 3px;">
                                <a onclick="SetLanguage(&#39;English&#39;);">
                                    <img src="./Agent Super Slot_files/usa.png" style="width: 20px;"> English
                                </a>
                            </div>
                        </div>
                        <a href="#" class="nav-link" set-lan="html:Mobile Version" style="color: #fff;"><i class="fas fa-mobile"></i>&nbsp;Mobile Version</a>
                    </div> --}}
                    <div class="card-header text-center">
                        <a href="#" class="logo mx-auto">
                            <img src="{{ asset('img/Reward.png') }}" alt="logo">
                        </a>
                        <div class="card-header-text" set-lan="html:We are the future of gaming" style="font-size: 16pt;">We are the future of Support-REWARD</div>
                    </div>
                    <div class="card-body">
                        <div class="card-body-holder">
                            <div class="form-group row mb-4">
                                <div class="col-12">
                                    <div class="md-form md-outline">
                                        <input type="text" id="user" name="user" value="{{ old('user') }}" class="form-control form-control-lg mb-0" autocomplete="off" onkeypress="clsAlphaNoOnly(event)" maxlength="30">
                                        <label for="user" class="label" set-lan="html:Username">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-12">
                                    <div class="md-form md-outline">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg mb-0" autocomplete="off" maxlength="24">
                                        <label for="password" class="label" set-lan="html:Password">Password</label>
                                        <span toggle="#password" class="toggle-password field-icon"><i class="far fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-12">
                                    <button class="btn btn-lg btn-yellow font-weight-bold btn-block waves-effect waves-light" type="submit" set-lan="text:Sign in">Sign In</button>
                                </div>
                            </div>
                            <div class="note-text white-text text-center">
                                <span style="font-size: 9pt;" set-lan="html:Contact your associate in case you forgot the password or unable to sign in"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3 text-center">
                        <label id="lbAlert"></label>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-yellow font-weight-bold waves-effect waves-light" data-dismiss="modal" aria-label="Close" set-lan="text:Close">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLanguage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 250px !important;">
                <div class="modal-content" style="background-color: #66667A;">
                    <div class="modal-body mx-3 text-center">
                        <a onclick="SetLanguage(&#39;Thai&#39;);">
                            <div class="row">
                                <div class="col-md-10" style="color: #fff; text-align: right;">ไทย</div>
                                <div class="col-md-2">
                                    <img src="./Agent Super Slot_files/thailand.png" style="width: 27px;">
                                </div>
                            </div>
                        </a>
                        <a onclick="SetLanguage(&#39;English&#39;);">
                            <div class="row" style="margin-top: .3rem;">
                                <div class="col-md-10" style="color: #fff; text-align: right;">English</div>
                                <div class="col-md-2">
                                    <img src="./Agent Super Slot_files/usa.png" style="width: 27px;">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script>-->
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- ACE core JavaScript -->
    <!-- <script type="text/javascript" src="{{ asset('js/ace.min.js') }}"></script> -->
    <!-- Language core JavaScript -->
    <!-- <script type="text/javascript" src="{{ asset('js/language_Login.js') }}"></script> -->
    <script type="text/javascript">
        $("#form-login").on("submit", function(e){
            e.preventDefault();

            if ($('#user').val().trim() == "") {
                $("#lbAlert").html("missing 'Username' field");
                $('#modalAlert').modal('show');
                $("#myModalLoad").modal('hide');
            }
            else if ($('#password').val().trim() == "") {
                $("#lbAlert").html("missing 'Password' field");
                $('#modalAlert').modal('show');
                $("#myModalLoad").modal('hide');
            } else {
                $.ajax({
                    url: "{{route('Auth.loginAjax')}}",
                    dataType: "json",
                    type: "POST",
                    data: new FormData(this),
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#myModalLoad').modal('show');
                    },
                    success: function(res) {
                        if( res.status == 1 ) {
                            window.location.href = res.url
                        } else {
                            $("#lbAlert").html(res.mgs);
                            $("#myModalLoad").modal('hide');
                            $('#modalAlert').modal('show');
                        }
                    },
                    error: function (xhr, status, error) {
                        $("#myModalLoad").modal('hide');
                        $("#lbAlert").html("Plese Login again");
                        $('#modalAlert').modal('show');
                        setTimeout(function(){ location.reload() }, 1000);

                    },
                });
            }

        });
    </script>


</body></html>

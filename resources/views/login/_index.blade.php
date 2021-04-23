<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>PTGACC | LOGIN</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('theme/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ asset('theme/mdb/css/mdb.min.css') }}" rel="stylesheet">
  <!-- landing-page -->
  <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">

{{-- <style>

    html,
        body,
        header,
        .view {
          height: 100vh;
        }

        @media (max-width: 740px) {
          html,
          body,
          header,
          .view {
            height: 815px;
          }
        }

        @media (min-width: 800px) and (max-width: 850px) {
          html,
          body,
          header,
          .view  {
            height: 650px;
          }
        }

        .top-nav-collapse {
            background-color: #3f51b5 !important;
        }
        .navbar:not(.top-nav-collapse) {
            background: transparent !important;
        }
        @media (max-width: 768px) {
            .navbar:not(.top-nav-collapse) {
                background: #3f51b5 !important;
            }
        }
        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #3f51b5!important;
            }
        }

        h6 {
            line-height: 1.7;
        }


        .card {
            margin-top: 30px;
            /*margin-bottom: -45px;*/

        }

        .md-form .form-control {
            color: #fff;
        }


</style> --}}

<style>
.waves-input-wrapper {
    display: block !important;
}
</style>
<style>
    /* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
</style>
<style type="text/css">/* Chart.js */
 @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
 </style>
</head>

<body class="login-page" aria-busy="true">

    {{-- Loader --}}
    <div id="myModalLoad" class="modal" data-backdrop="static" data-keyboard="false">
        <div class="d-flex justify-content-center" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #CFA137 !important;">
            <div class="spinner-border" role="status" style="width: 10rem; height: 10rem; font-size: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    









    <!--Main Navigation-->
    <header>
      <!--Intro Section-->
      <section class="login-section view bg-white">
        <div class="mask h-100 d-flex justify-content-center align-items-center">
          <div class="container">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

                <!--Form with header-->
                <div class="card ptg-card-login wow fadeIn" data-wow-delay="0.3s">
                  <div class="card-body ptg-card-body">

                    <div class="ptg-header-login">
                      <img src="{{ asset('images/logo.png') }}" alt="logo">
                      <div class="card-header-text">Agent Management Website</div>
                    </div>

                    <!--Body-->
                    <div class="card-body-holder">
                      <form method="POST" action="{{ route('Auth.loginSave') }}">
                        @csrf
                        <div class="md-form">
                          <input type="text" id="user" name="user" value="{{ old('user') }}" id="orangeForm-name" class="form-control form-control-lg mb-0" autocomplete="off">
                          <label for="orangeForm-name">Username</label>
                        </div>
                        <div class="md-form">
                          <input type="password" id="password" name="password" class="form-control form-control-lg mb-0" autocomplete="off">
                          <label for="password">Password</label>
                          <span toggle="#password" class="toggle-password field-icon"><i class="far fa-eye"></i></span>
                        </div>
                        @if ($errors->any())
                            <p class="text-center" style="color:#F7F015">

                                    @foreach ($errors->all() as $error)
                                        ! {{ $error }}
                                    @endforeach

                            </p>
                        @endif

                        <div class="text-center">
                          <button class="btn btn-lg btn-yellow font-weight-bold btn-block waves-effect waves-light mb-4">Sign In</button>
                          <div class="note-text white-text text-center">
                            <span>Contact your associate in case you forgot the password or unable to sign in</span>
                          </div>
                        </div>
                    </div>

                  </div>
                </div>
                <!--/Form with header-->

              </div>
            </div>
          </div>
        </div>
      </section>

    </header>
    <!--Main Navigation-->


    <!--  SCRIPTS  -->
    <script type="text/javascript" src="{{ asset('theme/mdb/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/mdb/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/mdb/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/mdb/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/default.js') }}"></script>
    <script>
      $(document).ready(() => {
        new WOW().init();
      });
    </script>
</body>

</html>

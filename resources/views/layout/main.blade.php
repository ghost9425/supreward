
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" /><meta name="viewport" content="width=1480" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PTGACC</title>
    <link rel="icon" href="{{asset("img/logo.png")}}"/>
    <link rel="stylesheet" href={{ asset('https://use.fontawesome.com/releases/v5.8.2/css/all.css')}} />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" />
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/marquee.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}"  />
</head>
<style>
table.table .btn.btn-yellow {
    white-space: nowrap;
}
</style>
@yield('css')
<body class="fixed-sn">
    <div id="myModalLoad" class="modal" data-backdrop="static" data-keyboard="false" style="z-index: 9999">
        <div class="d-flex justify-content-center" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #008F6B !important;">
            <div class="spinner-border" role="status" style="width: 7rem; height: 7rem; font-size: 4rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="C5zXf1zHqcWc/P5jP9tzn+I70crrU9GNnYsSYr8fes0T2iXSmwQCFqrzfEAFFH3pVEkgp6yLaipIc5baE9YWd6JO2zzFZBYoNvC7bixWFWOYVkOraYhtZGsNTTssx8IbgU14B2rdGMKVKgnbLbXP5RMT3aMeUk4uu1re9+c5buH5FiFiXECiS0OBd2UnvDwhG/7B0pQf8ixRpHvQ28Zy4A==" />
    </div>

    <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="EE3D7583" />
    </div>
    <div class="wrapper container">
        <header>
            <!-- Header navigation -->
            <nav class="navbar navbar-light white p-0 fixed-top">
                <a class="navbar-brand logo">
                    <img src="{{ asset('img/Reward.png') }}" id="imgLogin">
                </a>
                <div class="navbar-panel-box">
                    <div class="navbar-panel d-flex justify-content-between">
                    </div>
                    <div class="simple-marquee-container">
                        <marquee class="marqueetxt" style="color: #fff; padding-top: 3px;"></marquee>
                    </div>
                </div>
            </nav>
            <!--/. Header navigation -->
            <!-- Sidebar navigation -->
            @include('layout.menu-left')
            <!--/. Sidebar navigation -->
        </header>
    <main>
        <div class="body-content">
            @yield("content")
        </div>
    </main>

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

    <style>
        .HeadFont {
            font-size: 2rem;
        }

        .borderTab {
            border-left: 2px solid #dee2e6 !important;
            border-bottom: 2px solid #dee2e6 !important;
            border-right: 2px solid #dee2e6 !important;
        }
    </style>
    <script type="text/javascript" src="{{ asset('theme/mdb/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('theme/mdb/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/accessibility.js') }}"></script>
    <!-- ACE core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/ace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/default.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/highcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/series-label.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/exporting.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/export-data.js') }}"></script>
    @yield('js')
</body>
</html>

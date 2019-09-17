<!DOCTYPE html>
<html lang="en" >
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Truffle 2 | @yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('assets/media/fav.ico') }}">
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="{{ asset('assets/webfont/1.6.16/webfont.js')}}"></script>
        <script>
            WebFont.load({
                google: {"families":["Poppins:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        @yield('css')
        <link href="{{ asset('assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/overrides.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/styleH.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/header-override.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/responsiveH.css') }}" rel="stylesheet" type="text/css" />
        <style>
            body{
                /* background-image: url(http://demo.truffle.klientaccounts.com/assets/images/bg-1.jpg) !important; */
            }
        </style>
        <style rel="stylesheet" media="print">

            @media print {
                #print-content *{ /* Replace class_name with * to target all elements */
                    -webkit-print-color-adjust: exact;
                            print-color-adjust: exact; /* Non-Webkit Browsers */
                    /* position: absolute;
                    left: 0;
                    top: 0; */
                    visibility: visible;
                }
                body * {
                    visibility: hidden;
                }
            }
            #print-content{
                color:black;
                font-family: Consolas!important;
                }
        </style>
        <style>
            body {
                    counter-reset: list;
                }
            .true-type{
                color: blue;
                font-weight: 800;
            }
            .false-type{
                color: red;
                font-weight: 800;

            }
            .list_sn::before {
                counter-increment: list;
                content: counter(list);
            }
            /* Loader */
            .loader-wrap {
                background: rgba(89,71,53,.6);
                position: fixed;
                overflow: hidden;
                height: 100%;
                width: 100%;
                z-index:100;
                display:none;
            }

            .loader {
                top: 50%;
                -webkit-transform: translate3d(-50%,-50%, 0);
                transform: translate3d(-50%,-50%, 0);
                margin: 0 auto;
                width: 32px;
                height: 32px;
                position: relative;
            }

            .cube1,
            .cube2,
            .cube3,
            .cube4,
            .cube5 {
                background-color: #000;
                width: 10px;
                height: 10px;
                position: absolute;
                top: 20px;
                left: 0;
                opacity: 0;

                -webkit-animation: cubemove 2s infinite ease-in-out;
                animation: cubemove 2s infinite ease-in-out;
            }

            .cube2 {
                -webkit-animation-delay: -0.5s;
                animation-delay: -0.5s;
            }

            .cube3 {
                -webkit-animation-delay: -1s;
                animation-delay: -1s;
            }

            .cube4 {
                -webkit-animation-delay: -1.5s;
                animation-delay: -1.5s;
            }
            .cube5 {
                -webkit-animation-delay: -2s;
                animation-delay: -2s;
            }

            @keyframes cubemove {
                0% {
                    -webkit-transform: translateX(-120px);
                    transform: translateX(-120px);
                }
                50% {
                    -webkit-transform: translateX(0px) rotate(180deg) scale(2.2);       background: #5f5342;
                    opacity: 1;
                }
                100% {
                    -webkit-transform: translateX(120px);
                    transform: translateX(120px);
                }
            }
            /* Loader */

        </style>
         <style>
        .drop-btn{
            display: block !important;
            background: none;
            outline: none;
            border: none;
        }
    </style>
    </head>
    <body  class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--left kt-aside--fixed kt-page--loading"  >
        <div id="main-content">
            <div class="loader-wrap" >
                <div class="loader">
                    <div class="cube1"></div>
                    <div class="cube2"></div>
                    <div class="cube3"></div>
                    <div class="cube4"></div>
                    <div class="cube5"></div>
                </div>
            </div>
            <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
                <div class="kt-header-mobile__logo">
                    <a href="{{route('home')}}" class="truffle-logo">
                        <img alt="Logo" src="{{ asset('assets/media/logo.png') }}"/>
                    </a>
                </div>
                <div class="kt-header-mobile__toolbar">
                    <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                    <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
                    <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
                </div>
            </div>

            <div class="kt-grid kt-grid--hor kt-grid--root">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                        @include('layouts.components.header')
                        @include('layouts.components.aside')

                        <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                                <div class="kt-container  kt-grid__item kt-grid__item--fluid mt-30">

                                    @yield('content')
                                </div>
                            </div>
                        </div>
                        <div class="kt-footer kt-grid__item" id="kt_footer">
                            <div class="kt-container ">
                                <div class="kt-footer__wrapper">
                                    <div class="kt-footer__copyright">
                                        2019&nbsp;&copy;&nbsp;<a href="https://klientsoft.com" target="_blank" class="kt-link">Klientsoft</a>
                                    </div>
                                    <div class="kt-footer__menu">
                                        <a href="https://klientsoft.com/about" target="_blank" class="kt-link">About</a>
                                        <a href="https://klientsoft.com/contact" target="_blank" class="kt-link">Contact</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar Right -->

            <!-- Sidebar Right-->
                @include('layouts.components.sidebar')
            <!-- Sticky nav -->
                @include('layouts.components.stickynav')
            <!-- Sticky nav -->


            <!-- Modal for Birthday Wish -->
            <div class="modal right fade" id="email-notification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                <div class="modal-dialog" role="document" style="padding: 0 !important;">
                    <div class="modal-content">
                        <form action="{{ route('email.notification') }}" method="POST">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel2">Birthday Wish:</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                                @csrf
                            <div class="modal-body" id="notification-email-form">

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div><!-- modal-content -->
                    </form>
                </div><!-- modal-dialog -->
            </div><!-- modal -->
            @yield('modals')
            <!-- Notification Email Modal -->
        </div><!--Main Content-->
        @yield('print')
        <!-- End Modal -->
        <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#591df1","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};

        </script>

        <script src="{{ asset('assets/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/custom/main.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/form.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/custom/jquery.migration.js') }}" type="text/javascript"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script>var base_url ="{{ url('/') }}";</script>
        @yield('js')
        <script type="text/javascript">
            $(document).on('click', '.birthday-notification', function(e) {
                e.stopPropagation();
                e.preventDefault();
                var name = $(this).data('name');
                var email = $(this).data('email');

                $.ajax({
                    url: base_url+'/birthday-notification-form',
                    type: 'POST',
                    data: {name:name, email:email},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                            $('#notification-email-form').html(data.html);
                            $('#email-notification').modal('show')
                    }
                });
            });
            $(document).on('change','.bill-setting',function(e){
                var value=0;
                var key=$(this).data('key')
                if ($(this).is(':checked')) {
                    value=1;
                }else{
                    value=0;
                }
                $.ajax({
                    method: "POST",
                    url: '/quick-software-setting/update',
                    data: {
                        key: key,
                        value: value
                    }
                })

            })
            function showLoader(){
                Swal.fire({
                            title: 'Please wait',
                            text: 'Loading...',
                            type: 'info',
                            showConfirmButton: false,
                            allowOutsideClick:false,
                            allowEscapeKey:false
                        })
            }
            function removeLoader(){
                Swal.close()
            }
        </script>
    </body>
</html>

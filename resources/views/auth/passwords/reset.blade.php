
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<!DOCTYPE html>
<html lang="en" >
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>
        <title>Truffle</title>
        <link rel="shortcut icon" href="{{ asset('assets/media/fav.ico') }}">
        <meta name="description" content="Latest updates and statistic charts"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="{{ asset('assets/webfont/1.6.16/webfont.js') }}"></script>
        <script>
            WebFont.load({
                google: {"families":["Poppins:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <!-- page specific -->
        <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" />
        <!-- page specific -->
        <link href="{{ asset('assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body  class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--left kt-aside--fixed kt-page--loading"  >
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
					<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{ asset('assets/media/bg.jpe')}}); position: relative;">
						<div class="kt-grid__item">
							<a href="#" class="kt-login__logo">
								<img src="{{ asset('assets/media/logo.png') }}">
							</a>
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
							<div class="kt-grid__item kt-grid__item--middle">
								<h3 class="kt-login__title">Welcome to Truffle!</h3>
								<h4 class="kt-login__subtitle kt-font-bold">Truffle is a restaurant management software designed to be used for restaurants of all sizes. The software was developed using the help of different restaurants, by understanding their requirements and implementing them in the most intuitive manner.</h4>
							</div>
						</div>
						<div class="kt-grid__item">
							<div class="kt-login__info">
								<div class="kt-login__copyright kt-font-bold" style="z-index: 2;">
									&copy 2018 Klientscape Software Pvt. Ltd.
								</div>
								<div class="kt-login__menu" style="z-index: 2;">
									<a href="#" class="kt-link kt-font-bold">Privacy</a>
									<a href="#" class="kt-link kt-font-bold">Legal</a>
									<a href="#" class="kt-link kt-font-bold">Contact</a>
								</div>
							</div>
						</div>
						<div id="overlay"></div>
					</div>
					<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
						<div class="kt-login__head">
							<span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
							<a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>
						</div>
						<div class="kt-login__body">
							<div class="kt-login__form">
								<div class="kt-login__title">
									<h3>Reset Password</h3>
								</div>			
                                <form class="kt-form" method="POST" action="{{ route('password.update') }}" novalidate="novalidate">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <input type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Email" >
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Email" readonly >

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
									</div>
                                    <div class="form-group row">
                                       
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password" autofocus>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group row">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="Confirm Password" >
                                        
                                    </div>
									<div class="kt-login__actions">
										@if (Route::has('password.request'))
											<a class="kt-link kt-login__link-forgot" href="{{ route('password.request') }}">
												{{ __('Forgot Password ?') }}
											</a>
										@endif
										
										<button type="submit" id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Reset Password</button>
									</div>
								</form>
								<div class="kt-login__divider">
									<div class="kt-divider">
										<span></span>
										<span>Powered By</span>
										<span></span>
									</div>
								</div>
								<div class="kt-login__options">
									<a href="#">
										<img src="{{ asset('assets/media/company-logo.png')}}" width="120">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#591df1","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
        </script>
	    <script src="{{ asset('assets/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
	    <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
	    <!-- page specific -->

        <!-- page specific -->
    </body>
</html>

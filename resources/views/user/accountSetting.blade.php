@extends('layouts.app')
@section('title', 'Account Setting')
@section('content')
  

<div class="row">
    <div class="col-lg-6 col-md-6">
        <form class="kt-form" id="kt_form" action="{{ route('change.password.store') }}" method="post">
            @csrf
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Change Password</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    <a href="#" class="btn btn-clean kt-margin-r-10" onclick="window.history.back(0);">
                    <i class="la la-arrow-left"></i>
                    <span class="kt-hidden-mobile">Back</span>
                    </a>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">Save</span>
                        </button>
                        <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-reload"></i>
                                <span class="kt-nav__link-text">Save & continue</span>
                                </a>
                                </li>
                                <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-power"></i>
                                <span class="kt-nav__link-text">Save & exit</span>
                                </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label"> Old Password</label>
                                    <div class="col-9">
                                        <input class="form-control @if(Session::has('old_password')) is-invalid @endif " type="password" name="old_password" placeholder="Old Password" required>
                                        @if(Session::has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ Session::get('old_password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label"> New Password</label>
                                    <div class="col-9">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="New Password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label"> Confirm Password</label>
                                    <div class="col-9">
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-6 col-md-6">
        <form class="kt-form" id="kt_form" action="{{ route('change.pin.store') }}" method="post">
            @csrf
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Change Pin</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    <a href="#" class="btn btn-clean kt-margin-r-10" onclick="window.history.back(0);">
                    <i class="la la-arrow-left"></i>
                    <span class="kt-hidden-mobile">Back</span>
                    </a>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-brand">
                        <i class="la la-check"></i>
                        <span class="kt-hidden-mobile">Save</span>
                        </button>
                        <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-reload"></i>
                                <span class="kt-nav__link-text">Save & continue</span>
                                </a>
                                </li>
                                <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-power"></i>
                                <span class="kt-nav__link-text">Save & exit</span>
                                </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Password</label>
                                    <div class="col-9">
                                        <input class="form-control @if(Session::has('password_error')) is-invalid @endif " type="password" name="password" placeholder="Password" required>
                                        @if(Session::has('password_error'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ Session::get('password_error')}}</strong>
                                            </span>
                                      @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label"> New Pin</label>
                                    <div class="col-9">
                                        <input class="form-control @error('pin') is-invalid @enderror" type="number" name="pin" placeholder="New Pin" min=1000 max=9999  required>
                                        @error('pin')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label"> Confirm Pin</label>
                                    <div class="col-9">
                                        <input class="form-control" type="number" name="pin_confirmation" placeholder="Confirm Pin" min=1000 max=9999 required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>




@endsection

@section('css')

@endsection

@section('js')
@endsection

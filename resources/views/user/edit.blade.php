@extends('layouts.app')
@section('title', 'Edit User')
@section('content')

    <form class="kt-form" id="kt_form" action="{{ route('user.update') }}" method="post">
        @csrf
        <input type="hidden" name="username" value="{{ $user->username }}">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Sticky Form Actions <small>try to scroll the page</small></h3>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <h3 class="kt-section__title kt-section__title-lg">user Info:</h3>
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label"> Username</label>
                                            <div class="col-9">
                                                <input class="form-control" type="text" value="{{ $user->name }}" name="fullname"  disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-3 col-form-label">Contact Phone</label>
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone  ?? old ('phone')}}" placeholder="Phone" aria-describedby="basic-addon1" name="phone" required>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Address</label>
                                    <div class="col-9" >
                                        <input class="form-control" type="text" name="address" value="{{ $user->address ?? old ('address') }}" placeholder="address" required>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Role</label>
                                    <div class="col-9">
                                        <select class="form-control kt-selectpicker @error('role') is-invalid @enderror" name="role" data-live-search="true" required>
                                            <option disabled>Select Any</option>
                                            <option value="bar" @if($user->role == 'bar') checked @endif>Bar</option>
                                            <option value="kitchen" @if($user->role == 'kitchen') checked @endif>Kitchen</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-3 col-form-label">Status </label>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                        <label class="kt-option">
                                    <span class="kt-option__control">
                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                            <input type="radio" name="status" value="0" @if($user->status == 0) checked @endif>
                                                <span></span>
                                        </span>
                                     </span>
                                            <span class="kt-option__label">
                                  <span class="kt-option__head">
                                      <span class="kt-option__title">Inactive</span>

                                            </span>
                                 </span>
                                        </label>
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                                        <label class="kt-option">
                                    <span class="kt-option__control">
                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                            <input type="radio" name="status" value="1" @if($user->status == 1) checked @endif>
                                                <span></span>
                                        </span>
                                     </span>
                                            <span class="kt-option__label">
                                  <span class="kt-option__head">
                                      <span class="kt-option__title">Active</span>

                                            </span>
                                 </span>
                                        </label>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Pin</label>
                                    <div class="col-9">
                                        <input class="form-control @error('pin') is-invalid @enderror" type="number" value="{{$user->pin ?? old ('pin')}}" name="pin" placeholder="******" required>
                                        @error('pin')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@section('css')

    <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>
@endsection


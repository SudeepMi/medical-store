@extends('layouts.app')
@section('title','Create Debtor')
@section('content')
<form class="kt-form" id="kt_form" method="POST" action="{{route('debtor.store')}}">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Add Debtor</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="btn-group hcustom-btn">
                            <button class="btn btn-brand" type="submit">
                                <i class="la la-check"></i>
                                <span class="kt-hidden-mobile">Save</span>
                            </button>
                            <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <button class="kt-nav__link drop-btn" type="submit" value="0" name="ref">
                                            <i class="kt-nav__link-icon flaticon2-reload"></i>
                                            <span class="kt-nav__link-text">Save & continue</span>
                                        </button>
                                    </li>
                                    <li class="kt-nav__item">
                                        <button class="kt-nav__link drop-btn" type="submit" value="1" name="ref">
                                            <i class="kt-nav__link-icon flaticon2-power"></i>
                                            <span class="kt-nav__link-text">Save & exit</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-xl-12 col-xs-12 col-md-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Name" value="{{ $name ?? old('name') }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Email-->
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" placeholder="Email" value="{{ $email ?? old('email') }}" required>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="number" placeholder="Phone" value="{{ $phone ?? old('phone') }}" required>
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
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

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
    <script>

    </script>
@endsection

@extends('layouts.app')
@section('title', 'Create User')
@section('content')

<!-- //Create -->
<form class="kt-form" id="kt_form" method="POST" action="{{ route('user.store') }}">
@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg hposition">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Create User</h3>
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
                        <div class="col-12 col-sm-12 col-xl-12 col-xs-12 col-md-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <!-- <h3 class="kt-section__title kt-section__title-lg">Create User:</h3> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >Name</label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $name ?? old('name') }}" name="name" placeholder="Name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label > Username</label>
                                                <input class="form-control @error('username') is-invalid @enderror" type="text" value="{{ $username ?? old('username') }}" name="username" placeholder="Username" required>
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label >Phone</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $phone ?? old('phone') }}" placeholder="Phone" aria-describedby="basic-addon1" name="phone" required>
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                               
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" placeholder="Email" aria-describedby="basic-addon1" name="email" required>
                                                    </div>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                
                                            </div>
                                            

                                            
                                        </div>
                                        <div class="col-md-6">
                                           
                                            <div class="form-group">
                                                <label >Address</label>
                                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{ $address ?? old('address') }}" placeholder="Address" required>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control kt-selectpicker @error('role') is-invalid @enderror" name="role" data-live-search="true" required>
                                                    <option disabled selected>Select Any</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Staff</option>

                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label >Pin</label>                                                
                                                <input class="form-control @error('pin') is-invalid @enderror" type="number" value="{{ $pin ?? old('pin') }}" name="pin" placeholder="Pin" min=1111 max=9999 required>
                                                @error('pin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                           
                                            </div>
                                            <div class="form-group">
                                                <label >Employee Discount</label>                                                
                                                <input class="form-control @error('discount') is-invalid @enderror" type="number" value="{{ $discount ?? old('discount') }}" name="discount" placeholder="Employee Discount" min=1 max=100>
                                                @error('discount')
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
@endsection

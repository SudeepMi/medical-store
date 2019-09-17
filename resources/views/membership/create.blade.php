@extends('layouts.app')
@section('title','Create Member')
@section('content')
<form class="kt-form" id="kt_form" method="POST" action="{{route('membership.store')}}">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Member</h3>
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
                                            <div class="col-md-6">
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label>Membership Type</label>
                                                    <select class="form-control @error('type') is-invalid @enderror" name="type" id="membership-type" required>
                                                        <option value="0" @if(old('type')==0) selected @else @endif>Free</option>
                                                        <option value="1" @if(old('type')==1) selected @else @endif>Paid</option>
                                                    </select>
                                                   @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Membership Fee-->
                                                @if(old('type')==1)
                                                    <div class="form-group" id="membership-fee">
                                                        <label>Membership Fee</label>
                                                        <input class="form-control @error('membership_fee') is-invalid @enderror" name="membership_fee" type="number" placeholder="Membership Fee" value="{{ $membership_fee ?? old('membership_fee') }}" required>
                                                        @error('membership_fee')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                @else
                                                <div class="form-group" id="membership-fee"></div>
                                                @endif

                                                <div class="form-group">
                                                    <label>Issued Date</label>
                                                    <input type="text" class="form-control @error('issued_at') is-invalid @enderror" name="issued_at"  value="{{ $issued_at ?? old('issued_at') }}" required>

                                                    @error('issued_at')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Expirey Date</label>
                                                    <input type="text" class="form-control @error('expires_at') is-invalid @enderror" name="expires_at" value="{{ $expires_at ?? old('expires_at') }}" required>
                                                    @error('expires_at')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>DOB</label>
                                                    <input type="text" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ $dob ?? old('dob') }}" required>
                                                    @error('dob')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Threshold Discount -->
                                                <div class="form-group">
                                                    <label>Threshold Discount</label>
                                                    <select class="form-control kt-selectpicker" name="thresholds[]" data-live-search="true" multiple>
                                                        @foreach($thresholds as $threshold)
                                                            <option value="{{$threshold->slug}}">{{$threshold->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- Threshold Discount -->
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
    $(document).on('change','select[name="type"]',function(){
        var content=''
        if($(this).val()==1){
            content+='<label>Membership Fee</label>'
            content+='<input class="form-control" name="membership_fee" type="number" placeholder="Membership Fee" min=1 required>'

        }
        $('#membership-fee').html(content)
    })
        $('input[name="issued_at"]').daterangepicker({
            singleDatePicker: true,
            opens: 'right',
            minDate: moment(),
            locale: {
                format: 'Y-MM-DD'
            }


        },function(start, end, label) {
            $('input[name="expires_at"]').daterangepicker({
                singleDatePicker: true,
                opens: 'right',
                minDate: start,
                locale: {
                    format: 'Y-MM-DD'
                }

            });
        });
        $('input[name="expires_at"]').daterangepicker({
            singleDatePicker: true,
            opens: 'right',
            locale: {
                format: 'Y-MM-DD'
            }
        });
        $('input[name="dob"]').daterangepicker({
            singleDatePicker: true,
            opens: 'right',
            maxDate: moment(),
            locale: {
                format: 'Y-MM-DD'
            }

        });
    </script>
@endsection

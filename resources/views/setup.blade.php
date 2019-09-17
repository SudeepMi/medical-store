@extends('layouts.app')
@section('title', 'Setup Wizard')
@section('content')
<form method="post" action="{{ route('setup_wizard.save')  }}">
    @csrf
<div class="row">
    <div class="col-lg-10 col-md-12 m-auto">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Setup Wizard</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-brand" id="sub-btn">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">

                                    <div class="row">
                                        <div class="col-lg-6 col-md-8">
                                            <div class="form-group">
                                                <label>Company Name:</label>
                                                <input type="text" class="form-control @error('name_in_bill') is-invalid @enderror" required name="name_in_bill" id="name" placeholder="Company Name">
                                                @error('name_in_bill')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Address:</label>
                                                <input type="text" class="form-control @error('address_in_bill') is-invalid @enderror" required name="address_in_bill" id="address" placeholder="Address">
                                                @error('address_in_bill')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Reg No:</label>
                                                <input type="number" class="form-control @error('vat_no_in_bill') is-invalid @enderror" required name="vat_no_in_bill" id="reg_no" placeholder="Reg No." min="5">
                                                @error('vat_no_in_bill')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Phone:</label>
                                                <input type="tel" class="form-control @error('phone_no_in_bill') is-invalid @enderror" name="phone_no_in_bill" required id="phone">
                                                @error('phone_no_in_bill')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="form-group">
                                                <label>From:</label>
                                                <input type="text" class="form-control" required name="from_year" id="from">
                                                @error('from_year')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>To:</label>
                                                <input type="text" class="form-control" name="to_year" required id="to" >
                                            </div>

                                            <div class="form-group ">
                                                <label>Currency:</label>
                                                <select class="form-control" id="currency" name="currency">
                                                    <option value="usd">USD</option>
                                                    <option value="aud">AUD</option>
                                                    <option value="npr">NPR</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Thankyou Note In Bill:</label>
                                                <textarea name="thank_you_note_in_bill" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>



    @endsection


@section('js')
<script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>

    <script>
        $(function(){

            $('#from').daterangepicker({
                singleDatePicker: true,
                opens: 'right',
                locale: {
                    format: 'MM-DD'
                }
            },function(start, end, label) {
                $('#to').daterangepicker({
                    singleDatePicker: true,
                    autoUpdateInput: true,
                    startDate:start.subtract(1,'days'),
                    locale: {
                        format: 'MM-DD'
                    }


                });
            });
            $('#to').daterangepicker({
                singleDatePicker: true,
                opens: 'right',
                startDate:moment().subtract(1,'days'),
                locale: {
                    format: 'MM-DD'
                }
            });
    })
    </script>

@endsection

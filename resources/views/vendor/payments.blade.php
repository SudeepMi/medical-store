@extends('layouts.app')
@section('title','Payment Wizard')
@section('content')
<div class="row">
        <div class="col-lg-5">
            <form class="kt-form" id="kt_form" method="POST" action="{{ route ('vendor.store_payments') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg hposition">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Make Payment</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="btn-group hcustom-btn">
                                <button class="btn btn-brand" type="submit">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">Pay</span>
                                </button>
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label >Amount To Pay</label>
                                                        <input class="form-control @error('amount') is-invalid @enderror amount" type="number" value="{{ $amount ?? old('amount') }}" name="amount" placeholder="Amount To Pay" required>
                                                        @error('amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">

                                            <label>method</label>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="kt-option">
                                                        <span class="kt-option__control">
                                                            <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                <input type="radio" name="method" value="1" checked>
                                                                    <span></span>
                                                            </span>
                                                            </span>
                                                        <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Cash</span>

                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="radio" name="method" value="2">
                                                                        <span></span>
                                                                </span>
                                                                </span>
                                                        <span class="kt-option__label">
                                                            <span class="kt-option__head">
                                                                <span class="kt-option__title">Bank</span>

                                                                    </span>
                                                            </span>
                                                    </label>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="radio" name="method" value="3">
                                                                        <span></span>
                                                                </span>
                                                            </span>
                                                        <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Others</span>

                                                                    </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

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
            </form>
            </div>
    <div class="col-lg-7">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">                 <div class="kt-portlet__head kt-portlet__head--lg hposition">
              <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title">{{ $name }} </h3>
                </div>
              <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-selected="false">
                            <i class="la la-money"></i> Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-selected="true">
                            <i class="la la-cart-plus"></i> Purchase
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1" role="tabpanel">
                    {!! $payments !!}
                </div>
                <div class="tab-pane" id="tab-2" role="tabpanel">
                    {!! $purchase !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('css')

    <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/blockui.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script>
            document.querySelector(".amount").addEventListener("keypress", function (evt) {
                if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                {
                    evt.preventDefault();
                }
            });
    </script>
    <script>
        $(".purchase-info").on( 'click', function(e){
          e.preventDefault()
          var invoice = $(this).data('invoice')
         $.ajax({
             method: "POST",
             url: '/stock/item/purchaseDetail',
             data: { invoice: invoice}
         })
         .done(function( res ) {
            $('.right-modal').modal('show');
            $('.modal-title-name').text('Stock Purchase Detail');
            $('.modal-menu-info').html(res)
            console.log(res)
        });
        })
    </script>
@endsection
@section('modals')
<div class="modal fade modal-aside horizontal right right-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog width-80" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span class="modal-title-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-menu-info"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection



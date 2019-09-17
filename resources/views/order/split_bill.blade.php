@extends('layouts.app')
@section('title', 'Split Bill')
@section('content')
<input type="hidden" id="table_id" value="{{$table->uuid}}">
<input type="hidden" id="service_charge_rate" value="{{$bills['service_charge_rate']}}">
<input type="hidden" id="is_service_charge" value="{{$bills['is_service_charge']}}">

<div class="row hfont">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile bill-split-main" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg hcustom-title">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <i class="flaticon2-browser-2 kt-font-brand" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Truffle Order Station" data-original-title="" title=""></i>
                        &nbsp; Table : 12
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" class="btn btn-outline-dark kt-margin-r-10" id="btn-add-bill" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Add more bills to split" data-original-title="" title="">
                        <i class="la la-plus"></i> Add Bill
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info" id="print-and-close">
                            <i class="la la-print mobile-view-print-icon"></i>
                            <span class="kt-hidden-mobile">Print & Close</span>
                        </button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-print"></i>
                                        <span class="kt-nav__link-text">Print</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-times"></i>
                                        <span class="kt-nav__link-text">Close</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                <form>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-widget4 bill-split-content">
                                @foreach($bills['detail'] as $item)
                                    <a href="#" class="kt-widget4__item bill-split-item bill-split-item-{{$item['slug']}}" data-name="{{$item['name']}}" data-slug="{{$item['slug']}}" data-quantity="{{$item['quantity']}}" data-price="{{$item['price']}}">
                                        <div class="kt-widget4__pic kt-widget4__pic--pic">
                                            <span class="kt-badge kt-badge--success kt-badge--lg">{{$item['prefix']}}</span>
                                        </div>
                                        <div class="kt-widget4__info">
                                            <p class="kt-widget4__username">{{$item['name']}}</p>
                                            <p class="kt-widget4__text">NPR {{$item['price']}}</p>                                     
                                        </div>                       
                                        <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>{{$item['quantity']}}</span></span>     
                                        <span class="btn btn-sm btn-label-dark btn-bold">REM: <span class="remaining-qty">{{$item['quantity']}}</span></span>                       

                                    </a>     
                                @endforeach                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> <!--Bills-->
        <div class="row bill-list">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-15 bill" data-uuid="1">
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile bill-splited" style="min-height: 81.5vh;">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                <label>
                                    <input type="checkbox" checked="checked" name="" class="bill-switch">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <button type="button" class="btn btn-outline-dark" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Add Table to the workplace" data-original-title="" title="">
                                <i class="la la-print"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="customer-content">
                            <div class="row cash-customer-details">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly value="Cash Customer">
                                        <div class="input-group-append">
                                            <button class="btn btn-warning btn-icon btn-show-customer" type="button">
                                                <i class="la la-edit"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row customer-details" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group row mb-0 hide-in-mobile">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="c_name" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group pr-0">
                                                <input type="number" class="form-control" name="c_phone" placeholder="Enter Phone Number">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0 show-in-mobile">
                                        <div class="col-lg-6">
                                            <div class="input-group pr-0">
                                                <input type="text" class="form-control" placeholder="Enter Customer Name">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="c_pan" placeholder="Enter Customer PAN">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" name="pax" placeholder="Enter PAX">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-15">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="bill-split-menu-list">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="bill-split-display-list">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-15">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table class="table bill-split-payments">
                                        <tbody>
                                            <tr>
                                                <th>Total</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control total_amount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Percent</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control discount_percent change-effect">
                                                        <span class="input-group-append"><span class="input-group-text">%</span></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control discount_amount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if($bills['is_service_charge'])
                                            <tr>
                                                <th>Service Charge</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control service_charge_amount">
                                                        <input type="hidden" class="form-control service_charge_percent" value="{{$bills['service_charge_rate']}}">

                                                        <span class="input-group-append"><span class="input-group-text">{{$bills['service_charge_rate']}}%</span></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Round</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control round" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control grand_total" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Received Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control received_amount change-effect">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tip Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control tip_amount change-effect">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Change Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control change_amount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p>Payment Type</p>
                                    <div class="form-group form-group-last">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="payment_type[1]" value="cash" checked>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">CASH</span>                                             
                                                        </span>
                                                    </span>     
                                                </label> 
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="payment_type[1]" value="bank" >
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">BANK / CARD</span>                                             
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
                </div>  
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-15 bill" data-uuid="2">
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile bill-splited" style="min-height: 81.5vh;">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                <label>
                                    <input type="checkbox" name="" class="bill-switch">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <button type="button" class="btn btn-outline-dark" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Add Table to the workplace" data-original-title="" title="">
                                <i class="la la-print"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="customer-content">
                            <div class="row cash-customer-details">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly value="Cash Customer">
                                        <div class="input-group-append">
                                            <button class="btn btn-warning btn-icon btn-show-customer" type="button">
                                                <i class="la la-edit"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row customer-details" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group row mb-0 hide-in-mobile">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control"  name="c_name" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group pr-0">
                                                <input type="number" class="form-control"  name="c_phone" placeholder="Enter Phone Number">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0 show-in-mobile">
                                        <div class="col-lg-6">
                                            <div class="input-group pr-0">
                                                <input type="text" class="form-control"  name="c_name" placeholder="Enter Customer Name">
                                                <div class="input-group-append">
                                                    <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" name="c_phone" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="c_pan"placeholder="Enter Customer PAN">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control"  name="pax" placeholder="Enter PAX">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-15">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="bill-split-menu-list">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="bill-split-display-list">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-15">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table class="table bill-split-payments">
                                        <tbody>
                                            <tr>
                                                <th>Total</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control total_amount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Percent</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control discount_percent change-effect">
                                                        <span class="input-group-append"><span class="input-group-text">%</span></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control discount_amount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if($bills['is_service_charge'])
                                            <tr>
                                                <th>Service Charge</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control service_charge_amount">
                                                        <input type="hidden" class="form-control service_charge_percent" value="{{$bills['service_charge_rate']}}">

                                                        <span class="input-group-append"><span class="input-group-text">{{$bills['service_charge_rate']}}%</span></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Round</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control round" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control grand_total" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Received Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control received_amount change-effect">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tip Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control tip_amount change-effect">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Change Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control change_amount" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p>Payment Type</p>
                                    <div class="form-group form-group-last">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="payment_type[2]" value="cash" checked>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">CASH</span>                                             
                                                        </span>
                                                    </span>     
                                                </label> 
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="payment_type[2]" value="bank" >
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">BANK / CARD</span>                                             
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
                </div>  
            </div>

        </div>
    </div>

</div>

@endsection
@section('print')
    <div id="print-content" style="width:240px;"></div>   
@endsection
@section('css')
<style>
    .item{
        width:38px !important;
    }
</style>
@endsection
@section('js')
<script src="{{ asset('assets/custom/bill-split.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/custom/spinner.js') }}" type="text/javascript"></script>
@endsection

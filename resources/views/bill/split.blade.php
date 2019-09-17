@extends('layouts.app')

@section('content')
<div class="row hfont">
    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile bill-split-main" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg hcustom-title">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        <i class="flaticon2-browser-2 kt-font-brand" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Truffle Order Station" data-original-title="" title=""></i>
                        &nbsp; Table : 12
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <button type="button" class="btn btn-outline-dark kt-margin-r-10 btn-add-table" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Add more bills to split" data-original-title="" title="">
                        <i class="la la-plus"></i> Add Bill
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".regular-modal">
                            <i class="la la-print mobile-view-print-icon"></i>
                            <span class="kt-hidden-mobile">Print & Close</span>
                        </button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-hand-peace-o"></i>
                                        <span class="kt-nav__link-text">Apply Discount</span>
                                    </a>
                                </li>
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
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-trash"></i>
                                        <span class="kt-nav__link-text">Cancel</span>
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
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">HD</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">IC</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">HB</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">FI</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a> 
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">HD</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">IC</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">HB</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">FI</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a> 
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">HD</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">IC</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">HB</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>
                                <a href="#" class="kt-widget4__item bill-split-item">
                                    <div class="kt-widget4__pic kt-widget4__pic--pic">
                                        <span class="kt-badge kt-badge--success kt-badge--lg">FI</span>
                                    </div>
                                    <div class="kt-widget4__info">
                                        <p class="kt-widget4__username">Menu Item Menu Item 1</p>
                                        <p class="kt-widget4__text">NPR 850</p>                                     
                                    </div>                       
                                    <span class="btn btn-sm btn-label-dark btn-bold">QTY: <span>12</span></span>                       
                                </a>                         
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>

    <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-15">
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
                                            <input type="text" class="form-control" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group pr-0">
                                                <input type="number" class="form-control" placeholder="Enter Phone Number">
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
                                            <input type="text" class="form-control" placeholder="Enter Customer PAN">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" placeholder="Enter PAX">
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
                                                    <th>Price (NPR)</th>
                                                    <th>Quantity</th>
                                                    <th>Total (NPR)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bill-split-display-list">
                                                <tr>
                                                    <th>Item Name Item Name 1</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 2</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 3</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 1</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 2</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
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
                                                        <input type="number" class="form-control" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Percent</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control">
                                                        <span class="input-group-append"><span class="input-group-text">%</span></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Received Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tip Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Change Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control" readonly>
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
                                                            <input type="radio" name="payment_type[1]" value="" checked>
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
                                                            <input type="radio" name="payment_type[1]" value="">
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

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-15">
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
                                            <input type="text" class="form-control" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group pr-0">
                                                <input type="number" class="form-control" placeholder="Enter Phone Number">
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
                                            <input type="text" class="form-control" placeholder="Enter Customer PAN">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" placeholder="Enter PAX">
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
                                                    <th>Price (NPR)</th>
                                                    <th>Quantity</th>
                                                    <th>Total (NPR)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bill-split-display-list">
                                                <tr>
                                                    <th>Item Name Item Name 1</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 2</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 3</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 1</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Name Item Name 2</th>
                                                    <td>850</td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>
                                                            </span>
                                                            <input type="number" class="form-control" value="55">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>1,700</td>
                                                </tr>
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
                                                        <input type="number" class="form-control" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Percent</th>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control">
                                                        <span class="input-group-append"><span class="input-group-text">%</span></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Discount Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Received Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tip Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Change Amount</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-prepend"><span class="input-group-text">NPR</span></span>
                                                        <input type="number" class="form-control" readonly>
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
                                                            <input type="radio" name="payment_type[2]" value="" checked>
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
                                                            <input type="radio" name="payment_type[2]" value="">
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


@section('js')
<script src="{{ asset('assets/custom/bill-split.js') }}" type="text/javascript"></script>
@endsection

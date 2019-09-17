@extends('layouts.app')
@section('title', 'Order')
@section('content')
    <input type="hidden" id="table_id" value="{{$table->uuid}}">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile custom-order-height" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title" style="max-width:100px;">
                        <i class="flaticon2-browser-2 kt-font-brand" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Truffle Order Station" data-original-title="" title=""></i>&nbsp; Table : {{$table->name}} @if($bills['is_foc'])(FOC)@endif
                    </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    <div class="btn-group kt-margin-r-10">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-cog"></i>
                        <span class="kt-hidden-mobile">Options</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item" id="btn-discount">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Discount</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="kt-nav__item" id="btn-item-wise-discount">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Item Wise Discount</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item" id="btn-category-wise-discount">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Category Wise Discount</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item" id="btn-advance">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Advance</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="{{route('order.split.bill',[$table->uuid])}}" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Split Bill</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item" id="btn-foc">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Create FOC</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item" id="btn-special-order">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-text">Special Order</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" onClick="javascript:return false;" class="kt-nav__link" id="return-kot">
                                        <span class="kt-nav__link-text">Return KOT</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" onClick="javascript:return false;" class="kt-nav__link" id="btn-member">
                                        <span class="kt-nav__link-text">Member</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info print-and-close">
                        <i class="la la-print mobile-view-print-icon"></i>
                        <span class="kt-hidden-mobile">Print & Close</span>
                        </button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-reload"></i>
                                <span class="kt-nav__link-text">Print</span>
                                </a>
                                </li>
                                <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link" onClick="javascript:return false;" id="btn-close" data-url="{{route('workplace.index')}}">
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
                    <form class="customer-content">
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
                                        <input type="text" class="form-control" name="customer_name" placeholder="Enter Customer Name">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group pr-0">
                                            <input type="number" class="form-control" name="customer_phone" placeholder="Enter Phone Number">
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
                                        <input type="text" class="form-control" name="customer_name" placeholder="Enter Customer Name">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button">
                                            <i class="la la-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <input type="number" class="form-control" name="customer_phone" placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-lg-6">
                                    <input type="number" class="form-control" name="customer_pan" placeholder="Enter Customer PAN" min=1>
                                    </div>
                                    <div class="col-lg-6">
                                    <input type="number" class="form-control" placeholder="Enter PAX" value="{{$table->order->pax}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs nav-fill mt-15 order-tabs" role="tablist">
                                    <li class="nav-item">
                                    <a class="nav-link tab-order-list" data-toggle="tab" href="#tab-order-list">Order</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-kot-list">KOT</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link btn btn-brand kt-font-light active" data-toggle="tab" href="#" data-target="#tab-bill-list">Bill</a>
                                    </li>
                                </ul>
                                <div class="tab-content order-view">
                                    <div class="tab-pane " id="tab-order-list" role="tabpanel">
                                    <!--Order Item-->
                                    <div class="tab-pane-content">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                <th>Name</th>
                                                <th>Rate</th>
                                                <th style="width:150px;">Quantity</th>
                                                <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="order-list">
                                            </tbody>
                                        </table>
                                        <div>
                                            <button class="btn btn-success btn-send-kot">Send Kot</button>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="tab-pane" id="tab-kot-list" role="tabpanel">
                                    <!--Kot Item-->
                                    @include('order.components.kot')
                                    </div>
                                    <div class="tab-pane active" id="tab-bill-list" role="tabpanel">
                                    <!--Bill Item-->
                                    @include('order.components.bill_list')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
            <!--Menu Items-->
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                    <div class="input-group search-block">
                        <div class="input-group-prepend kt-hidden-mobile"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                        <input type="text" name="search" class="form-control width-250" id="instafilta-filter" placeholder="Search..." autocomplete="off">
                        <div class="input-group-append"><span class="input-group-text"><a href="#" class="clear-search"><i class="la la-times"></i></a></span></div>
                    </div>
                    </div>
                    <div class="kt-portlet__head-toolbar kt-hidden-mobile">
                    <h3 class="kt-portlet__head-title regular-order-title">Regular Order</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="filters-btn-group">
                            <div class="hz-scroll">
                                <button type="button" class="btn btn-outline-info btn-isotope butn" data-filter="*">All</button>
                                @foreach($menu_categories as $menu_category)
                                    <button type="button" class="btn btn-outline-info btn-isotope butn" data-filter=".{{$menu_category->slug}}">{{$menu_category->name}}</button>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="isotope-element-container kt-notification-v2 mt-15 hcustom-menu row">
                            @foreach($menu_items as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4 isotope-item  menu-item {{$item->category->slug}}" data-uuid="{{$item->slug}}" data-name="{{$item->name}}" data-rate="{{$item->price}}">
                                    <a href="#" onClick="javascript:return false;" class="kt-notification-v2__item">
                                    <div class="kt-notification-v2__item-icon kt-hidden-mobile">
                                        <span class="kt-userpic kt-userpic--circle kt-userpic--success">

                                            @if(Storage::disk('uploads')->exists('menuitem/'.$item->slug.'.jpg'))

                                                <img src="{{ asset(Storage::disk('uploads')->url('menuitem/'.$item->slug.'.jpg') )}}" alt="">
                                            @else
                                                <span>{{$item->category->prefix}}</span></span>
                                            @endif
                                    </div>
                                    <div class="kt-notification-v2__itek-wrapper">
                                        <div class="kt-notification-v2__item-title">{{$item->name}}</div>
                                        <div class="kt-notification-v2__item-desc">NPR {{$item->price}}</div>
                                    </div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade modal-aside horizontal right kot-return-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <form action="{{route('order.return.kot')}}" id="return-kot-form" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Return Kot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-kot-list">


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Return</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal bill-modal" tabindex="-9" role="dialog" aria-labelledby="bill" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content modal-bill-list">
                <form action="{{route('order.pay')}}" id="bill-form" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Pay</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal discount-modal" tabindex="-1" role="dialog" aria-labelledby="bill" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-50" role="document">
            <div class="modal-content">
                <form action="{{route('order.check.pin')}}" data-action="{{route('order.check.pin')}}" class="discount-check-form" method="POST">
                    <input type="hidden" name="discount_type" value=1>

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Normal Discount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Pin</label>
                            <div class="col-9">
                                <div class="discount-pin-input">
                                    <input type="password" name="pin" id="pin" class="pin form-control" maxlength="4" minlength="4" placeholder="Pin" autofocus required autocomplete="off">
                                </div>
                                <span class="form-text text-muted pin-msg msg"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Apply</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal item-wise-discount-modal" tabindex="-1" role="dialog" aria-labelledby="bill" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-50" role="document">
            <div class="modal-content">
                <form action="{{route('order.check.pin')}}" data-action="{{route('order.check.pin')}}" class="discount-check-form" method="POST">
                    <input type="hidden" name="discount_type" value=2>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Wise Discount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Pin</label>
                            <div class="col-9">
                                <div class="discount-pin-input">
                                    <input type="password" name="pin" id="pin-1" class="pin form-control" maxlength="4" minlength="4" placeholder="Pin" autofocus required autocomplete="off">
                                </div>
                                <span class="form-text text-muted pin-msg msg"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Apply</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal category-wise-discount-modal" tabindex="-1" role="dialog" aria-labelledby="bill" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-50" role="document">
            <div class="modal-content">
                <form action="{{route('order.check.pin')}}" data-action="{{route('order.check.pin')}}" class="discount-check-form" method="POST">
                    <input type="hidden" name="discount_type" value=3>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Category Wise Discount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Pin</label>
                            <div class="col-9">
                                <div class="discount-pin-input">
                                    <input type="password" name="pin" id="pin-2" class="pin form-control" maxlength="4" minlength="4" placeholder="Pin" autofocus required autocomplete="off">
                                </div>
                                <span class="form-text text-muted pin-msg msg"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Apply</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal foc-modal" tabindex="-1" role="dialog" aria-labelledby="foc" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-50" role="document">
            <div class="modal-content">
                <form action="{{route('order.create.foc')}}" data-action="{{route('order.create.foc')}}" id="foc-form" method="POST">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Foc</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Pin</label>
                            <div class="col-9">
                                <div class="discount-pin-input">
                                    <input type="password" name="pin" id="pin-3" class="pin form-control" maxlength="4" minlength="4" placeholder="Pin" autofocus required autocomplete="off">
                                </div>
                                <span class="form-text text-muted pin-msg msg"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Create</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal special-order-modal" tabindex="-1" role="dialog" aria-labelledby="special-order" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog" role="document" style="max-width: 900px;">
            <div class="modal-content">
                <form action="{{route('menu.special.item.store')}}" data-action="{{route('menu.special.item.store')}}" id="special-item-create-form" method="POST">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Special Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group"> <!-- Name -->
                                            <label>Name:</label>
                                            <input class="form-control" name="name" type="text" placeholder="Name" required>

                                        </div>

                                        <div class="form-group"><!-- Price -->
                                            <label>Price</label>
                                            <input class="form-control" type="number" name="price" placeholder="Price" required>
                                        </div>
                                        <div class="form-group"><!--Discount-->
                                            <label class="">Discountable</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label class="kt-option" id="">
                                                        <span class="kt-option__control">
                                                            <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                <input type="radio" name="is_discountable" value="1" checked>
                                                                    <span></span>
                                                            </span>
                                                            </span>
                                                        <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Yes</span>

                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label class="kt-option" >
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="radio" name="is_discountable" value="0" checked >
                                                                    <span></span>
                                                                </span>
                                                                </span>
                                                        <span class="kt-option__label">
                                                            <span class="kt-option__head">
                                                                <span class="kt-option__title">No</span>

                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="discount_percent">
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group"> <!-- Description -->
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" id="description"  placeholder="Description" rows="13" required></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <!-- Stock Items -->
                                        <div class="form-group">

                                            <select class="form-control kt-selectpicker" data-live-search="true" id="stock_items" multiple>
                                                @foreach($stock_items as $item)
                                                    <option id="stock-item-{{$item->id}}" value="{{$item->slug}}" data-unit="{{$item->unit}}"  data-name="{{$item->name}}"  data-slug="{{$item->slug}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Stock Items -->
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered table-sm" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Sn</th>
                                                        <th>Name</th>
                                                        <th>Unit</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stock-item-list">
                                                </tbody>
                                        </table>

                                        <!-- Stock Items here -->
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                        <h5>Special Items</h5>
                                        <div class="special-items" style="max-height:60vh; overflow-y:scroll">

                                        </div>

                                    </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Create</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal advance-modal" tabindex="-1" role="dialog" aria-labelledby="advance" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-50" role="document">
            <div class="modal-content">
                <form action="{{route('order.add.advance')}}" data-action="{{route('order.add.advance')}}" id="advance-form" method="POST">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Advance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Amount</label>
                            <div class="col-9">
                                <div class="advance-amount-input">
                                    <input type="number" name="advance_amount" id="advance_amount" class="form-control" min="1" placeholder="Advance Amount" autofocus required>
                                </div>
                                <span class="form-text text-muted advance-msg msg"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Create</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal fade horizontal member-modal" tabindex="-1" role="dialog" aria-labelledby="advance" aria-hidden="true" data-backdrop=static>
        <div class="modal-dialog width-50" role="document">
            <div class="modal-content content-first">
                <form action="{{route('membership.check')}}" data-action="{{route('membership.check')}}" id="member-form" method="POST" autocomplete=off>

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Membership Number/ Phone Number</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Membership Number</label>
                            <div class="col-9">
                                <div class="membership-credential-input">
                                    <input type="text" name="membership_credential" id="membership_credential" class="membership_credential form-control" minlength="1" placeholder="Enter Membership Number/ Phone Number" autofocus required>
                                </div>
                                <span class="form-text text-muted membership-credential-msg msg"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Apply</button>

                    </div>
                </form>

            </div>
            <div class="modal-content content-second" style="display:none;">
                <form action="{{route('membership.apply')}}" data-action="{{route('membership.apply')}}" id="member-form-apply" method="POST">
                    <input type="hidden" name="member_slug" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter Membership Number/ Phone Number</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Membership Number</label>
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <input type="text" name="membership_credential" id="membership_credential_one" class="form-control" minlength="1" placeholder="Enter Membership Number/ Phone Number" readonly required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="btn-change-number-member">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="member-success row"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" >Apply</button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade modal-aside horizontal right add-debitor-modal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop=static>
        <div class="modal-backdrop fade-in" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog width-80" role="document">
                <div class="modal-content">
                    <form action="{{route('order.return.kot')}}" id="add-debitor-form" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create new debtor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Info here -->
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Name</label>
                                <div class="col-9">
                                    <input class="form-control" name="name" type="text" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Email</label>
                                <div class="col-9">
                                    <input class="form-control" name="email" type="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Phone No</label>
                                <div class="col-9">
                                    <input class="form-control" name="phone"  type="number" placeholder="Phone No" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-success" >Add</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/workplace.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <style>
        .discount-input{
            display:inline-block;
        }
        .discount-input input{
            max-width:48px!important;
        }
    </style>

@endsection
@section('print')
    <div id="print-content" style="width:240px;"></div>
@endsection

@section('js')

    <script src="{{ asset('assets/js/jquery.serialize-object/jquery.serialize-object.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/instafilta.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/order.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/spinner.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/order/add-debitor-form.js') }}"></script>


    <script>
        $(".input-spinner").inputSpinner()
    </script>

    <script>
        $(document).on('click','.menu-item',function(){ //Add Order
            //Change Active navtab
                $('.nav-link').each(function( i, obj ) {
                    $(obj).removeClass('btn btn-brand kt-font-light active')
                })

                $('.tab-order-list').tab('show');
                $('.tab-order-list').addClass('btn btn-brand kt-font-light active');
            //Change Active navtab
            var name=$(this).data('name')
            var rate=$(this).data('rate')
            var uuid=$(this).data('uuid')
            var exists = checkExists(uuid)
            if(exists){
                var obj =$('#order-list').find('.'+uuid).find('.qty')
                var qty=obj.val()
                obj.val(+qty+1)
            }else{
                var content = '<tr class="order-list-item '+uuid+'" data-uuid="'+uuid+'">'+
                '<th>'+name+'</th>'+
                '<th>'+rate+'</th>'+
                '<td>'+
                '<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">'+
                '<span class="input-group-btn input-group-prepend">'+
                ' <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>'+
                '</span>'+
                '<input type="number" class="form-control qty" value="1" min=1 required>'+
                '<span class="input-group-btn input-group-append">'+
                '<button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>'+
                '</span>'+
                '</div>'+
                '</td>'+
                '<td><button type="button" class="btn btn-sm btn-outline-danger btn-icon remove-order-list-item"><i class="la la-times"></i></button></td>'+
                ' </tr>'
                $('#order-list').append(content)

            }


        })
        $(document).on('click','.remove-order-list-item',function(){ //Remove Order
            $(this).closest('.order-list-item').remove()
        })
        $(document).on('click','.btn-send-kot',function(e){ //Send Kot
            e.preventDefault()
            var items = $('#order-list .order-list-item')
            if(items.length){ //If items
                var datas=[];
                items.each(function( i, obj ) {
                    var data = {
                        menu_item: $(obj).data('uuid'),
                        quantity:   $(obj).find('.qty').val()
                    };
                    datas.push(data);
                })
                //Update
                $.ajax({
                    method: "POST",
                    url: '/order/add-kot',
                    data: {
                        datas: JSON.stringify(datas),
                        table: $('#table_id').val()
                     }
                })
                .done(function( data ) {
                    var res=JSON.parse(data)

                    $('#order-list').html('')
                    $('#tab-kot-list').html(res.kot_view)
                    $('#tab-bill-list').html(res.bill_view)
                    if(res.print_kot){

                        printKot(res.this_kot,res.this_kot_info )
                    }
                    billInit()

                })
            }else{ //If no items
                alert('Sorry no items to send to kot')
            }
            console.log(datas)
        })
        function checkExists(uuid){
            return $('#order-list').find('.'+uuid).length
        }

        //Printing

            function printBill(view){
                $('#main-content').hide();
                $('#print-content').html(view);
                window.print();
                $('#print-content').html('');
                $('#main-content').show();

            }
            function printKot(items, details) {
                $('#main-content').hide();
                var printData = getKotPrint(items, details);
                $('#print-content').html(printData);
                window.print();
                $('#print-content').html('');
                $('#main-content').show();

            }

            function getKotPrint(items, details){
                var str='<center style="font-size:18px;">KOT</center>'

                    str+='<hr/>'
                    str+='<div style="width:100%;font-size:13px;">Date : &nbsp;'+details['date']+'</div>'
                    str+='<div style="width:100%;font-size:13px;">Kot no : &nbsp;'+details['kot_no']+'</div>'
                    str+='<div style="width:100%;font-size:13px;">Table : &nbsp;'+details['table_name']+'</div>'

                    str+='<hr/>'
                    str+='<table style="text-align:left; width:100%;font-size:13px;" >'
                    str+='<tr>'
                    str+='<th width="80%" ><b>Item</b></th>'
                    str+='<th width="20%"><b>Quantity</b></th>'
                    str+='</tr>'
                    $.each(items, function( index, kot ) {
                        str+='<tr>'
                        str+='<td width="80%" >'+kot.name+'</td>'
                        str+='<td width="20%" >'+kot.quantity+'</td>'
                        str+='</tr>'
                    });


                    str+='</table>'
                    str+='<hr/>'
                    //User
                    str+='<table style="text-align:left; width:100%;font-size:13px;" >'

                    str+='<tr>'
                    str+='<td width="20%" >User</td>'
                    str+='<td width="80%" >'+details['user']+'</td>'
                    str+='</tr>'
                    str+='</table>'
                    str+='<hr/>'

                    //User
                    return str
            }
            function printKotReturn(items, details){
                $('#main-content').hide();
                var printData = getKotReturnPrint(items, details);
                $('#print-content').html(printData);
                window.print();
                $('#print-content').html('');
                $('#main-content').show();
            }
            function getKotReturnPrint(items, details){
                var str='<center style="font-size:18px;">KOT Return</center>'
                    str+='<hr/>'
                    str+='<div style="width:100%;font-size:13px;">Date : &nbsp;'+Date.now()+'</div>'
                    str+='<div style="width:100%;font-size:13px;">Kot no : &nbsp;'+Date.now()+'</div>'
                    str+='<hr/>'
                    str+='<table style="text-align:left; width:100%;font-size:13px;" >'
                    str+='<tr>'
                    str+='<th width="50%" ><b>Item</b></th>'
                    str+='<th width="20%"><b>Quantity</b></th>'
                    str+='</tr>'
                    $.each(items, function( index, kot ) {
                        str+='<tr>'
                        str+='<td width="50%" >'+kot.name+'</td>'
                        str+='<td width="20%" >'+kot.quantity+'</td>'
                        str+='</tr>'
                    });
                    str+='</table>'
                    str+='<hr/>'
                    str+='<table style="text-align:left; width:100%;font-size:13px;" >'
                    //Reason
                    str+='<tr>'
                    str+='<td width="20%" >Reason</td>'
                    str+='<td width="80%" >'+details['reason']+'</td>'
                    str+='</tr>'
                    //Reason
                    //User
                    str+='<tr>'
                    str+='<td width="20%" >User</td>'
                    str+='<td width="80%" >'+details['user']+'</td>'
                    str+='</tr>'
                    //User
                    str+='</table>'

                    str+='<hr/>'
                    return str
            }

        //Printing

        //Return Kot
            $(document).on('click','#return-kot',function(e){
                e.preventDefault()
                //Get order items
                $.ajax({
                    method: "POST",
                    url: '/order/get-kot-list',
                    data: {
                        table: $('#table_id').val()
                     }
                })
                .done(function( res ) {
                    $('.modal-kot-list').html(res.kot_list)
                    $('.kot-return-modal').modal('show')

                })
                //Get order items

            })
            $( document ).on('submit','#return-kot-form',function( event ) {
                    event.preventDefault();
                    var return_items=[];
                    var datas=[];


                    var total_return=0;
                    $('#return-kot-form input, #return-kot-form textarea').each(function (index, value) {
                        if($(this).data('type')=='item'){ //Return Items
                            if($(this).val()>0 && $(this).val()<=$(this).data('max')){
                                var data = {
                                    menu_item: $(this).data('slug'),
                                    quantity:  $(this).val()
                                };
                                return_items.push(data);
                                total_return+= $(this).val();
                            }else if($(this).val()==0){

                            }else{
                                alert('something went wrong');
                                return false;
                            }
                        }
                    });
                    if(total_return<=0){
                        alert('Cannot return 0 items');
                        return false;
                    }
                    $.ajax({
                        method: "POST",
                        url: '/order/return-kot',
                        data: {
                            return_items: JSON.stringify(return_items),
                            reason : $('#kot-return-reason').val(),
                            table : $('#kot-return-table-id').val()

                        }
                    })
                    .done(function( res ) {

                        $('#tab-kot-list').html(res.kot_view)
                        $('#tab-bill-list').html(res.bill_view)
                        printKotReturn(res.this_kot_return, res.this_kot_return_info)
                        billInit()

                        //Reset Modal
                        $('.modal-kot-list').html('')
                        $('.kot-return-modal').modal('hide')
                    })

                });

        //Return Kot

        //Order Print And Close
            $(document).on('click','.print-and-close',function(){
                //Get Bill
                $.ajax({
                    method: "POST",
                    url: '/order/get-bill',
                    data: {
                        table: $('#table_id').val()
                    },
                    beforeSend: function( xhr ) {
                        showLoader()
                    }
                })
                .done(function( res ) {
                    if(res.status){
                        //Replace Bill Modal
                        $('.modal-bill-list').html(res.bill_view)
                        var $selector=$('.customer-details').find('.hide-in-mobile')
                        var $selector2=$('.customer-details')

                        var c_name=$selector.find('input[name="customer_name"]').val()
                        var c_address=$selector.find('input[name="customer_address"]').val()
                        var c_pan=$selector2.find('input[name="customer_pan"]').val()
                        var c_phone=$selector2.find('input[name="customer_phone"]').val()
                        $('#bill-form').find('input[name="customer_address"]').val(c_address)
                        $('#bill-form').find('input[name="customer_name"]').val(c_name)
                        $('#bill-form').find('input[name="customer_phone"]').val(c_phone)
                        $('#bill-form').find('input[name="customer_pan"]').val(c_pan)

                        //
                        //Pay
                        $('.bill-modal').modal('show')
                        removeLoader()

                    }else{
                        removeLoader()
                        Swal.fire(
                            'Oops!',
                            res.message,
                            'info'
                        )
                    }


                })

            })
            $( document ).on('submit','#bill-form',function( event ) {
                    event.preventDefault();
                    $.ajax({
                        method: "POST",
                        url: '/order/pay',
                        data: {
                            received: $('#bill-form').find('input[name="received"]').val(),
                            tip: $('#bill-form').find('input[name="tip"]').val(),
                            table : $('#table_id').val(),
                            customer_name:$('#bill-form').find('input[name="customer_name"]').val(),
                            customer_address:$('#bill-form').find('input[name="customer_address"]').val(),
                            customer_phone:$('#bill-form').find('input[name="customer_phone"]').val(),
                            customer_pan:$('#bill-form').find('input[name="customer_pan"]').val(),
                            pax:$('#bill-form').find('input[name="pax"]').val(),
                            payment_type:$('#bill-form').find('input[name="payment_type"]:checked').val(),
                            debitor:$('#bill-form').find('select[name="debitor"]').val(),

                        }
                    })
                    .done(function( res ) {
                        printBill(res.bill_view)
                        window.location.replace(res.redirect_url);
                    })
            })
            $(document).on('change','.payable-bill-change', function(e){
                var $parent=$(this).parents('tfoot')
                var net_total=$parent.data('total')
                var advance=$parent.data('advance')
                var tip = $parent.find('input[name="tip"]').val()
                var received=0;
                if($parent.find('input[name="received"]').length>=1){
                    received=$parent.find('input[name="received"]').val();
                }
                var payable_total= +net_total + +tip - +advance
                var return_amount= +received - +payable_total


                if(return_amount<0){
                    $parent.find('.return').text(0)

                }else{
                    $parent.find('.return').text(return_amount)
                }

                return false;

                var received_amount=$parent.find('input[name="received"]').val()
                if(received_amount==0){
                    var total= $parent.data('total')
                    var tip=$parent.find('input[name="tip"]').val()
                    var return_amount =+received_amount - +total -+tip
                    $parent.find('.return').text(0)
                }else{
                    var total= $parent.data('total')
                    var tip=$parent.find('input[name="tip"]').val()
                    if(received_amount<total){
                        alert('Received amount is less than total')
                    }else{
                        var return_amount =+received_amount - +total -+tip
                        if(return_amount<0){
                            $parent.find('.return').text(0)

                        }else{
                            $parent.find('.return').text(return_amount)

                        }

                    }
                }

            })
            $(document).on('change','input[name="payment_type"]',function(e){
                if($(this).val()==1){//Cash
                    $('.in_cash').show()
                    $('.in_credit').hide()

                }else if($(this).val()==2){//Bank
                    $('.in_cash').hide()
                    $('.in_cash').find('input').val('')
                    $('.in_credit').hide()

                }else if($(this).val()==3){//Credit
                    //Ajax Get Creditor
                    $.ajax({
                        method: "GET",
                        url: '/debtor/get-debtors',
                        async: true,
                        beforeSend: function( xhr ) {
                            showLoader()
                        }
                    })
                    .done(function( data ) {
                        $('.in_cash').hide()
                        $('.in_bank').hide()

                        var res=JSON.parse(data)
                        var options=''
                        $.each(res, function( index, debitor ) {
                            options+='<option value="'+debitor.slug+'">'+debitor.name+'</option>'
                        });

                        $('#debitor-select').html(options)
                        $('#debitor-select').selectpicker()
                        $('.in_credit').show()
                        removeLoader()

                    })
                }
            })
        //Order Print And Close

        //Deditor
            $(document).on('click','.btn-add-debitor',function(){
                $('.add-debitor-modal').modal('show')
            })
            $(document).on('submit','#add-debitor-form',function(e){
                e.preventDefault();
            })
        //Debitor

        //Member
            $(document).on('click','#btn-member',function(){
                $('.member-modal').modal('show')
            })
            $(document).on('submit','#member-form',function(e){
                e.preventDefault()
                var cred=$(this).find('input[name="membership_credential"]').val()
                $('.membership-credential-input').addClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                $.ajax({
                    method: "POST",
                    url: $(this).data('action'),
                    data: {
                        membership_credential: $(this).find('input[name="membership_credential"]').val(),
                        table: $('#table_id').val()

                     }
                })
                .done(function( res ) {
                    var data=JSON.parse(res)
                    $('.membership-credential-input').removeClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                    if(data.status){
                        var content=''
                        jQuery.each(data.thresholds, function(index, threshold) {
                             content+='<div class="col-lg-4">'+
                                '<label class="kt-option" >'+
                                        '<span class="kt-option__control">'+
                                            '<span class="kt-radio kt-radio--check-bold kt-radio--dark">'+
                                                '<input type="radio" name="threshold" value="'+threshold.slug+'" required>'+
                                                '<span></span>'+
                                            '</span>'+
                                            '</span>'+
                                    '<span class="kt-option__label">'+
                                        '<span class="kt-option__head">'+
                                            '<span class="kt-option__title">'+threshold.name+'</span>'+
    
                                            '</span>'+
                                    '</span>'+
                                '</label>'+
                            '</div>'                            
                        });
                        $('.membership-credential-msg').text('')
                        $('#membership_credential_one').val(cred)
                        $('.content-second').find('input[name="member_slug"]').val(data.member.slug)
                        $('.member-success').html(content)
                        $('.content-first').hide()
                        $('.content-second').show()
                        return false;
                        
                    }else{
                        $('.member-success').html('')
                        $('.membership-credential-msg').text(data.message)
                    }
                })
            })
            $(document).on('submit','#member-form-apply',function(e){
                e.preventDefault()
                var member_slug =$(this).find('input[name="member_slug"]').val()
                var threshold =$(this).find('input[name="threshold"]').val()

                var table= $('#table_id').val()
                
                $('.membership-credential-input').addClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                $.ajax({
                    method: "POST",
                    url: $(this).data('action'),
                    data: {
                        member_slug: member_slug,
                        table: table,
                        threshold:threshold
                     }
                })
                .done(function( res ) {
                    var data=JSON.parse(res)
                    $('.membership-credential-input').removeClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                    if(data.status){ 
                        $('#tab-bill-list').html(data.bill_view)
                        $('.member-modal').modal('hide')
                    }else{
                    }
                })
            })
            
            $(document).on('click','#btn-change-number-member',function(){
                $('.content-first').show()
                $('.content-second').hide()
            })
            $(document).on('hidden.bs.modal', '.member-modal', function () {
                $('.content-first').show()
                $('.content-second').hide()
            });
        //Member
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });

        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('input').val('');
            $(this).find('textarea').val('');

            $(this).find('.msg').text('')
            $(this).find('#stock-item-list').html('')
            $('#stock_items').selectpicker('val', '');
        })

        //Discount
            //Normal Discount
            $(document).on('click','#btn-discount',function(){
                $('.discount-modal').modal('show')
            })

            $(document).on('submit','.discount-check-form',function(e){
                e.preventDefault()
                $('.discount-pin-input').addClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                $.ajax({
                    method: "POST",
                    url: $(this).data('action'),
                    data: {
                        pin: $(this).find('.pin').val(),
                        table: $('#table_id').val(),
                        discount_type: $(this).find('input[name="discount_type"]').val()

                     }
                })
                .done(function( res ) {
                    var data=JSON.parse(res)
                    $('.discount-pin-input').removeClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                    if(data.status){
                        $('#tab-bill-list').html(data.bill_view)
                        billInit()
                        $('.modal').modal('hide')
                    }else{
                        $('.pin-msg').text(data.message)
                    }
                })
            })
            //Normal Discount
            //Item Wise Discount
                $(document).on('click','#btn-item-wise-discount',function(){
                    $('.item-wise-discount-modal').modal('show')
                })
            //Item Wise Discount
            //Category Wise Discount
             $(document).on('click','#btn-category-wise-discount',function(){
                    $('.category-wise-discount-modal').modal('show')
                })
            //Category Wise Discount

            //On dicount percent change
            $(document).on("change",'.discount', function (event) {
                var discount_percent=$(this).val()
                //Update Discount
                $.ajax({
                    method: "POST",
                    url: '/order/apply-discount',
                    data: {
                        discount_percent: discount_percent,
                        table: $('#table_id').val()
                     }
                })
                .done(function( res ) {
                    console.log('Discount saved')
                })
                //Change Discount Value
                //Seevice charge

                var is_service_charge=false
                var service_charge_rate=0
                if($('#is_service_charge').length){
                    is_service_charge=true
                    service_charge_rate=$('#service_charge_rate').val()
                }
                if(is_service_charge){
                    var sub_total=$('#subtotal').val()
                    var discount_amount= parseFloat((discount_percent/100)*sub_total).toFixed(2)
                    var sub_total_with_discount=sub_total-discount_amount
                    var service_charge_amount= parseFloat((service_charge_rate/100)*sub_total_with_discount).toFixed(2)
                    var sub_total_with_discount_and_sc= +sub_total_with_discount+ +service_charge_amount
                    var net_total=Math.round(sub_total_with_discount_and_sc)
                    var round=parseFloat(net_total-sub_total_with_discount_and_sc).toFixed(2)
                    $('.discount-amount').text(discount_amount)
                    $('.service-charge-amount').text(service_charge_amount)
                    $('.round').text(round)
                    $('.net-total').text(net_total)

                    var is_advance=false
                    var advance_amount=0
                    if($('#is_advance').length){
                        is_advance=true
                        advance_amount=$('#advance-amount').val()
                        if(advance_amount>net_total){//REtrun
                            $('.return-amount').text(advance_amount-net_total)

                        }else{//Pay
                            $('.payable-amount').text(net_total-advance_amount)
                        }

                    }
                }else{
                    var sub_total=$('#subtotal').val()
                    var discount_amount= parseFloat((discount_percent/100)*sub_total).toFixed(2)
                    var net_total_before_round=sub_total-discount_amount
                    var net_total =Math.round(net_total_before_round)
                    var round=parseFloat(net_total-net_total_before_round).toFixed(2)
                    $('.discount-amount').text(discount_amount)
                    $('.round').text(round)
                    $('.net-total').text(net_total)

                    var is_advance=false
                    var advance_amount=0
                    if($('#is_advance').length){
                        is_advance=true
                        advance_amount=$('#advance-amount').val()
                        if(advance_amount>net_total){//REtrun
                            $('.return-amount').text(advance_amount-net_total)

                        }else{//Pay
                            $('.payable-amount').text(net_total-advance_amount)
                        }

                    }

                }
            })
            $(document).on('click','.remove-discount',function(e){
                e.preventDefault()
                Swal.fire({
                    title: 'Cancel Discount!',
                    text: 'Do you want to remove discount from this order?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',

                }).then( function(result) {
                    if(result.value){
                        $.ajax({
                                method: "POST",
                                url: '/order/remove-discount',
                                data: {
                                    table: $('#table_id').val()
                                },
                                beforeSend:showLoader()
                            })
                            .done(function( res ) {
                                var data=JSON.parse(res)
                                $('#tab-bill-list').html(data.bill_view)
                                billInit()
                                removeLoader()
                            })
                    }
                })
            })
            function setInputFilter(textbox, inputFilter) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                    textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                    });
                });
            }
            setInputFilter(document.getElementById("pin"), function(value) {return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999 || parseInt(value) >= 1000); });
        //Discount

        //FOC
            $(document).on('click','#btn-foc',function(){
                $('.foc-modal').modal('show')
            })
            $(document).on('submit','#foc-form',function(e){
                e.preventDefault()
                $('.discount-pin-input').addClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                $.ajax({
                    method: "POST",
                    url: $(this).data('action'),
                    data: {
                        pin: $(this).find('.pin').val(),
                        table: $('#table_id').val(),
                        discount_type: $(this).find('input[name="discount_type"]').val()

                     }
                })
                .done(function( res ) {
                    var data=JSON.parse(res)
                    $('.discount-pin-input').removeClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                    if(data.status){
                        $('#tab-bill-list').html(data.bill_view)
                        billInit()
                        $('.modal').modal('hide')
                    }else{
                        $('.pin-msg').text(data.message)
                    }
                })
            })
            $(document).on('click','#remove-foc',function(e){
                e.preventDefault()
                Swal.fire({
                    title: 'Cancel FOC!',
                    text: 'Do you want to cancel foc from this order?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',

                }).then( function(result) {
                    if(result.value){
                        $.ajax({
                                method: "POST",
                                url: '/order/remove-foc',
                                data: {
                                    table: $('#table_id').val()
                                },
                                beforeSend:showLoader()
                            })
                            .done(function( res ) {
                                var data=JSON.parse(res)
                                $('#tab-bill-list').html(data.bill_view)
                                billInit()
                                removeLoader()
                            })
                    }
                })
            })
        //FOC

        //Special Order
            function getSpecialItemList(items){
                var content=''
                $.each(items, function( index, value ) {
                    content+='<a href="javascript:void(0)" class="special-item" data-uuid="'+value.uuid+'" data-name="'+value.name+'" data-rate="'+value.rate+'">'
                    content+='<div >'
                    content+='<span>1</span>'
                    content+='<span>'+value.name+'</span>'
                    content+='</div>'
                    content+='</a>'

                });
                return content

            }
            $(document).on('click','#btn-special-order',function(){

                $.ajax({
                    method: "POST",
                    url: '/menu/special/get-special-item'
                })
                .done(function( res ) {
                    var content=getSpecialItemList(res.data)
                    $('.special-items').html(content)

                    $('.special-order-modal').modal('show')

                })
            })
            $(document).on('submit','#special-item-create-form',function(e){
                e.preventDefault()
                var data={
                        "items":[],
                        "info":{},

                        };
                var info=$( this ).serializeArray();
                data.info=info;

                //Calculate Stock Items
                $('.stock-item').each(function(i, obj) {
                    var slug=$(this).data('slug');
                    var quantity=$(this).find('input').val()
                    var this_stock_item={slug:slug,quantity:quantity}
                    data.items.push(this_stock_item);
                });
                //Calculate Stock Items
                console.log(data)
                $.ajax({
                    method: "POST",
                    url: $(this).data('action'),
                    data: data
                })
                .done(function( res ) {
                    var name=res.name
                    var rate=res.price
                    var uuid=res.slug
                    var exists = checkExists(uuid)
                    if(exists){
                        var obj =$('#order-list').find('.'+uuid).find('.qty')
                        var qty=obj.val()
                        obj.val(+qty+1)
                    }else{
                        var content = '<tr class="order-list-item '+uuid+'" data-uuid="'+uuid+'">'+
                        '<th>'+name+'</th>'+
                        '<th>'+rate+'</th>'+
                        '<td>'+
                        '<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">'+
                        '<span class="input-group-btn input-group-prepend">'+
                        ' <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>'+
                        '</span>'+
                        '<input type="number" class="form-control qty" value="1" min=1 required>'+
                        '<span class="input-group-btn input-group-append">'+
                        '<button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>'+
                        '</span>'+
                        '</div>'+
                        '</td>'+
                        '<td><button type="button" class="btn btn-sm btn-outline-danger btn-icon remove-order-list-item"><i class="la la-times"></i></button></td>'+
                        ' </tr>'
                        $('#order-list').append(content)

                    }
                    //Change Active navtab
                        $('.nav-link').each(function( i, obj ) {
                            $(obj).removeClass('btn btn-brand kt-font-light active')
                        })

                        $('.tab-order-list').tab('show');
                        $('.tab-order-list').addClass('btn btn-brand kt-font-light active');
                    //Change Active navtab
                    $('.special-order-modal').modal('hide')

                })
            })
            $(document).on('click','.special-item',function(e){
                var name= $(this).data('name')
                var rate= $(this).data('rate')
                var uuid= $(this).data('uuid')

                e.preventDefault()
                Swal.fire({
                    title: 'Add Item!',
                    text: 'Do you want to add "'+name+'" to this order?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',

                }).then( function(result) {
                    if(result.value){
                        var exists = checkExists(uuid)
                        if(exists){
                            var obj =$('#order-list').find('.'+uuid).find('.qty')
                            var qty=obj.val()
                            obj.val(+qty+1)
                        }else{
                            var content = '<tr class="order-list-item '+uuid+'" data-uuid="'+uuid+'">'+
                            '<th>'+name+'</th>'+
                            '<th>'+rate+'</th>'+
                            '<td>'+
                            '<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">'+
                            '<span class="input-group-btn input-group-prepend">'+
                            ' <button class="btn btn-secondary bootstrap-touchspin-down" type="button">-</button>'+
                            '</span>'+
                            '<input type="number" class="form-control qty" value="1" min=1 required>'+
                            '<span class="input-group-btn input-group-append">'+
                            '<button class="btn btn-secondary bootstrap-touchspin-up" type="button">+</button>'+
                            '</span>'+
                            '</div>'+
                            '</td>'+
                            '<td><button type="button" class="btn btn-sm btn-outline-danger btn-icon remove-order-list-item"><i class="la la-times"></i></button></td>'+
                            ' </tr>'
                            $('#order-list').append(content)

                        }
                        //Change Active navtab
                            $('.nav-link').each(function( i, obj ) {
                                $(obj).removeClass('btn btn-brand kt-font-light active')
                            })

                            $('.tab-order-list').tab('show');
                            $('.tab-order-list').addClass('btn btn-brand kt-font-light active');
                        //Change Active navtab
                        $('.special-order-modal').modal('hide')
                    }
                })
            })
            $(document).on('change','input[name="is_discountable"]',function() {
                var content=''
                if($(this).val()==1){
                    content='<label>Discount %</label><input class="form-control" type="number" name="discount" placeholder="Discount %" required>'
                }
                $("#discount_percent").html(content)
            })

            $('#stock_items').selectpicker()
            $('#stock_items').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var x = document.getElementById("stock_items");
                var option=x.options[clickedIndex]
                if(isSelected){ // Add Stock Item
                    var unit=$(option).data('unit')
                    var name=$(option).data('name')
                    var slug=$(option).data('slug')
                    var c= slug+'-stock'
                    var tr=getTr(unit, name, slug, c)
                    $('#stock-item-list').append(tr)
                }else{ // Remove Stock Item
                    var slug=$(option).data('slug')
                    var c= '.'+slug+'-stock'
                    $(c).remove();
                }

            });
            function getTr(unit, name, slug, c){
                content=''
                content+='<tr class="stock-item '+c+'" data-slug="'+slug+'">'+
                '<td><span class="list_sn"><span></td>'+
                '<td>'+name+'</td>'+
                '<td>'+unit+'</td>'+
                '<td><input class="form-control" type="number" min=1 required></td>'+
                '</tr>'
                return content
            }

        //Special Order
        //Advance Pay
            $(document).on('click','#btn-advance',function(){
                $('.advance-modal').modal('show')
            })
            $(document).on('submit','#advance-form',function(e){
                $('.advance-amount-input').addClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                e.preventDefault()
                $.ajax({
                    method: "POST",
                    url: $(this).data('action'),
                    data: {
                        advance: $(this).find('#advance_amount').val(),
                        table: $('#table_id').val(),
                     }
                })
                .done(function( res ) {
                    var data=JSON.parse(res)
                    $('.advance-amount-input').removeClass('kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input')
                    if(data.status){
                        $('#tab-bill-list').html(data.bill_view)
                        billInit()
                        $('.modal').modal('hide')
                    }else{
                        $('.advance-msg').text(data.message)
                    }
                })
            });
            $(document).on('click','#remove-advance',function(e){
                e.preventDefault()
                Swal.fire({
                    title: 'Remove Advance!',
                    text: 'Do you want to remove advance payment from this order?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',

                }).then( function(result) {
                    if(result.value){
                        $.ajax({
                                method: "POST",
                                url: '/order/remove-advance',
                                data: {
                                    table: $('#table_id').val()
                                },
                                beforeSend:showLoader()
                            })
                            .done(function( res ) {
                                var data=JSON.parse(res)
                                $('#tab-bill-list').html(data.bill_view)
                                billInit()
                                removeLoader()
                            })
                    }
                })
            })
        //Advance Pay
        $(document).on('click','#btn-close',function(){
            window.location.replace($(this).data('url'));
        })

        function billInit(){
            $(".input-spinner").inputSpinner()
        }



    </script>
@endsection

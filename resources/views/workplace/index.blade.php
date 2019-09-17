@extends('layouts.workplace')
@section('title', 'Workplace')
@section('content')
<div class="hwrapper">
    <aside class="hsticky-section">
        <div class="hside-section">
            <div class="search-wrapper">
                <div class="input-group search-block hsearch-block">
                    <input type="text" name="search" class="form-control" placeholder="Go to..." autocomplete="off">
                    <!-- <div class="input-group-append hinput-append"> -->
                        <span class="hinput-group-addon"><a href="#" class="clear-search"><i class="la la-times"></i></a></span>
                    <!-- </div> -->
                </div>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hbtn-group">
                            <button type="button" class="btn btn-info hbtn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-signs-1"></i> 
                                <span class="kt-hidden-mobile">Order List</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">Booking List</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">Retail List</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">Take Away List</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">Pick Up List</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <span class="kt-nav__link-text">Delivery List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hbtn-group">
                            <a href="#" class="kt-nav__link hkt-nav__link hretail-btn">
                                <i class="kt-nav__link-icon flaticon2-shopping-cart-1"></i> &nbsp; 
                                <span class="kt-nav__link-text">Retail</span>
                            </a>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="hbtn-group">
                            <a href="#" class="kt-nav__link hkt-nav__link htakeaway-btn">
                                <i class="kt-nav__link-icon flaticon2-paperplane"></i> &nbsp; 
                                <span class="kt-nav__link-text">Take Away</span>
                            </a>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="hbtn-group">
                            <a href="#" class="kt-nav__link hkt-nav__link hpickup-btn">
                                <i class="kt-nav__link-icon la la-phone"></i> &nbsp; 
                                <span class="kt-nav__link-text">Pick Up</span>
                            </a>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="hbtn-group">
                            <a href="#" class="kt-nav__link hkt-nav__link hdelivery-btn">
                                <i class="kt-nav__link-icon la la-automobile"></i> &nbsp; 
                                <span class="kt-nav__link-text">Delivery</span>
                            </a>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="hbtn-group">
                            <a href="#" class="kt-nav__link hkt-nav__link haddtips-btn">
                                <i class="kt-nav__link-icon flaticon-piggy-bank"></i>  &nbsp; 
                                <span class="kt-nav__link-text">Add Tips</span>
                            </a>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="hbtn-group">
                            <a href="#" class="kt-nav__link hkt-nav__link hmergebill-btn">
                                <i class="kt-nav__link-icon flaticon-price-tag"></i>  &nbsp; 
                                <span class="kt-nav__link-text">Merge Bill</span>
                            </a>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="hedit-btn">
                <div class="drag-object hdrag-object">
                    <a href="{{ route('workplace.edit') }}" class="btn btn-outline-dark" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Edit workplace layout">
                        <i class="flaticon-edit"></i> 
                        <span class="kt-hidden-mobile">Edit</span>
                    </a> 
                </div>
            </div>
            <div class="booking-list">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary hbooking" data-toggle="modal" data-target="#bookingmodal">
                            booking
                        </button>
                        <div class="modal animated fade fadeInRight modal-aside horizontal right right-modal" id="bookingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-hover table-striped width-full dtr-inline dataTable with-export booked-tables-data correct-indexing">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Table</th>
                                                            <th>Section</th>
                                                            <th>Customer Name</th>
                                                            <th>Customer Phone</th>
                                                            <th>PAX</th>
                                                            <th>Date</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Table</th>
                                                            <th>Section</th>
                                                            <th>Customer Name</th>
                                                            <th>Customer Phone</th>
                                                            <th>PAX</th>
                                                            <th>Date</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-12">
                                                <form action=""  method="post" class="form-horizontal">

                                                    <input type="hidden" name="_csrf" value="ZHd2cEl4bG0JNg4FKjVdNylDHCABMxxeMSQ6Kgg0Iz1XQzlIKBsqKQ==">
                                                    <input type="hidden" name="id" value="0">
                                                    <h4>Book Your Table</h4>    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">  
                                                                    <div class="form-group">
                                                                        <input type="text" name="customer_name" placeholder="Customer's Name" class="form-control">
                                                                    </div>
                                                                </div>         

                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <input type="number" name="customer_phone" placeholder="Phone" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <select class="form-control select-table" name="selected_table">
                                                                            <option value="">Select Table</option>
                                                                            <option data-floor="1" value="T1">T1</option>
                                                                            <option data-floor="2" value="T2">T2</option>
                                                                            <option data-floor="3" value="T3">T3</option>
                                                                            <option data-floor="4" value="T4">T4</option>
                                                                            <option data-floor="5" value="T5">T5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <input type="number" name="floor" placeholder="Section No" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <input type="number" name="customer_pax" placeholder="No of People" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <input type="text" readonly="" name="date" placeholder="Date" class="form-control">
                                                                        <input class="form-control" type="hidden" name="today" value="2019-09-16">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <input type="text"  placeholder="Time" class="form-control" value="01:00 PM">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-3"> 
                                                                    <div class="form-group">
                                                                        <input type="text"  placeholder="Time" class="form-control" value="01:00 PM">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12"> 
                                                                    <div class="form-group pull-right padding-right-50">
                                                                        <button type="submit" class="btn btn-primary">Book Now</button>
                                                                        <button type="button" class="btn btn-danger cancel-booking">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="hfloor-section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="floor-select">
                            <h6>Select floor</h6>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        @if(count($floors)>0)
                        <ul class="kt-nav hkt-nav nav-tabs" role="tablist">
                            @foreach($floors as $floor)
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link btn-tabs" data-target="#floor-{{$floor->slug}}" data-title="{{$floor->name}}">
                                    <span class="kt-nav__link-text">{{$floor->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @else 

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <main class="hmain-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="zoom-buttons" style="position:absolute;top:10px;right:10px;z-index:100;">
                    <button class="btn-success btn-zoom-in">+</button>
                    <button class="btn-success btn-zoom-out">-</button>
                </div>
                <div class="custom-tab-content">
                    @foreach($floors as $floor)
                    <div class="custom-tab-pane @if ($loop->first) is-active @endif" id="floor-{{$floor->slug}}">
                        <div class="row">
                            <div class="col-lg-12 hworkplace-dropzone">
                                @foreach($floor->active_tables as $table)

                                @if($table->is_occupied) <!-- If occupied -->
                                <div class="drag-drop-element table-element" style="top:{{$table->x_pos}}; left: {{$table->y_pos}}; width: {{$table->width}}; height: {{$table->height}};" data-slug="{{$table->slug}}" data-table-name="{{$table->name}}" data-floor-id="{{$floor->id}}" data-table-id="{{$table->id}}" data-occupied=true data-occupied-time="{{$table->start_time->format('Y/m/d H:i')}}" data-url="{{route('order.index',[$table->uuid])}}">

                                    <div class="table-element-content drag-item kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid mb-0">
                                        <div class="table-bg-number">{{$table->number}}</div>    
                                        <div class="table-overlay"></div>
                                        <div class="kt-portlet__body table-detail">
                                            <div class="kt-portlet__content">
                                                <div class="icon-text"><i class="la la-table"></i>: {{$table->name}}
                                                </div>
                                                <div class="icon-text"><i class="la la-dashboard"></i>: {{$table->start_time->format('m-d g:i A')}}
                                                </div>
                                                <div class="icon-text"><i class="la la-dashboard"></i>: <span class="occupied-time"></span>
                                                </div>
                                            </div>
                                        </div>  
                                        @if(1==2)

                                        @if($table->is_base == 1) 
                                        <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left">
                                            <a href="{{route('order.index',[$table->uuid])}}" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="View"><i class="flaticon-layer"></i>
                                            </a>
                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-book" data-table="{{$table->name}}" data-id="{{$table->id}}" data-floor="{{$floor->id}}" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Book"><i class="flaticon-layers"></i>
                                            </a>
                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Merge"><i class="la la-compress"></i>
                                            </a>
                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Manage Booking"><i class="la la-book"></i></a>
                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Move"><i class="la la-arrows-h"></i>
                                            </a>
                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="View"><i class="la la-eye"></i>
                                            </a>
                                        </div>
                                        @else
                                        <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left">
                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-unmerge" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Unmerge"><i class="la la-expand"></i>
                                            </a>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="win-cog"></div>

                                </div>
                                @else<!-- If not occupied -->
                                <div class="drag-drop-element table-element" style="top:{{$table->x_pos}}; left: {{$table->y_pos}}; width: {{$table->width}}; height: {{$table->height}};" data-slug="{{$table->slug}}" data-table-name="{{$table->name}}" data-floor-id="{{$floor->id}}" data-table-id="{{$table->id}}" data-url="{{route('order.index',[$table->uuid])}}">
                                    <div class="table-element-content drag-item kt-portlet table-empty  kt-portlet--solsid-dark kt-portlet--height-fluid mb-0">
                                        <div class="table-bg-number">{{$table->number}}</div>    
                                        <div class="table-overlay"></div>
                                        <div class="kt-portlet__body table-detail">
                                            <div class="kt-portlet__content">
                                                <div class="icon-text"><i class="la la-table"></i>:   {{$table->name}}
                                                </div>
                                                <div class="icon-text"><i class="la la-table"></i>:   Empty
                                                </div>
                                                <div class="icon-text"></div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="win-cog"></div>
                                </div>
                                @endif                                               
                                @endforeach
                                @foreach($floor->active_objects as $object)
                                <div class="drag-drop-object" style="top:{{$object->x_pos}}; left: {{$object->y_pos}}; width: {{$object->width}}; height: {{$object->height}};">
                                    <div class="obstacle-element" id="{{$object->uuid}}" data-slug="{{$object->slug}}">
                                        <p>Object : <span class="object-name">{{$object->name}}</span></p>
                                        <div class="win-size-grip"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach 

                </div>
            </div>
        </div>
    </main>
</div> 

@endsection

@section('modals')
<!-- modal for Table -->
<div class="modal fade horizontal" id="table-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog width-500" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Table Detail: <span class="table-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row tbl-detail">

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn btn-outline-success kt-margin-b-10 btn-md btn-block modal-occupy-btn" data-container="body" >
                            <i class="flaticon-layer"></i> 
                            <span class="kt-hidden-mobile">Occupy</span>                                
                        </a>                     
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success kt-margin-b-10 btn-md btn-block  btn-table-book" data-table="" data-id="" data-floor="">
                            <span class="kt-hidden-mobile">Book</span>                                
                        </button>                     
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success kt-margin-b-10 btn-md btn-block">
                            <span class="kt-hidden-mobile">Merge</span>                                
                        </button>                     
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success kt-margin-b-10 btn-md btn-block btn-table-move" >
                            <span class="kt-hidden-mobile">Move</span>                                
                        </button>                     
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-danger kt-margin-b-10 btn-md btn-block"  class="close" data-dismiss="modal" aria-label="Close">
                            <span class="kt-hidden-mobile">Close</span>                                
                        </button>                     
                    </div>
                </div>
                <div class="row move-to-table">

                </div>


            </div>
        </div>
    </div>
</div>

<!-- modal for table merge -->
<div class="modal modal-aside horizontal right right-modal" id="table-merge-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog width-500" role="document">
        <div class="modal-content">
            <form action="{{route('workplace.table.merge')}}" method="POST" id="table-merge-form">
                @csrf 
                <input type="hidden" name="uuid" id="base-table-uuid" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Merge Table To: <span class="table-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" id="modal-merging-tables">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="save-edit-form">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal for bookings table -->
<div class="modal fade modal-aside horizontal right right-modal" id="table-book-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog width-500" role="document">
        <div class="modal-content">
            <form action="#" method="POST" id="table-booking-form">
                @csrf 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Table Detail: <span class="table-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Customer Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">Customer Phone</label>
                            <input type="number" class="form-control" name="phone" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">PAX</label>
                            <input type="number" class="form-control" name="pax" placeholder="PAX" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">Customer Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Address" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">Table Name</label>
                            <input type="text" id="booking-table-name" class="form-control" name="table_name" value="" readonly>
                            <input type="hidden" id="booking-table-id" class="form-control" name="table_id" value="">
                            <input type="hidden" id="booking-table-floor-id" class="form-control" name="floor_id" value="">
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-12">
                            <label for="">Booking Date</label>
                            <input type="date" class="form-control" id="booking-table-date" name="booking_date" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">Booking From</label>
                            <input type="time" class="form-control" id="booking-time-start" name="from" min="" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="">Booking To</label>
                            <input type="time" class="form-control" id="booking-time-to" name="to" min="" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success save-booking-detail" data-content="content-loading-1" id="save-edit-form">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection

@section('css')
<link href="{{ asset('assets/css/workplace.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/workplaceh.css')}}" rel="stylesheet" type="text/css"/>
<style>

</style>
@endsection


@section('js')
<script src="{{ asset('assets/js/interact.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/custom/workplace.js') }}"></script>
    <!-- <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> -->
        <script>
            var floors = {!! json_encode($floors->toArray()) !!};
            setInterval(changeDifferance, 1000);

            function changeDifferance() {
                $('.table-element').each(function(i, obj) {
                    if($(obj).data('occupied'))
                    {
                        var occupied_time=new Date($(obj).data('occupied-time'))
                        var now= new Date();
                        var diff = Math.abs(now - occupied_time);
                    var difference = now.getTime() - occupied_time.getTime(); // This will give difference in milliseconds
                    var resultInMinutes = Math.round(difference / 60000);
                    $(obj).find('.occupied-time').text(resultInMinutes+'min')
                }
            })
            }

        </script>  
        <script src="{{ asset('assets/custom/table-merge.js') }}"></script> 
        <script>
            var double_click_delay=500
            jQuery.fn.single_double_click = function(single_click_callback, double_click_callback, timeout) {
                return this.each(function(){
                    var clicks = 0, self = this;
                    jQuery(this).click(function(event){
                        clicks++;
                        if (clicks == 1) {
                            setTimeout(function(){
                                if(clicks == 1) {
                                    single_click_callback.call(self, event);
                                } else {
                                    double_click_callback.call(self, event);
                                }
                                clicks = 0;
                            }, timeout || double_click_delay);
                        }
                    });
                });
            }
            $(document).on('click','.table-element-content',function () {
                window.location.href=$(this).closest('.table-element').data('url');
            })
            $(document).on('click','.win-cog',function(){
                var $table=$(this).closest('.table-element')
                console.log($table.data('url'))
                var $modal=$('#table-modal');
                var occupy_url= $table.data('url');
                var table_name= $table.data('table-name');
                var floor_id= $table.data('floor-id');
                var table_id= $table.data('table-id');
                $modal.find('a.modal-occupy-btn').attr('href',occupy_url)
                $modal.find('button.btn-table-book').data('table',table_name)
                $modal.find('button.btn-table-book').data('id',table_id)
                $modal.find('button.btn-table-book').data('floor',floor_id)
                $modal.data('table-id',table_id)    
            //Check Occupied Status
            $.ajax({
                method: "POST",
                url: '/table/check-status',
                data: { 
                    table_id: table_id
                }
            })
            .done(function( data ) {
                var res=JSON.parse(data)
                if(res.is_occupied){
                    $modal.find('button.btn-table-move').removeAttr('disabled')
                }else{
                    $modal.find('button.btn-table-move').attr('disabled','disabled')
                }
                var tbl_detail=createTableDetailForm(res.table)
                $modal.find('.tbl-detail').html(tbl_detail)
                $modal.modal('show')
            })
            //If Occupied
            //If not Occupied
        })

            $(document).on('click','.btn-table-move',function(){
                var $modal=$('#table-modal');
                var table_id= $modal.data('table-id');

            //Get Empty Tables
            $.ajax({
                method: "GET",
                url: '/table/get-empty-table'
            })
            .done(function( data ) {
                var content='<hr><div class="col-md-12"><h5>Move to</h5></div>'
                $.each(data.data, function( index, value ) {
                    content+='<div class="col-md-3">'+
                    '<button class="btn btn-outline-success kt-margin-b-10 btn-md btn-block btn-table" data-table-name="'+value.name+'" data-id="'+value.id+'">'+
                    '<span class="kt-hidden-mobile">'+value.name+'</span>'+                                
                    '</button>'+                  
                    '</div>'
                });
                $('.move-to-table').html(content)
            })
            //Move confirmation
            $(document).on('click','.btn-table',function(){
                var table= $(this).data('table-name')
                var to_id=$(this).data('id')
                Swal.fire({
                    title: 'Move Table!',
                    text: 'Do you want to move this table to "'+table+'"?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then( function(result) {
                    if(result.value){
                        $.ajax({
                            method: "POST",
                            url: '/table/move',
                            data:{
                                from:table_id,
                                to:to_id
                            }
                        })
                        .done(function( data ) {
                            location.reload();
                        })
                    }
                })
            })
            //Move
        })
        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('input').val('');
            $(this).find('textarea').val('');
            $('.move-to-table').html('')
        })

        function createTableDetailForm(table){
            var content=''+
            '<div class="col-12">'+
            '<span class="tbl-header">Table:</span>'+
            '<span class="tbl-value">'+table.name+'</span>'+
            '</div>'+
            '<div class="col-12">'+
            '<span class="tbl-header">Floor:</span>'+
            '<span class="tbl-value">F1</span>'+
            '</div>'+
            '<div class="col-12">'+
            '<span class="tbl-header">Pax:</span>'+
            '<span class="tbl-value">2</span>'+
            '</div>'+
            '<div class="col-12">'+
            '<span class="tbl-header">Status:</span>'+
            '<span class="tbl-value">Occupied/Empty</span>'+
            '</div>'+
            '<div class="col-12">'+
            '<span class="tbl-header">Occupied At</span>'+
            '<span class="tbl-value">2019/09/10</span>'+
            '</div>'+
            '<div class="col-12">'+
            '<span class="tbl-header">Occupied Time</span>'+
            '<span class="tbl-value">2019/09/10</span>'+
            '</div>'
            return content;
        }

        //Zoomin And Zoomout Features
        $(document).on('click','.btn-zoom-in',function(){
            $(".table-element").each(function() {
                var this_width=$(this).width()
                var this_height=$(this).height()
                var pos = $(this).position();
                var aspect_ratio=this_width/this_height;
                var y_pos=40*1;
                var x_pos=40*aspect_ratio;
                $(this).width(this_width+(20*aspect_ratio));
                $(this).height(this_height+20);
                $(this).css('top', pos.top+x_pos+'px');
                $(this).css('left', pos.left+y_pos+'px');

            });
        })
        $(document).on('click','.btn-zoom-out',function(){
            $(".table-element").each(function() {              
                var this_width=$(this).width()
                var this_height=$(this).height()

                $(this).width(this_width-20);
                $(this).height(this_height-20);
            });
        })
            
        </script>
        @endsection


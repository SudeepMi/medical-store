@extends('layouts.app')
@section('title', 'Workplace')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <!-- <h3 class="kt-portlet__head-title"><i class="flaticon2-browser-2 kt-font-brand"></i>&nbsp; Workplace</h3> -->
                        <a href="javascript:void(0);" class="kt-hidden-mobile kt-margin-r-10"><i class="flaticon2-browser-2 kt-font-brand fs-40" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Truffle Workplace"></i></a>
                        <div class="input-group search-block">
                            <div class="input-group-prepend kt-hidden-mobile"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                            <input type="text" name="search" class="form-control" placeholder="Search..." autocomplete="off">
                            <div class="input-group-append"><span class="input-group-text"><a href="#" class="clear-search"><i class="la la-times"></i></a></span></div>
                        </div>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="drag-object">
                            <a href="{{ route('workplace.edit') }}" class="btn btn-outline-dark kt-margin-r-10" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Edit workplace layout">
                                <i class="flaticon-edit"></i> 
                                <span class="kt-hidden-mobile">Edit</span>                                
                            </a> 
                        </div>
                       
                        <div class="btn-group kt-margin-r-10">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-price-tag"></i> 
                                <span class="kt-hidden-mobile">Order Type</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-shopping-cart-1"></i> &nbsp; 
                                            <span class="kt-nav__link-text">Retail</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-paperplane"></i> &nbsp; 
                                            <span class="kt-nav__link-text">Take Away</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-phone"></i> &nbsp; 
                                            <span class="kt-nav__link-text">Pick Up</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-automobile"></i> &nbsp; 
                                            <span class="kt-nav__link-text">Delivery</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-piggy-bank"></i>  &nbsp; 
                                            <span class="kt-nav__link-text">Add Tips</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon-price-tag"></i>  &nbsp; 
                                            <span class="kt-nav__link-text">Merge Bill</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Order List -->
                            <div class="btn-group kt-margin-r-10">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <!-- Order List -->
                        @if($floors)
                        <!-- Floor List -->

                            <div class="btn-group">
                                @if(count($floors)>0)
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$floors->first()->name}}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    
                                        <ul class="kt-nav nav-tabs" role="tablist">
                                        @foreach($floors as $floor)
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link btn-tabs" data-target="#floor-{{$floor->slug}}" data-title="{{$floor->name}}">
                                                    <span class="kt-nav__link-text">{{$floor->name}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                            
                                        </ul>
                                    </div>
                                @else 
                                    <button type="button" class="btn btn-warning" >
                                        No Floors
                                    </button>
                                @endif
                                
                            </div>
                        <!-- Floor List -->
                        @endif
                    </div>
                </div>
                <div class="kt-portlet__body workplace-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="custom-tab-content">
                            @foreach($floors as $floor)
                                <div class="custom-tab-pane @if ($loop->first) is-active @endif" id="floor-{{$floor->slug}}">
                                    <div class="row">
                                        <div class="col-lg-12 workplace-dropzone">
                                            @foreach($floor->active_tables as $table)
                                               
                                                @if($table->is_occupied) <!-- If occupied -->
                                                    <div class="drag-drop-element table-element" style="top:{{$table->x_pos}}; left: {{$table->y_pos}}; width: {{$table->width}}; height: {{$table->height}};" data-slug="{{$table->slug}}" data-name="{{$table->name}}" data-occupied=true data-occupied-time="{{$table->start_time->format('Y/m/d H:i')}}" data-url="{{route('order.index',[$table->uuid])}}">
                                                        <div class="drag-item kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid mb-0">
                                                            <div class="kt-portlet__body">
                                                                <div class="kt-portlet__content">
                                                                    <div class="icon-text"><i class="la la-table"></i>:   {{$table->name}}</div>
                                                                    <div class="icon-text"><i class="la la-dashboard"></i>:   {{$table->start_time->format('m-d g:i A')}}</div>
                                                                    <div class="icon-text"><i class="la la-dashboard"></i>:   <span class="occupied-time"><span></div>
                                                                    <!-- <div class="icon-text"><i class="la la-user"></i>:   {{$table->order->pax}}</div>
                                                                    @if($table->is_base != 1) 
                                                                        @php 
                                                                            $baseTable = App\Models\Table::where('id', $table->merged_with)->pluck('name');
                                                                        @endphp
                                                                        <div class="icon-text"><i class="la la-user"></i>:   {{$baseTable[0]}}</div>
                                                                    @else
                                                                        <div class="icon-text"></div>

                                                                    @endif -->
                                                                </div>
                                                            </div>  
                                                            @if(1==2)

                                                                @if($table->is_base == 1) 
                                                                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left">
                                                                        <a href="{{route('order.index',[$table->uuid])}}" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="View"><i class="flaticon-layer"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-book" data-table="{{$table->name}}" data-id="{{$table->id}}" data-floor="{{$floor->id}}" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Book"><i class="flaticon-layers"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Merge"><i class="la la-compress"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Manage Booking"><i class="la la-book"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Move"><i class="la la-arrows-h"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="View"><i class="la la-eye"></i></a>
                                                                    </div>
                                                                @else
                                                                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left">
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-unmerge" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Unmerge"><i class="la la-expand"></i></a>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else<!-- If not occupied -->
                                                    <div class="drag-drop-element" style="top:{{$table->x_pos}}; left: {{$table->y_pos}}; width: {{$table->width}}; height: {{$table->height}};" data-slug="{{$table->slug}}" data-name="{{$table->name}}" data-url="{{route('order.index',[$table->uuid])}}">
                                                        <div class="drag-item kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid mb-0">
                                                            <div class="kt-portlet__body">
                                                                <div class="kt-portlet__content">
                                                                    <div class="icon-text"><i class="la la-table"></i>:   {{$table->name}}</div>

                                                                    <?php $i=0; $is_booking = ''; $nextBook = [];?>
                                                                    @if(count($table->booked_table) > 0)
                                                                        @foreach($table->booked_table as $book)
                                                                            @if(($book['end_time'] > date('H:i:s')) && ($i == 0))
                                                                                <?php $i++; $is_booking = "true"; $nextBook = $book ?>
                                                                            @else
                                                                            <?php $is_booking = "false";?>
                                                                            
                                                                            @endif 
                                                                        @endforeach
                                                                        @if($is_booking = "true" && $nextBook != null) 
                                                                            <div class="icon-text"><i class="la la-table"></i>:   Booked</div>
                                                                            <div class="icon-text"><i class="la la-table"></i>:   {{$nextBook['booking_date']}} ({{date('H:i a', strtotime($nextBook['start_time']))}} - {{date('H:i a', strtotime($nextBook['end_time']))}})</div>
                                                                                                                                        
                                                                        @else
                                                                            <div class="icon-text"><i class="la la-table"></i>:   Empty</div>

                                                                            @if($table->is_base != 1) 
                                                                                @php 
                                                                                    $baseTable = App\Models\Table::where('id', $table->merged_with)->pluck('name');
                                                                                @endphp
                                                                                <div class="icon-text"><i class="la la-table" title="Mserged with"></i>: {{$baseTable[0]}}</div>

                                                                            @else
                                                                            <div style="height:17px;"></div>
                                                                            @endif
                                                                            <div style="height:17px;"></div>
                                                                        @endif

                                                                    @else
                                                                        <div class="icon-text"><i class="la la-table"></i>:   Empty</div>
                                                                    
                                                                        @if($table->is_base != 1) 
                                                                            @php 
                                                                                $baseTable = App\Models\Table::where('id', $table->merged_with)->pluck('name');
                                                                            @endphp
                                                                            <div class="icon-text"><i class="la la-table"></i>:   {{$baseTable[0]}}</div>

                                                                        @else
                                                                            <div class="icon-text"></div>

                                                                        @endif
                                                                            <div class="icon-text"></div>
                                                                            <div class="icon-text"></div>

                                                                    @endif
                                                                </div>
                                                            </div> 
                                                            @if(1==2)
                                                                @if($table->is_base == 1) 
                                                                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left">
                                                                        <a href="{{route('order.index',[$table->uuid])}}" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Occupy"><i class="flaticon-layer"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-book" data-table="{{$table->name}}" data-id="{{$table->id}}" data-floor="{{$floor->id}}" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Book"><i class="flaticon-layers"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-merge" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Merge" data-uuid="{{$table->uuid}}" data-floor="{{$floor->slug}}"><i class="la la-compress"></i></a>
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Manage Booking"><i class="la la-book"></i></a>
                                                                    </div>
                                                                @else
                                                                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left" style="height:46px;">
                                                                        <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-unmerge" data-base="{{$baseTable[0]}}" data-uuid="{{$table->uuid}}" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Unmerge"><i class="la la-expand"></i></a>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
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
                            <svg xmlns='http://www.w3.org/2000/svg' fill='%23fd27e…><circle cy='3' r='.5'/><circle cx='3' cy='3' r='.5'/></svg>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
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
                <div class="row">
                    <div class="col-12">
                        Table: Table 1
                    </div>
                    <div class="col-12">
                        Table: Table 1
                    </div>
                    <div class="col-12">
                        Table: Table 1
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('workplace.edit') }}" class="btn btn-outline-success kt-margin-b-10 btn-md btn-block" data-container="body" >
                            <i class="flaticon-layer"></i> 
                            <span class="kt-hidden-mobile">Occupy</span>                                
                        </a>                     
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('workplace.edit') }}" class="btn btn-outline-success kt-margin-b-10 btn-md btn-block" data-container="body" >
                       
                            <span class="kt-hidden-mobile">Book</span>                                
                        </a>                     
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('workplace.edit') }}" class="btn btn-outline-success kt-margin-b-10 btn-md btn-block" data-container="body" >
                            
                            <span class="kt-hidden-mobile">Merge</span>                                
                        </a>                     
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('workplace.edit') }}" class="btn btn-outline-success kt-margin-b-10 btn-md btn-block" data-container="body" >
                            <span class="kt-hidden-mobile">Move</span>                                
                        </a>                     
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('workplace.edit') }}" class="btn btn-outline-danger kt-margin-b-10 btn-md btn-block" data-container="body" >
                          
                            <span class="kt-hidden-mobile">Close</span>                                
                        </a>                     
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
                </form>
            </div>
        </div>
    </div>
    



@endsection

@section('css')
    <link href="{{ asset('assets/css/workplace.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css"/>
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
                    }, timeout || 200);
                }
                });
            });
        }
        $(".table-element").single_double_click(function () {
            $('#table-modal').modal('show')
        }, function () {
            window.location.href=$(this).data('url');
        })
    </script>
@endsection


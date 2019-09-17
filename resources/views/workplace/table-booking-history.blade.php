@extends('layouts.app')
@section('title', 'Table Booking History')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                         Table Booking History
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Export Tools</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" id="export_print">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Print</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" id="export_copy">
                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                <span class="kt-nav__link-text">Copy</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" id="export_excel">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" id="export_csv">
                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                <span class="kt-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" id="export_pdf">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">


                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Booked By</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>PAX</th>
                            <th>Floor</th>
                            <th>Table Name</th>
                            <th>Booked For</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($bookHistory as $history)
                        @if(isset($history->booking_history) && $history->booking_history != null)
                        @foreach($history->booking_history as $book)
                            <tr data-id="{{$book->id}}">
                                <td>{{ $i++}}</td>
                                <td>{{ $book['customer_name'] }}</td>
                                <td>{{ $book['phone'] }} </td>
                                <td>{{ $book['customer_address'] }}</td>
                                <td>{{ $book['pax'] }}</td>
                                <td>{{ $history->floor['name'] }}</td>
                                <td>{{ $history['name'] }}</td>
                                <td>{{ date('d F, Y', strtotime($book['booking_date'])) }} <b>[{{ date('H:i a', strtotime($book['start_time'])) }} - {{ date('H:i a', strtotime($book['end_time'])) }}] </b></td>
                                <td  class="status-control" id="{{$book->status}}">
                                    @if($book->status == 1)
                                        <span class="btn btn-sm btn-success">Booked</span>
                                    @else
                                        <span class="btn btn-sm btn-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td nowrap>
                                    <a href="#" class="btn btn-sm btn-primary edit-booking-detail" data-id="{{$book->id}}"><i class="fas fa-edit"></i> Edit</a>
                                    @if($book['booking_date'] >= date('Y-m-d'))
                                    <a href="#" class="btn btn-sm btn-dark status-change-booking"><i class="fas fa-ban"></i> Update Status</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')

    <!-- modal for bookings table -->
    <div class="modal fade modal-aside horizontal right right-modal" id="table-book-modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-500" role="document">
            <div class="modal-content">
                <form action="#" method="POST" id="table-booking-form-edit">
                    @csrf 
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Booking Table Detail: <span class="table-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body booking-detail-content">
                    
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success update-booking-detail" data-content="content-loading-1" id="save-edit-form">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/booking-history.js') }}" type="text/javascript"></script>
@endsection


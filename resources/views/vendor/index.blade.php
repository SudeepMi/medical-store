@extends('layouts.app')
@section('title', 'Vendors')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                         Vendors
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <a href="{{ route('vendor.create') }}" class="btn btn-success kt-margin-r-10">
                                    <i class="la la-plus"></i>
                                    <span class="kt-hidden-mobile">Add</span>
                                </a>
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
                            <th>Name</th>
                            <th>PAN</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Adress</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($debitors as $deb)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$deb->name}}</td>
                                <td>{{$deb->pan}}</td>
                                <td>{{$deb->email }}</td>
                                <td>{{ $deb->phone }}</td>
                                <td>{{$deb->address }}</td>
                                <td>{{$deb->User->name }}</td>
                                <td nowrap>
                                        <a href="{{ route('vendor.payments',$deb->slug) }}">
                                                <button class="btn btn-sm btn-primary payments" data-slug="{{ $deb->slug }}"><i class="la la-money"></i>Payments</button>
                                            </a>

                                <a href="" data-slug="{{$deb->slug}}" class="debitor-view">
                                        <button class="btn btn-sm btn-success">
                                            <i class="fas fa-eye"></i>View</button>
                                    </a>


                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@section('modals')
    <div class="modal fade modal-aside horizontal right right-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="modal-title-name"></span></h5>
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



@endsection

@section('css')

    <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script>
            $(document).on('click','.debitor-view',function(e){
                e.preventDefault()
                var slug=$(this).data('slug')
                $.ajax({
                    method: "POST",
                    url: '/vendor/getDetail',
                    data: { slug: slug }
                })
                    .done(function( res ) {
                        $('.right-modal').modal('show');
                        $('.modal-title-name').text('Debitor Detail');
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


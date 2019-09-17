@extends('layouts.app')
@section('title', 'Threshold')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Threshold
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="{{ route('membership.threshold.create') }}" class="btn btn-success kt-margin-r-10">
                                <i class="la la-plus"></i>
                                <span class="kt-hidden-mobile">Add</span>
                            </a>
                            <span>
                                <button type="button" id="export" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="export">
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
                            </span>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($thresholds as $threshold)
                        <tr class="member-{{$threshold['slug']}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$threshold->name}}</td>
                            <td class="status">
                                @if($threshold->status==1)
                                <span class="true-type">Active</span>
                                @else
                                <span class="false-type">Inactive</span>
                                @endif
                            </td>


                            <th>
                                <a href="{{ route('membership.threshold.edit', $threshold->slug) }}" class="btn btn-sm btn-success"><i class="la la-edit"></i>Edit</a>
                                <a href="#" class="btn btn-sm btn-dark status-threshold" data-id="{{ $threshold->id }}" id="{{ $threshold->status }}"><i class="la la-ban"></i>Update Status</a>
                                <a href="#" class="btn btn-sm btn-primary detail-threshold" data-id="{{ $threshold->id }}"><i class="la la-eye"></i> Detail</a>
                            </th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
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
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script>
            $(".status-threshold").on('click', function(e){
                e.preventDefault()

            var $this = $(this);
            var id = $(this).data('id')
            console.log(id)
            if($this.attr('id') == 1) {
                msgText     = 'Do you want to inactivate this threshold ?';
                successMsg  = 'This threshold is inactivated now.';
                errorMsg    = 'Sorry, Could not Inactivate this threshold at this time. Please try again.';
                content     = '<span class="false-type">Inactive</span>';
                new_val     = 0;

        } else {
            msgText     = 'Do you want to activate this threshold  ?';
            successMsg  = 'This threshold is Avilable now.';
            errorMsg    = 'Sorry, Could not Activate this threshold at this time. Please try again.';
            content     = '<span class="true-type">Active</span>';
            new_val     = 1;

        }

        Swal.fire({
        title: 'Are you sure?',
        text: msgText,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Sure !'

        }).then( function(result) {
        if(result.value){

            $.ajax({
                url: base_url+'/membership/threshold/updatestatus',
                data: {id: id},
                type: 'POST',
                async: false,
                success: function (response) {
                    console.log(response)
                    if(response.status != 'failed'){
                        $this.parents('tr').find('.status').html(content);
                        $this.attr('id', new_val);

                        Swal.fire(
                            { title: 'Updated!',
                              text: response.successMsg,
                              type: response.status,
                              toast:true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 1500,
                              background: '#1dc9b7',
                            color: 'white'}
                            )
                    } else {
                        'Sorry!',
                        response.successMsg,
                        response.status
                    }
                }
            });
        }
        })

    })
    $(document).on('click','.detail-threshold', function(e){
        e.preventDefault()
        var id = $(this).data('id');
        $.ajax({
            method: "POST",
            url: '/membership/threshold/details',
            data: { id: id}
        }).done( function(res){
            $('.edit-modal').modal('show');
            $('.edit-modal-info').html(res);
        })
    })
    </script>

@endsection

@section('modals')
    {{--  <div class="modal fade modal-aside horizontal right right-modal pay-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Credit Pay: <span class="modal-title-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="credit-payment-form" action="{{route('debtor.pay.credit')}}" data-action="{{route('debtor.pay.credit')}}">
                    <input type="hidden" name="debtor_slug" value="">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Credit Remaining</label>
                            <div class="col-9">
                                <input class="form-control" name="credit" type="text" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Amount paid</label>
                            <div class="col-9">
                                <input class="form-control" name="credit_payment" type="number" min=1  autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="sublit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>  --}}
    <div class="modal fade modal-aside horizontal right right-modal edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog width-80" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span class="edit-modal-title-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="edit-modal-body">
                <div class="edit-modal-info"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

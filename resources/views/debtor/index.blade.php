@extends('layouts.app')
@section('title', 'Debtor')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Debtor
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline">
                        <a href="{{ route('debtor.create') }}" class="btn btn-success kt-margin-r-10">
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Credit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($debtors as $debtor)
                        <tr class="debtor-{{$debtor->slug}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$debtor->name}}</td>
                            <td>{{$debtor->email}}</td>
                            <td>{{$debtor->phone}}</td>
                            <td class="credit-amount">{{$debtor->credit()}}</td>
                            <td nowrap>
                                @if($debtor->credit()>=1)
                                    <a href="" class="btn btn-sm btn-info btn-pay" data-id="{{$debtor->id}}" data-name="{{$debtor->name}}"><i class="fas fa-edit"></i> Pay</a>
                                @endif
                                    <a href=""  class="btn btn-sm btn-success view" data-id="{{$debtor->id}}"  data-slug="{{$debtor->slug}}"><i class="fas fa-eye"></i>View</a>
                             </td>
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
        $(document).on('click','.view',function(e){
            e.preventDefault()
            var slug=$(this).data('slug')
            console.log(slug);
            $.ajax({
                method: "POST",
                url: 'debtor/getDetail',
                data: { slug: slug }
            })
            .done(function( res ) {
                $('.debtor-detail').modal('show');
                $('.modal-debtor-info').html(res)
                console.log(res)
            });
        })
        $(document).on('click','.btn-pay',function(e){
            e.preventDefault()
            var id=$(this).data('id')
            var name=$(this).data('name')


            $.ajax({
                method: "GET",
                url: '/debtor/get-credit-detail',
                data: { id: id }
            })
            .done(function( res ) {
                var data=JSON.parse(res)
                if(!data.status){
                    alert(data.message)
                }else{
                    var $modal=$('.pay-modal')
                    $modal.find('.modal-title-name').text(data.data.name)
                    $modal.find('input[name="credit"]').val(data.data.credit)
                    $modal.find('input[name="debtor_slug"]').val(data.data.slug)


                    $modal.find('input[name="credit_payment"]').attr({
                        "max" : data.data.credit
                    });
                    $modal.modal('show')

                }
                // return false;
            });
        })
        $(document).on('submit','.credit-payment-form',function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).data('action'),
                data: $(this).serialize(),
                type: 'post',
                beforeSend: function() {
                    showLoader()
                },
                success: function(res) {
                    var data=JSON.parse(res)
                    var $tr=$('.debtor-'+data.debtor.slug)
                    $tr.find('.credit-amount').text(data.remaining_credit)
                    if(data.remaining_credit<=0){
                        $tr.find('.btn-pay').remove()
                    }
                    $('.modal').modal('hide')
                    removeLoader()
                }
            })
        })
    </script>
@endsection

@section('modals')
    <div class="modal fade modal-aside horizontal right right-modal pay-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>

    <div class="modal fade modal-aside horizontal right right-modal debtor-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Credit Pay: <span class="modal-title-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="modal-debtor-info"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

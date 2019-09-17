@extends('layouts.app')
@section('title', 'Tips Distribute')
@section('content')

    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Distribute Tips</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <form class="kt-form" id="kt_form" method="POST" action="{{route('tip.distribute') }}">
                            {{ @csrf_field() }}
                            <div class="btn-group">
                                <button type="submit" class="btn btn-brand">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">Save</span>
                                </button>
                            </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Tips Managment</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Remaining Tips Amount</label>
                                        <div class="col-9">
                                            <input class="form-control" name="cv_amount" type="number" value="{{ $amount }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Amount distributed</label>
                                    <div class="col-9">
                                        <input class="form-control @error('amount') is-invalid @enderror" name="tip_amount" type="number" value="{{ old('amount') }}" placeholder=" Amount Distributed" required>
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-3 col-form-label">Remarks</label>
                        <div class="col-9">
                            <textarea class="form-control" name="remarks"></textarea>
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Tips History
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button class="btn btn-success add-tips">
                                        <i class="la la-plus-circle"></i>
                                    <span class="kt-hidden-mobile">Add Tips</span>
                                </button>
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
                            <th>Created By</th>
                            <th>Remarks</th>
                            <th>Amount</th>
                            <th>Total Tip Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = $tips->count(); $cv =0; ?>
                        @foreach($tips as $tip)
                            <?php $cv = $cv + $tip->tip_amount; ?>
                            <tr>
                                <td>{{ $i-- }}</td>
                                <td>{{$tip->user->name }}</td>
                                <td>{{$tip->remarks}}</td>
                                <td>{{ $tip->tip_amount }}</td>
                                <td>{{ $cv}}</td>
                                <td >
                                    <a href="" data-id="{{$tip->id}}" class="tips-view">
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
@endsection

@section('css')

    <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script>
        $(document).on('click','.tips-view',function(e){
            e.preventDefault()
            var id=$(this).data('id')
            $.ajax({
                method: "POST",
                url: '/tip/getDetail',
                data: { id: id }
            })
                .done(function( res ) {
                    $('.right-modal').modal('show');
                    $('.modal-title-name').text('Tip Detail');
                    $('.modal-menu-info').html(res)
                    console.log(res)
                });
        })

        $(document).on('click','.add-tips', function(){
            $('.add-tip-modal').modal('show');
        })

        $('.add-tip-form').on('submit', function(e){
            e.preventDefault();
            var data = getData($(this));
            $.ajax({
                method: "POST",
                url: "/tip/add",
                data: { data: data}
            }).done( function(res){
                if(res != "failed") {
                    location.reload();
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else { console.log('issue');
                    Swal.fire(
                        'Sorry!',
                        response.errorMsg,
                        response.status
                    )
                }
            }).fail( function(res){
                getErrors(res)
            })
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
    <div class="modal fade modal-aside add-tip-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog width-80" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> <span class="add-modal-title-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form class='add-tip-form' method='POST'>
                    <div class="modal-body">
                        <div class="add-modal-info">

                                 <div class="form-group row">
                                    <label class="col-3 col-form-label">Amount </label>
                                    <div class="col-9">
                                        <input class="form-control" name="tip_amount" type="number" value="{{ old('amount') }}" placeholder="Amount" id="tip_amount" required autofocus />
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="error-tip_amount"></strong>
                                        </span>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-3 col-form-label">Remarks </label>
                                    <div class="col-9">
                                        <textarea class="form-control" name="remarks" id="remarks" placeholder="Remarks"></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="error-remarks"></strong>
                                        </span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-brand">
                             <i class="la la-check"></i>
                                <span class="kt-hidden-mobile">Save</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
@endsection

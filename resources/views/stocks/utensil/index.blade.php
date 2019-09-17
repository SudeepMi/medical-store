@extends('layouts.app')
@section('title', 'Stock Utensils')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Stock Utensils
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-success kt-margin-r-10 add-utensil">
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
                            <th>Opening Quantity</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Net Count</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>

                        @foreach($utensil as $it)
                            <tr>
                                <td>{{$i++}}</td>
                                <td class="utensil-name">{{$it->name}}</td>
                                <td>{{ $it->opening_count }}</td>
                                <td>{{ $it->in }}</td>
                                <td>{{ $it->out }}</td>
                                <td>{{ $it->net_count }}</td>
                                <td>{{$it->user->name }}</td>
                                <td>
                                    @if($it->status == 1)
                                   <span class="true-type"> Active</span>
                                    @else
                                    <span class="false-type"> Inctive</span>
                                    @endif
                                </td>
                                <td >
                                    <a data-slug="{{ $it->slug }}" href="#" class="edits">
                                        <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</button>
                                    </a>

                                    <a href="#" data-id="{{ $it->id }}" class="details">
                                        <button class="btn btn-sm btn-primary"><i class="la la-eye"></i>Detail</button>
                                    </a>

                                    <a href="#" data-id="{{ $it->id }}" class="adjustment-form">
                                        <button class="btn btn-sm btn-primary"><i class="la la-adjust"></i>Adjustment</button>
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
    <script src="{{ asset('assets/js/form.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script>

        $(document).on('click','.details', function(e){
                e.preventDefault();
                var id = $(this).data("id");
                $.ajax({
                method: "POST",
                url: '/stock/utensil/getDetail',
                data: { id: id }
                }).done(function( res ) {
                    $('.detail').modal('show');
                    $('.ad-modal-title-name').text('Utensil Detail');
                    $('.detail-modal-info').html(res)
                });
        })
        $(document).on('click','.adjustment-form', function(e){
            e.preventDefault();
            var id = $(this).data("id")
            $('.adjustment').modal('show');
            $('.utensil-adj').prepend('<input type="hidden" name="id" class="id" value="'+id+'">')

        })
        $(document).on('submit','.utensil-adj', function(e){
            e.preventDefault();
            var data = getData($(this))
            console.log(datas);
            $.ajax({
                method: "POST",
                url:  '/stock/utensil/adjust',
                data: { data: data },
                beforeSend: function(){
                    $("#send").html('sending');
               }
            }).done(function( res ) {
                if(res == "ok"){
                    var url = "/stock/utensil";
                   setTimeout($(location).attr('href', url),3000); // Using this
                }
            }).fail( function(res){
                getErrors(res)
                })
        })
        $(document).on('click','.edits', function(e){
            e.preventDefault();
            var slug = $(this).data('slug');
            $.ajax({
                method: "POST",
                url: '/stock/utensil/edit',
                data: { slug: slug},
            }).done(function(res){
                $('.edit').modal('show');
                $('.edit-modal-title-name').text('Edit Utensil');
                $('.modal-edit').html(res)

            });
        })
        $(document).on('submit', '.utensil_edit', function(e){
            e.preventDefault()
            var data = $(this).serializeArray()
            var stringData = JSON.stringify(data)
            $.ajax({
                method: "POST",
                url: '/stock/utensil/update',
                data: {data: stringData },
                error: function () {
                    console.clear()
                 }
            }).done(function(res){
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
        $(document).on('click','.add-utensil', function(e){
            e.preventDefault();
            $('.create').modal('show')
        })
        $(document).on('submit', '.create_utensil', function(e){
            e.preventDefault()
            var data = $(this).serializeArray()
            var stringData = JSON.stringify(data)
            $.ajax({
                method: "POST",
                url: '/stock/utensil/store',
                data: {data: stringData },
                error: function () {
                   console.clear()
                }
                }).done(function(res){

                if(res != "failed") {
                    location.reload();
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire(
                        'Sorry!',
                        res,

                    )
                }
                }).fail( function(res){
                var errors = JSON.parse(JSON.stringify(res.responseJSON.errors))
                for(var key in errors) {
                    var Inputselector = "#utensil-"+key;
                    var ErrorSelector = ".error-"+key;
                    $(Inputselector).addClass('is-invalid');
                    $(ErrorSelector).html(errors[key]);
                  }
                })
        })
        $(document).ready(function(){
            $("#adjust-count").on('blur', function(){
                if($(this).val().length){
                    $(this).removeClass('is-invalid')
                    $(".adjust-count").empty()
                }
            })
            $("#adjust-remarks").on('blur', function(){
                if($(this).val().length){
                    $(this).removeClass('is-invalid')
                    $(".adjust-remarks").empty()
                }
            })
            $("#utensil-update-name").on('blur', function(){
                if($(this).val().length){
                    $(this).removeClass('is-invalid')
                    $(".error-update-name").empty()
                }
            })
            $("#utensil-name").on('blur', function(){
                if($(this).val().length){
                    $(this).removeClass('is-invalid')
                    $(".error-name").empty()
                }
            })
        })
    

    </script>
@endsection
@section('modals')
    <div class="modal fade modal-aside horizontal right right-modal detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <span class="ad-modal-title-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="detail-modal-info"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-aside horizontal right right-modal adjustment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <span class="modal-title-name">Utensil Adjustment</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-utensil-info">
                        <form class="utensil-adj" name="adj-form">
                            @csrf
                            <div class="form-group">
                                <label>Adjustment Count</label>
                                <input type="number" class="form-control" name="count" id="adjust-count" >
                                <span class="invalid-feedback" role="alert">
                                    <strong class="adjust-count"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                    <label>Remarks:</label>
                                    <textarea name="remarks" class="form-control" required  id="adjust-remarks"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="adjust-remarks"></strong>
                                    </span>
                                </div>
                            <div class="row form-group">
                                    <div class="col-md-6">
                                <label class="kt-option">
                                    <span class="kt-option__control">
                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                            <input type="radio" name="type" value="stock_in" checked>
                                                <span></span>
                                        </span>
                                     </span>
                                    <span class="kt-option__label">
                                      <span class="kt-option__head">
                                        <span class="kt-option__title">Stock In</span></span>
                                    </span>
                                </label>
                            </div>
                                <div class="col-md-6">
                                <label class="kt-option">
                                    <span class="kt-option__control">
                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                            <input type="radio" name="type" value="stock_out">
                                            <span></span>
                                        </span>
                                    </span>
                                    <span class="kt-option__label">
                                        <span class="kt-option__head">
                                            <span class="kt-option__title">Stock Out</span></span>
                                    </span>
                                </label>
                            </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-success" id="send">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-aside right right-modal edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog width-80" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span class="edit-modal-title-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-edit"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>

    <div class="modal fade modal-aside  right right-modal create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <span class="create-modal-title-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-menu-info">

        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Add new Utensil</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                	  <form class="kt-form create_utensil" id="kt_form" method="POST">
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
                                    <h3 class="kt-section__title kt-section__title-lg">UTENSILS</h3>
                                    <div class="form-group row">

                                        <label class="col-3 col-form-label">utensil Name</label>
                                        <div class="col-9">
                                          <input class="form-control " name="name" type="text" value="{{ old('name') }}" placeholder="utensil name" id="utensil-name">
                                            <span class="invalid-feedback" role="alert">
                                        <strong class="error-name"></strong>
                                    </span>


                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <div class="row">
                        <label class="col-3 col-form-label">Opening stock</label>
                    <div class="col-9">
                        <input class="form-control" name="quantity" type="number" value="{{ old('quantity') }}" placeholder="opening stock count"  id="utensil-quantity" required>

                        <span class="invalid-feedback" role="alert">
                                        <strong class="error-quantity"></strong>
                                    </span>


                    </div>

                    </div>
                    </form>
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


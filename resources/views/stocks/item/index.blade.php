@extends('layouts.app')
@section('title', 'Stock Items')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                       Stock Items
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">

                        <a href="{{ route('stock.item.purchase') }}" class="btn btn-info kt-margin-r-10">
                            <i class="la la-plus"></i>
                            <span class="kt-hidden-mobile">Purchase</span>
                        </a>
                        <a href="{{ route('stock.item.create') }}" class="btn btn-success kt-margin-r-10">
                            <i class="la la-plus"></i>
                            <span class="kt-hidden-mobile">Add</span>
                        </a>
                        <div class="dropdown dropdown-inline hcustom-btn">

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
                <form class="kt-form kt-form--fit kt-margin-b-20">
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Date:</label>
                            <div class="input-daterange input-group" id="kt_datepicker">
                                <input type="text" class="form-control kt-input" name="from" placeholder="From" value="{{$from}}" data-col-index="6"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                </div>
                                <input type="text" class="form-control kt-input" name="to" placeholder="To" value="{{$to}}" data-col-index="6"/>
                            </div>
                        </div>
                    </div>

                    <div class="kt-separator kt-separator--md kt-separator--dashed"></div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-primary btn-brand--icon">
                                <span>
                                    <i class="la la-search"></i>
                                    <span>Search</span>
                                </span>
                            </button>

                            <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                <span>
                                    <i class="la la-close"></i>
                                    <span>Reset</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                <table class="table table-striped table-sm table-bordered table-hover table-checkable dataTable-init">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>ITEM CODE</th>
                            <th>Name</th>
                            <th>Opening Stock</th>
                            <th>Purchase</th>
                            <th>Sales</th>
                            <th>Net Stock</th>
                            <th>Available</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($items as $item)

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->item_code}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->opening_stock/$item->ratio}} {{ $item->si }} </td>
                            <td>{{$item->purchase/$item->ratio}} {{ $item->si }}</td>
                            <td>{{$item->sales/$item->ratio}} {{ $item->si }}</td>
                            <td>{{$item->net_stock/$item->ratio}} {{ $item->si }}</td>
                            <td>{{$item->available/$item->ratio}} {{ $item->si }}</td>

                            <td>{{$item->user->name }}</td>
                            <td class="status">
                                @if($item->is_active == 1)
                                   <span class="true-type"> Active</span>
                                @else
                                    <span class="false-type"> Inctive</span>
                                @endif
                            </td>
                            <td >
                                <a href="#" data-id="{{ $item->id }}" class="edit-form btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>
                                <a href="" data-id={{ $item->id }} class="stock-view btn btn-sm btn-success"><i class="fas fa-eye"></i>View</a>
                                <a href="#" data-id="{{ $item->id }}" class="adjustment-form btn btn-sm btn-primary"><i class="la la-adjust"></i>Adjustment</a>
                                <a href="#" class="btn btn-sm btn-dark status-stock-items" data-id="{{ $item->id }}" id="{{ $item->is_active }}"> Update Status</a>
                                <!-- // Delete button -->
                            {{--  <!-- <form action="{{route('stock.item.delete')}}" method="post" id="delform">
                             @csrf
                             <input type="hidden"  value="{{ $item->id }}" name="id"/>
                            </form>
                            <a href="#" onclick="document.getElementById('delform').submit();">Delete</a> -->  --}}
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
<link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script>
        $(document).on('click','.stock-view',function(e){
            e.preventDefault()
            var id=$(this).data('id')
            $.ajax({
                method: "POST",
                url: '/stock/item/getDetail',
                data: { id: id }
            })
                .done(function( res ) {
                    $('.detail').modal('show');
                    $('.modal-title-name').text('Stock Item Detail');
                    $('.modal-menu-info').html(res)
                    console.log(res)
                });
        })
        $(document).on('click','.adjustment-form', function(e){
            e.preventDefault();
            var id = $(this).data("id")
            $('.adjustment').modal('show');
            $('.stock-adj').prepend('<input type="hidden" name="id" class="id" value="'+id+'">')
        })
        $(document).on('submit','.stock-adj', function(e){
            e.preventDefault();
            var datas = $(this).serializeArray()
            console.log(datas);
            $.ajax({
                method: "POST",
                url:  '/stock/item/adjust',
                data:{
                    data: JSON.stringify(datas)
                },
                beforeSend: function(){
                    $("#send").html('<span><img src="{{ asset('assets/media/loader-sm.gif') }}">sending...</span>');
               },
               error: function(){
                   console.clear()
               }

            }).done(function(res) {
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
                    var Inputselector = "#adjust-"+key;
                    var ErrorSelector = ".adjust-"+key;
                    $(Inputselector).addClass('is-invalid');
                    $(ErrorSelector).html(errors[key]);
                  }
                })

            })

        $(document).on('click','.invoice-no', function(e){
            e.preventDefault()
          var invoice = $(this).data('invoice')
          console.log(invoice);
         $.ajax({
             method: "POST",
             url: '/stock/item/purchaseDetail',
             data: { invoice: invoice}
         })
         .done(function( res ) {
            $('.detail').modal('show');
            $('.modal-title-name').text('Stock Purchase Detail');
            $('.modal-menu-info').html(res)
            console.log(res)
            });
        })
        $(document).on('click','.edit-form', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                method: "POST",
                url: '/stock/item/edit',
                data: { id: id}
            }).done( function(res){
                $(".edit-modal").modal('show')
                $('.edit-modal-info').html(res)
            })
        })
        $(document).on('submit','.stock-edit-form', function(e){
            e.preventDefault()
            var data = JSON.stringify($(this).serializeArray())
            $.ajax({
                method: "POST",
                url: '/stock/item/update',
                data: { data: data}
            }).done( function(res){
                console.log(res);
                if(res == "ok") {
                    location.reload();
                    Swal.fire({
                        title: 'Updated!',
                        type: 'success',
                        toast:true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        background: '#1dc9b7',
                        color: 'white'
                    })
                    location.reload();
                } else {
                    Swal.fire(
                        'Sorry!',
                        res,
                    )

                }
        }).fail( function(res){
            var errors = JSON.parse(JSON.stringify(res.responseJSON.errors))
            for(var key in errors) {
                var Inputselector = "#update-"+key;
                var ErrorSelector = ".update-"+key;
                $(Inputselector).addClass('is-invalid');
                $(ErrorSelector).html(errors[key]);
              }
            })

    })
    </script>
    <script type="text/javascript">
        $(".status-stock-items").on('click', function(e){
            e.preventDefault()

        var $this = $(this);
        var id = $(this).data('id')
        console.log(id)
        if($this.attr('id') == 1) {
            msgText     = 'Do you want to Inactivate this stock Item?';
            successMsg  = 'This Item is Inactivated now.';
            errorMsg    = 'Sorry, Could not Inactivate this Setting at this time. Please try again.';
            content     = '<span class="false-type">Inactive</span>';
            new_val     = 0;

    } else {
        msgText     = 'Is this item is avialable now ?';
        successMsg  = 'This Item is Avilable now.';
        errorMsg    = 'Sorry, Could not Activate this Item at this time. Please try again.';
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
            url: base_url+'/stock/item/updatestatus',
            data: {id: id},
            type: 'POST',
            async: false,
            success: function (response) {
                console.log(response)
                if(response.status != 'failed'){
                    $this.parents('tr').find('.status').html(content);
                    $this.parents('tr').find('.status').attr('id', new_val);

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
                    Swal.fire(
                        {  title: 'Sorry!',
                       text: response.successMsg,
                      type:  response.status,
                      toast:true,
                      confirmButton: false,})
                }
            }
        });
    }
    })

})
</script>
@endsection
@section('modals')
 {{--  stock item details  --}}
<div class="modal fade modal-aside horizontal right right-modal detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
{{--  stock item adjustment  --}}
<div class="modal fade modal-aside horizontal right right-modal adjustment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <span class="modal-title-name">Stock Item Adjustment</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-utensil-info">
                        <form class="stock-adj" name="adjust-form">
                            @csrf
                            <div class="form-group">
                                <label>Adjustment Count</label>
                                <input type="number" class="form-control" name="count" id="adjust-count">
                                <span class="invalid-feedback" role="alert">
                                    <strong class="adjust-count"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                    <label>Remarks:</label>
                                    <textarea name="remarks" class="form-control" id="adjust-remarks"></textarea>
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

<div class="modal fade modal-aside center right-modal edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg width-80" role="document">
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



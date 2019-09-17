@extends('layouts.app')
@section('title', 'Retails')
@section('content')

    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Add Retail Items</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <form class="kt-form" id="kt_form" method="POST" action="{{route('retails.store') }}">
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
                                    <h3 class="kt-section__title kt-section__title-lg">Retail Items</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Name of Item</label>
                                        <div class="col-9">
                                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="Item Name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Price</label>
                                    <div class="col-9">
                                        <input class="form-control @error('price') is-invalid @enderror" name="price" type="number" value="{{ old('price') }}" placeholder="Price" required>
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-3 col-form-label">Quantity</label>
                                        <div class="col-9">
                                            <input class="form-control @error('quantity') is-invalid @enderror" name="quantity" type="number" value="{{ old('quantity') }}" placeholder="quantity" required>
                                            @error('quantity')
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

                        <label class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <textarea class="form-control  @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                            @error('description')
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
                           Retail Items
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
                            <th>Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name }}</td>
                                <td>{{$item->price}}</td>
                                <td class="status-control" id="{{$item->id}}"> @if ($item->status == 1)
                                        <span class="true-type">Active</span>
                                        @else
                                       <span class="false-type">Inactive</span>
                                @endif </td>
                                <td >

                                    <a href="" data-id="{{$item->id}}" class="items-view">
                                        <button class="btn btn-sm btn-success">
                                            <i class="fas fa-eye"></i>View</button>
                                    </a>

                                    <a href="#" class="btn btn-sm btn-primary " data-id="{{$item->id}}" data-name="{{ $item->name }}" data-value="{{$item->price}}">
                                        <i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-dark status-retail-items" data-id="{{ $item->id }}" id="{{ $item->status }}"><i class="fas fa-ban"></i> Update Status</a>
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
        $(document).on('click','.items-view',function(e){
            e.preventDefault()
            var id=$(this).data('id')
            $.ajax({
                method: "POST",
                url: '/retail_items/getDetail',
                data: { id: id }
            })
                .done(function( res ) {
                    $('.right-modal').modal('show');
                    $('.modal-title-name').text('item Detail');
                    $('.modal-menu-info').html(res)
                    console.log(res)
                });
        })
    </script>
    <script type="text/javascript">
        $(".status-retail-items").on('click', function(e){
            e.preventDefault()

        var $this = $(this);
        var id = $(this).data('id')
        console.log(id)
        if($this.attr('id') == 1) {
            msgText     = 'Do you want to Inactivate this Retail Item?';
            successMsg  = 'This Item is Inactivated now.';
            errorMsg    = 'Sorry, Could not Inactivate this Setting at this time. Please try again.';
            content     = '<span class="false-type">Inactive</span>';
            new_val     = 0;

    } else {
        msgText     = 'Is This Item Is Avialable Now ?';
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
            url: base_url+'/retail_items/updatestatus',
            data: {id: id},
            type: 'POST',
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {
                console.log(response)
                if(response.status != 'failed'){
                    $this.parents('tr').find('.status-control').html(content);
                    $this.parents('tr').find('.status-control').attr('id', new_val);

                    Swal.fire(
                        'Updated!',
                        response.successMsg,
                        response.status
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

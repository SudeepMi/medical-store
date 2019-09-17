@extends('layouts.app')
@section('title', 'Menu')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Menu Category
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline hcustom-btn">
                        <a href="{{ route('menu.category.create') }}" class="btn btn-success kt-margin-r-10">
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

                <form class="kt-form kt-form--fit kt-margin-b-20" style="display:none;">
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>RecordID:</label>
                            <input type="text" class="form-control kt-input" placeholder="E.g: 4590" data-col-index="0">
                        </div>
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>OrderID:</label>
                            <input type="text" class="form-control kt-input" placeholder="E.g: 37000-300" data-col-index="1">
                        </div>
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Country:</label>
                            <select class="form-control kt-input" data-col-index="2">
                                <option value="">Select a country</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Austria">Austria</option>
                                <option value="China">China</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Thailand">Thailand</option>
                            </select>
                        </div>
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Agent:</label>
                            <input type="text" class="form-control kt-input" placeholder="Agent ID or name" data-col-index="5">
                        </div>
                    </div>

                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Ship Date:</label>
                            <div class="input-daterange input-group" id="kt_datepicker">
                                <input type="text" class="form-control kt-input" name="start" placeholder="From" data-col-index="6"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                </div>
                                <input type="text" class="form-control kt-input" name="end" placeholder="To" data-col-index="6"/>
                            </div>
                        </div>
                    </div>

                    <div class="kt-separator kt-separator--md kt-separator--dashed"></div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-primary btn-brand--icon" id="kt_search">
                                <span>
                                    <i class="la la-search"></i>
                                    <span>Search</span>
                                </span>
                            </button>
                            &nbsp;&nbsp;
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

                <table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Item Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td id="CatName">{{$category->name}}</td>
                            <td id="{{$category->status}}" class="status-control">
                                    @if($category->status == 1)
                                    <span class="true-type">Active</span>
                                    @else
                                    <span class="false-type">Inactive</span>
                                    @endif

                            </td>
                            <td>{{$category->items->count()}}</td>
                            <td nowrap>
                              <a href="#" class="btn btn-sm btn-dark status-menu-category" data-id="{{ $category->id }}"><i class="fas fa-ban"></i> Update Status</a>
                              <a href="#" class="btn btn-sm btn-primary edit-menu-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}"><i class="fas fa-edit"></i> Edit</a>
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
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
        <script>
        $(document).on("click", ".status-menu-category", function(e){
            e.preventDefault();

            var $this = $(this);
            var id = $this.data('id');
            console.log(id)
            if($this.parents('tr').find('.status-control').attr('id') == 1) {
                msgText     = 'Do you want to Inactivate this Menu Category ?';
                successMsg  = 'This Menu Category is Inactivated now.';
                errorMsg    = 'Sorry, Could not Inactivate this Menu Category at this time. Please try again.';
                content     = '<span class="false-type">Inactive</span>';
                new_val     = 0;

            } else {
                msgText     = 'Do you want to Activate this Menu Category?';
                successMsg  = 'This Menu Category is Activated now.';
                errorMsg    = 'Sorry, Could not Activate this Menu Category at this time. Please try again.';
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
            confirmButtonText: 'Yes, change it!'

            }).then( function(result) {
            if(result.value){

                $.ajax({
                    url: base_url+'/menu/category/change-status',
                    data: {id: id},
                    type: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },

                    success: function (response) {
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

        $(document).on('click','.edit-menu-category', function(e){
            e.preventDefault();
            var name = $(this).data("name");
            var id = $(this).data("id");
            $(".edit").modal('show');
            $(".categoryname").html('<label>Name:</label>'+
            '<input class="form-control" name="name" type="text" placeholder="Name" value="'+name+'" id="cname" required data-id="'+id+'">')

        })
        $(document).on('submit','.mcedit-form', function(e){
            e.preventDefault()
            var newName = $("#cname").val()
            var id = $("#cname").data('id')
            $.ajax({
                method: "POST",
                url: '/menu/category/update',
                data: {id: id, name: newName}
            }).done( function(response){
                console.log(response.name)
                if(response.status != "failed") {

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

            })

    })
    </script>
        @endsection
@section('modals')
<div class="modal fade modal-aside right right-modal edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog width-80" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <span class="edit-modal-title-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-edit">
                    <form class="kt-form mcedit-form" id="kt_form" method="POST">
                        @csrf
                        <div class="form-group categoryname">
                            </div>
                        <div class="form-group">
                            <div class="btn-group hcustom-btn">
                                <button class="btn btn-brand" type="submit">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">Save</span>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

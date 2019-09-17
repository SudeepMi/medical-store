@extends('layouts.app')
@section('title', 'Menu')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Menu
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline">
                        <a href="{{ route('menu.item.create') }}" class="btn btn-success kt-margin-r-10">
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

                <form class="kt-form kt-form--fit kt-margin-b-20">
                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Code:</label>
                            <input type="text" class="form-control kt-input" placeholder="E.g: M********" data-col-index="1">
                        </div>

                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <label>Category:</label>
                            <select class="form-control kt-input" data-col-index="2">
                                <option value="ddd">Select any category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <!-- <div class="row kt-margin-b-20">
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
                    </div> -->

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
                            <th>CODE</th>
                            <th>CATEGORY</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>DISCOUNTABLE</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>
                                @if($item->is_discountable)
                                    Discountable
                                @else
                                    Not Discountable
                                @endif
                            </td>

                            <td class="status" id="{{ $item->status }}">
                                @if($item->status ==1)
                                    <span class="true-type">Active</span>
                                @else
                                <span class="false-type">Inactive</span>
                                @endif</td>
                            <td nowrap>
                                <a href="{{route('menu.item.edit',$item->slug)}}"><button class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</button></a>
                                <a href="" data-slug="{{$item->slug}}" class="menu-view"><button class="btn btn-sm btn-success"><i class="fas fa-eye"></i>View</button></a>
                                <a href="#" class="btn btn-sm btn-dark status-menu-items" data-id="{{ $item->id }}" id="{{ $item->status }}"> Update Status</a>
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
        $(document).on('click','.menu-view',function(e){
            e.preventDefault()
            var slug=$(this).data('slug')
            $.ajax({
                method: "POST",
                url: 'menu/getDetail',
                data: { slug: slug }
            })
            .done(function( res ) {
                $('.right-modal').modal('show');
                $('.modal-title-name').text('Mangit');
                $('.modal-menu-info').html(res)
                console.log(res)
            });
        })
        $(document).on("click", ".status-menu-items", function(e){
            e.preventDefault();
            var $this = $(this);
            var id = $this.data('id');

            if($this.parents('tr').find('.status').attr('id') == 1) {
                msgText     = 'Do you want to inactivate this item ?';
                successMsg  = 'This user is inactivated now.';
                errorMsg    = 'Sorry, Could not inactivate this item at this time. Please try again.';
                content     = '<span class="false-type">Inactive</span>';
                new_val     = 0;

            } else {
                msgText     = 'Do you want to Activate this item?';
                successMsg  = 'This User is Activated now.';
                errorMsg    = 'Sorry, Could not Activate this user at this time. Please try again.';
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
                    url: '/menu/item/change-status',
                    data: {id: id},
                    type: 'POST',
                    async: false,
                    success: function (response) {
                        if(response.status != 'failed'){
                            $this.parents('tr').find('.status').html(content);
                            $this.parents('tr').find('.status').attr('id', new_val);

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
    <div class="modal animated fade fadeInRight modal-aside horizontal right right-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menu Item: <span class="modal-title-name"></span></h5>
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

@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                           Users
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                                <a href="{{ route('user.create') }}" class="btn btn-success kt-margin-r-10">
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Adress</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{$user->role }}</td>
                                <td>{{$user->address }}</td>
                                <td id="{{$user->status}}" data-id="{{ $user->id }}">
                                        <div class="status-control">
                                           @if($user->status == 1)
                                           <span class="true-type">Active</span>
                                           @else
                                           <span class="false-type">Inactive</span>
                                           @endif
                                        </div>
                                     </td>
                                <td nowrap>
                                    <a href="{{route('user.edit',$user->username) }}"
                                         class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="" data-username="{{$user->username}}" class="menu-view">
                                        <button class="btn btn-sm btn-success">
                                            <i class="fas fa-eye"></i>View</button>
                                    </a>

                                    <a href="#" class="btn btn-sm btn-dark status-setting" data-id="{{ $user->id }}" id="{{ $user->status }}"><i class="fas fa-ban"></i> Update Status</a>

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
            var username=$(this).data('username')
            $.ajax({
                method: "POST",
                url: 'user/getDetail',
                data: { username: username }
            })
                .done(function( res ) {
                    $('.right-modal').modal('show');
                    $('.modal-title-name').text('User Detail');
                    $('.modal-menu-info').html(res)
                    console.log(res)
                });
        })

        $(document).on("click", ".status-setting", function(e){
            e.preventDefault();
            var $this = $(this);
            var id = $this.data('id');

            if($this.parents('td').attr('id') == 1) {
                msgText     = 'Do you want to Inactivate this User ?';
                successMsg  = 'This User is Inactivated now.';
                errorMsg    = 'Sorry, Could not Inactivate this User at this time. Please try again.';
                content     = '<span class="false-type">Inactive</span>';
                new_val     = 0;

            } else {
                msgText     = 'Do you want to Activate this User?';
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
                    url: 'user/change-status',
                    data: {id: id},
                    type: 'POST',
                    async: false,
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
    </script>
@endsection

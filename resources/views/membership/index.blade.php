@extends('layouts.app')
@section('title', 'Membership')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Members
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline">
                            <a href="{{ route('membership.create') }}" class="btn btn-success kt-margin-r-10">
                                <i class="la la-plus"></i>
                                <span class="kt-hidden-mobile">Add</span>
                            </a>
                            <!-- Types -->
                            <span>
                                <button type="button" id="membership" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="la la-download"></i> Membership Types
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="membership">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Types</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="{{route('membership.threshold.index')}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Threshold Discount</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="{{route('membership.repeat.index')}}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Repeat </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </span>
                            <!-- Types -->
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
                            <th>Membership No</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>DOB</th>
                            <th>Issued On</th>
                            <th>Expires</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($members as $member)
                        <tr class="member-{{$member->slug}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$member->name}}</td>
                            <td>{{$member->membership_no}}</td>
                            <td>{{$member->email}}</td>
                            <td>{{$member->phone}}</td>
                            <td>@if ($member->type==0)
                                Free
                            @else
                                Paid
                            @endif
                           </td>
                            <td>{{$member->dob->format('Y-m-d')}}</td>
                            <td>{{$member->issued_at->format('Y-m-d')}}</td>
                            <td>{{$member->expires_at->format('Y-m-d')}}</td>
                            <td class="status">@if ($member->status==1)
                                   <span class="true-type">Active</span>
                                @else
                                <span class="false-type">Inactive</span>
                                @endif
                               </td>
                            <td><a href="#" class="btn btn-sm btn-primary edit-member"  data-id="{{ $member->id }}"><i class="la la-edit"></i> Edit</a>
                                <a href="#" class="btn btn-sm btn-dark status-membership" data-id="{{ $member->id }}" id="{{ $member->status }}"><i class="la la-ban"></i>Update Status</a>
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
    <script type="text/javascript">
        $(".status-membership").on('click', function(e){
            e.preventDefault()

        var $this = $(this);
        var id = $(this).data('id')
        console.log(id)
        if($this.attr('id') == 1) {
            msgText     = 'Do you want to inactivate this membership ?';
            successMsg  = 'This membership is inactivated now.';
            errorMsg    = 'Sorry, Could not Inactivate this membership at this time. Please try again.';
            content     = '<span class="false-type">Inactive</span>';
            new_val     = 0;

    } else {
        msgText     = 'Do you want to activate this membership  ?';
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
            url: base_url+'/membership/updatestatus',
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

$('.edit-member').on('click', function(){
    var id = $(this).data('id');
    $.ajax({
        method: "GET",
        url: base_url+'/membership/edit',
        data: { id: id},
    }).done( function(res){
        $('.edit-modal').modal('show');
        $('.grops-form').html(res);
    })

})
$(document).on('change','select[name="type"]',function(){
    var content=''
    if($(this).val()==1){
        content+='<label>Membership Fee</label>'
        content+='<input class="form-control" name="membership_fee" type="number" placeholder="Membership Fee" min=1 required>'

    }
    $('#membership-fee').html(content)
})

$(document).on('submit','.member-edit-form', function(e){
    e.preventDefault()
    var data = JSON.stringify($(this).serializeArray())
    console.log(data)
    $.ajax({
        method: "POST",
        url: '/membership/update',
        data: { data: data}
    }).done( function(res){
        console.log(res);
        if(res == "ok") {
            Swal.fire({
                toast: true,
                type: 'success',
                title: 'Saved',
                showConfirmButton: false,
                timer: 1500
            })
            location.reload();
        } else {
            Swal.fire(
               { title: 'Sorry!',
                text: res.errorMsg,
                toast: true,
                type: 'error'}
            )
            location.reload();
        }
    }).fail( function(res){
        var errors = JSON.parse(JSON.stringify(res.responseJSON.errors))
        console.log(errors)
        for(var key in errors) {
            var Inputselector = "#update-"+key;
            var ErrorSelector = ".update-"+key;
            $(Inputselector).addClass('is-invalid');
            $(ErrorSelector).html(errors[key]);
        }
        })

})
</script>

@endsection

@section('modals')
<div class="modal fade modal-aside center edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg width-80" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <span class="edit-modal-title-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
            <form class="member-edit-form" method="POST">
                <div class="modal-body">
                    <div class="modal-info grops-form"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-brand" type="submit">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save</span>
                        </button>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection

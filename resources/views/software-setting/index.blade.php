@extends('layouts.app')
@section('title', 'Software Settings')

@section('content')
<div class="row">
   <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
      <form class="software-setting-form" id="soft_setting_form" method="POST" action="{{route('settings.store')}}">
         @csrf
         <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
               <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title">Software Setting</h3>
               </div>
               <div class="kt-portlet__head-toolbar" style="margin-top:20px;">
                  <div class="btn-group hcustom-btn">
                     <button class="btn btn-brand" type="submit">
                     <i class="la la-check"></i>
                     <span class="kt-hidden-mobile">Save</span>
                     </button>
                     <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     </button>
                     <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                           <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-reload"></i>
                              <span class="kt-nav__link-text">Save & continue</span>
                              </a>
                           </li>
                           <li class="kt-nav__item">
                              <a href="#" class="kt-nav__link">
                              <i class="kt-nav__link-icon flaticon2-power"></i>
                              <span class="kt-nav__link-text">Save & exit</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="kt-portlet__body">
               <div class="row">
                  <div class="col-12 col-lg-6 col-sm-12 col-xl-12 col-xs-12 col-md-12">
                     <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                           <h3 class="kt-section__title kt-section__title-lg">Add Setting Detail:</h3>
                           <div class="row">
                              <div class="col-md-12">
                                 <!-- Name -->
                                 <div class="form-group">
                                    <label>Name:</label>
                                    <input class="form-control" name="name" type="text" placeholder="Name" required>
                                 </div>
                                 <!-- Description -->
                                 <div class="form-group">
                                    <label>Value</label>
                                    <input type="text" class="form-control" name="value" id="value" placeholder="Value" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-15">
            <div class="kt-portlet kt-portlet--mobile">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <h3 class="kt-portlet__head-title">
                        Software Settings
                     </h3>
                  </div>
                  <div class="kt-portlet__head-toolbar">
                     <div class="kt-portlet__head-toolbar-wrapper">
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
                <table class="table table-striped table-sm table-bordered table-hover table-checkable dataTable-init">
                    <thead>
                        <tr>
                           <th>SN</th>
                           <th>Name</th>
                           <th>Value</th>
                           <th>Status</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($settings as $setting)
                        <tr data-id="{{$setting->id}}">
                           <td>{{$loop->iteration}}</td>
                           <td>{{$setting->name}}</td>
                           <td>{{$setting->value}}</td>
                           <td id="{{$setting->status}}">
                              <div class="status-control">
                                 @if($setting->status == 1)
                                 <span class="true-type">Active</span>
                                 @else
                                 <span class="false-type">Inactive</span>
                                 @endif
                              </div>
                           </td>
                           <td nowrap>
                              <a href="#" class="btn btn-sm btn-primary edit-software-setting" data-id="{{$setting->id}}" data-name="{{$setting->name}}" data-value="{{$setting->value}}"><i class="fas fa-edit"></i> Edit</a>
                              <a href="#" class="btn btn-sm btn-dark status-software-setting"><i class="fas fa-ban"></i> Update Status</a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
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
    $(document).on("click", ".edit-software-setting", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var name = $(this).data("name");
        var value = $(this).data("value");
        $("#software-setting-edit-form").modal("show");
        $("#software-setting-id").val(id);
        $("#software-setting-name").val(name);
        $("#software-setting-value").val(value);
    });

    $(document).on("click", ".status-software-setting", function(e){
        e.preventDefault();

        var $this = $(this);
        var id = $this.parents('tr').data('id');
        if($this.parents('tr').find('.status-control').attr('id') == 1) {
            msgText     = 'Do you want to Inactivate this Sortware Setting?';
            successMsg  = 'This Setting is Inactivated now.';
            errorMsg    = 'Sorry, Could not Inactivate this Setting at this time. Please try again.';
            content     = '<span class="false-type">Inactive</span>';
            new_val     = 0;

        } else {
            msgText     = 'Do you want to Activate this Booking?';
            successMsg  = 'This Setting is Activated now.';
            errorMsg    = 'Sorry, Could not Activate this Setting at this time. Please try again.';
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
                url: base_url+'/software-setting/change-status',
                data: {id: id},
                type: 'POST',
                async: false,
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
</script>
@endsection


@section('modals')
    <div class="modal fade modal-aside horizontal right right-modal" id="software-setting-edit-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-80" role="document">
            <form id="soft_setting__edit_form" method="POST" action="{{route('settings.update')}}">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Software Setting Edit: <span class="modal-title-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="software-setting-id" name="id" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Name -->
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input class="form-control" id="software-setting-name" type="text" placeholder="Name" readonly>
                                </div>
                                <!-- Description -->
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="text" class="form-control" id="software-setting-value" name="value" id="value" placeholder="Value" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection


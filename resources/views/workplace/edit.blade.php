@extends('layouts.app')
@section('title', 'Workplace')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <!-- <h3 class="kt-portlet__head-title"><i class="flaticon2-browser-2 kt-font-brand"></i>&nbsp; Workplace</h3> -->
                        <a href="javascript:void(0);" class="kt-hidden-mobile kt-margin-r-10"><i class="flaticon2-browser-2 kt-font-brand fs-40" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Truffle Workplace"></i></a>
                        <div class="input-group search-block">
                            <div class="input-group-prepend kt-hidden-mobile"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                            <input type="text" name="search" class="form-control" placeholder="Search..." autocomplete="off">
                            <div class="input-group-append"><span class="input-group-text"><a href="#" class="clear-search"><i class="la la-times"></i></a></span></div>
                        </div>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="save-workplace">
                            <button type="button" class="btn btn-outline-dark kt-margin-r-10" id="save-table" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Save workplace">
                                <i class="la la-floppy-o kt-hidden-mobile"></i> Save
                            </button> 
                        </div>
                        <div>
                            <a href="{{ route('floor.create') }}" class="btn btn-outline-dark kt-margin-r-10" data-container="body" data-toggle="kt-popover" >
                                <i class="la la-plus kt-hidden-mobile"></i> Floor
                            </a>
                        </div>
                        <div class="drag-element">
                            <button type="button" class="btn btn-outline-dark kt-margin-r-10" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Drag Me to the workplace">
                                <i class="la la-hand-rock-o kt-hidden-mobile"></i> Table
                            </button>
                        </div>
                        <div class="drag-object">
                            <button type="button" class="btn btn-outline-dark kt-margin-r-10" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Drag Me to the workplace">
                                <i class="la la-hand-rock-o kt-hidden-mobile"></i> Object
                            </button> 
                        </div>                        
                        <!-- Floor List -->
                            <div class="btn-group">
                                @if(count($floors)>0)
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$floors->first()->name}}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">                                    
                                        <ul class="kt-nav nav-tabs" role="tablist">
                                        @foreach($floors as $floor)
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link btn-tabs" data-target="#floor-{{$floor->slug}}" data-title="{{$floor->name}}">
                                                    <span class="kt-nav__link-text">{{$floor->name}}</span>
                                                </a>
                                            </li>
                                        @endforeach                                            
                                        </ul>
                                    </div>
                                @else 
                                    <button type="button" class="btn btn-warning" >
                                        No Floors
                                    </button>
                                @endif                                
                            </div>
                        <!-- Floor List -->
                    </div>
                </div>
                <div class="kt-portlet__body workplace-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="custom-tab-content">
                                @foreach($floors as $floor)
                                    <div id="bulb">
                                        <div class="custom-tab-pane @if ($loop->first) is-active @endif" id="floor-{{$floor->slug}}" data-slug="{{$floor->slug}}">
                                            <div class="row">
                                                <div class="col-lg-12 workplace-dropzone">                                            
                                                    @foreach($floor->active_tables as $table)                                                       
                                                        <div class="drag-drop-element" id="parent-tbl-{{$table->uuid}}" style="top:{{$table->x_pos}}; left: {{$table->y_pos}}; width: {{$table->width}}; height: {{$table->height}};" >
                                                            <div class="drag-item kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid mb-0  table-element" id="{{$table->uuid}}" data-slug="{{$table->slug}}" data-name="{{$table->name}}" data-uuid="{{$table->uuid}}" data-new=false data-floor="{{$floor->slug}}">
                                                                <div class="kt-portlet__body">
                                                                    <div class="kt-portlet__content">
                                                                        <!-- <div class="win-move-grip"></div> -->
                                                                        <div class="icon-text"><i class="la la-table"></i>:   <span class="table-name">{{$table->name}}</span></div>
                                                                        <div class="icon-text"><i class="la la-table"></i>:   <span class="table-status">Saved<span></div>
                                                                        <div class="icon-text">
                                                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-edit" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Edit" data-uuid="{{$table->uuid}}"><i class="la la-edit"></i></a>
                                                                            <a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-delete" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Delete" data-uuid="{{$table->uuid}}"><i class="la la-trash"></i></a>
                                                                        </div>
                                                                        <div class="win-size-grip"></div>
                                                                        <div class="win-move-grip"></div>
    
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>  
                                                    @endforeach
                                                    @foreach($floor->active_objects as $object)
                                                    <div class="drag-drop-object" id="parent-obj-{{$object->uuid}}" style="top:{{$object->x_pos}}; left: {{$object->y_pos}}; width: {{$object->width}}; height: {{$object->height}};">
                                                        <div class="obstacle-element" id="{{$object->uuid}}" data-slug="{{$object->slug}}" data-name="{{$object->name}}" data-uuid="{{$object->uuid}}" data-new=false data-floor="{{$floor->slug}}">
                                                            <p>Object : <span class="object-name">Stairs and Windows section</span></p>
                                                            <p>Status: <span class="object-status">Saved</span></p>
                                                            <button type="button" class="btn btn-outline-hover-dark btn-elevate btn-icon btn-object-edit" data-uuid="{{$object->uuid}}"><i class="la la-edit"></i></button>
                                                            <button type="button" class="btn btn-outline-hover-dark btn-elevate btn-icon btn-object-delete" data-uuid="{{$object->uuid}}"><i class="la la-trash"></i></button>
                                                            <div class="win-size-grip"></div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                @endforeach   
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>                            
@endsection

@section('modals')
    <!-- edit modal for table -->
    <div class="modal modal-aside horizontal right right-modal" id="table-edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-500" role="document">
            <div class="modal-content">
                <form action="" id="edit-form">
                    @csrf 
                    <input type="hidden" name="uuid" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Table: <span class="table-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="save-edit-form">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit modal for object -->
    <div class="modal modal-aside horizontal right right-modal" id="object-edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog width-500" role="document">
            <div class="modal-content">
                <form action="" id="object-edit-form">
                    @csrf 
                    <input type="hidden" name="uuid" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Object: <span class="object-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="save-edit-form">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{ asset('assets/css/workplace.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .workplace-dropzone {
            overflow: scroll;
        }
    </style>
 
@endsection

@section('js')
    <script src="{{ asset('assets/js/interact.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/workplace-edit.js') }}"></script>   
    <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> 
    <script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>
    <script>
        // table edit event
        $(document).on('click','.btn-table-edit',function(){
            var uuid= $(this).data('uuid');
            var name= $('#'+uuid).data('name');
            var slug= $('#'+uuid).data('slug');
            var floor = $('.custom-tab-pane.is-active').data('slug')
            $('#edit-form').find('.table-name').text(name)
            $('#edit-form').find('input[name=name]').val(name)
            $('#edit-form').find('input[name=uuid]').val(uuid)

            $('#table-edit-modal').modal('show');
        })

        // object edit event
        $(document).on('click','.btn-object-edit',function(){
            var uuid= $(this).data('uuid');
            var name= $('#'+uuid).data('name');
            var slug= $('#'+uuid).data('slug');
            var floor = $('.custom-tab-pane.is-active').data('slug')
            $('#object-edit-form').find('.object-name').text(name)
            $('#object-edit-form').find('input[name=name]').val(name)
            $('#object-edit-form').find('input[name=uuid]').val(uuid)

            $('#object-edit-modal').modal('show');
        })

        $('#object-edit-modal').on('hidden.bs.modal', function () {
            var form =$('#object-edit-form')
            var name=form.find('input[name="name"]').val('');
            var uuid=form.find('input[name="uuid"]').val('');
        })

        $(document).on('click','#save-object', function(){
            $('.loader-wrap').show()
            var tables = [];
            $('.table-element').each(function(i, obj) {
                var table = {
                        is_new: $(obj).data('new'),
                        uuid:   $(obj).data('uuid'),
                        name:   $(obj).data('name'),
                        floor:  $(obj).data('floor'),
                        pos_x:  $(obj).parent()[0].style.top,
                        pos_y:  $(obj).parent()[0].style.left
                    };
                tables.push(table);
            });
            //Update
            $.ajax({
                method: "POST",
                url: 'edit',
                data: { tables: JSON.stringify(tables) }
            })
            .done(function( res ) {
                //Change status
                $('.table-element').each(function(i, obj) {
                    $(obj).data('new', false);
                    $(obj).find('.table-status').text('Saved')
                });
                $('.loader-wrap').hide()
            });
            //Update

        })

        $('#object-edit-form').submit(function(e){
            e.preventDefault(); 
            var form =$('#object-edit-form')
            var name=form.find('input[name="name"]').val();
            var uuid=form.find('input[name="uuid"]').val();
            var obj=$('#'+uuid)
            obj.find('.object-name').text(name)
            obj.data('name',name)
            obj.find('.object-status').text('Not Saved')
            $('#object-edit-modal').modal('hide')
        })

        //Save
        $(document).on('click','#save-table', function(){
            showLoader()
            var tables = [];
            var objects = [];
            $('.table-element').each(function(i, obj) {
                var table = {
                        is_new: $(obj).data('new'),
                        uuid:   $(obj).data('uuid'),
                        name:   $(obj).data('name'),
                        floor:  $(obj).data('floor'),
                        pos_x:  $(obj).parent()[0].style.top,
                        pos_y:  $(obj).parent()[0].style.left,
                        width:  $(obj).parent()[0].style.width,
                        height:  $(obj).parent()[0].style.height
                    };
                tables.push(table);
            });
            $('.obstacle-element').each(function(i, obj) { 
                var object = {
                        is_new: $(obj).data('new'),
                        uuid:   $(obj).data('uuid'),
                        name:   $(obj).data('name'),
                        floor:  $(obj).data('floor'),
                        pos_x:  $(obj).parent()[0].style.top,
                        pos_y:  $(obj).parent()[0].style.left,
                        width:  $(obj).parent()[0].style.width,
                        height:  $(obj).parent()[0].style.height
                    };
                objects.push(object);
            });
            //Update
            $.ajax({
                method: "POST",
                url: 'edit',
                data: { tables: JSON.stringify(tables),
                        objects: JSON.stringify(objects), }
            })
            .done(function( res ) {
                //Change status
                $('.table-element').each(function(i, obj) {
                    $(obj).data('new', false);
                    $(obj).find('.table-status').text('Saved')
                });
                $('.obstacle-element').each(function(i, obj) {
                    $(obj).data('new', false);
                    $(obj).find('.object-status').text('Saved')
                });
                // $('.loader-wrap').hide()
                removeLoader()
                Swal.fire({
                    toast:true,
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })

            });
            //Update

        })
        $('#edit-form').submit(function(e){
            showLoader()
            e.preventDefault(); 
            var form =$('#edit-form')
            var name=form.find('input[name="name"]').val();
            var uuid=form.find('input[name="uuid"]').val();
            var obj=$('#'+uuid)
            obj.find('.table-name').text(name)
            obj.data('name',name)
            obj.find('.table-status').text('Not Saved')
            $('#table-edit-modal').modal('hide')
            removeLoader()

        })
        $('#table-edit-modal').on('hidden.bs.modal', function () {
            var form =$('#edit-form')
            var name=form.find('input[name="name"]').val('');
            var uuid=form.find('input[name="uuid"]').val('');
        })
        $('#table-edit-modal').on('hidden.bs.modal', function (e) {
            $('#edit-table-name').val('')
        })

        $(document).on("click", ".btn-table-delete", function(e){
            e.preventDefault();

            var uuid = $(this).data('uuid'); 
            
            msgText     = 'Do you want to delete this Table?';
            successMsg  = 'This Table is deleted now.';
            errorMsg    = 'Sorry, Could not Delete this Table at this time. Please try again.'; 

            Swal.fire({
                title: 'Are you sure?',
                text: msgText,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then( function(result) {
                if(result.value){

                    $.ajax({
                        method: "POST",
                            data: {uuid: uuid},
                            url: base_url+'/workplace/table-delete',
                            async: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (response) {
                            if(response.status != 'failed'){
                                Swal.fire(
                                    'Updated!',
                                    response.successMsg,
                                    response.status
                                    )
                                    $("#parent-tbl-"+uuid).hide( "explode", {pieces: 32 }, 2000);
                            } else {
                                'Sorry!',
                                response.errorMsg,
                                response.status
                            }
                        }
                    });
                }
            })

        });

        $(document).on("click", ".btn-object-delete", function(e){
            e.preventDefault();
            var $this = $(this);
            var uuid = $(this).data('uuid'); 
            
            msgText     = 'Do you want to delete this Object?';
            successMsg  = 'This Object is deleted now.';
            errorMsg    = 'Sorry, Could not Delete this Object at this time. Please try again.'; 

            Swal.fire({
                title: 'Are you sure?',
                text: msgText,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then( function(result) {
                if(result.value){
                    if(typeof uuid === "undefined") {
                        $this.parent('.obstacle-element').parent('.drag-drop-object').hide( "explode", {pieces: 32 }, 2000)
                    } else {
                        $.ajax({
                            method: "POST",
                                data: {uuid: uuid},
                                url: base_url+'/workplace/object-delete',
                                async: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if(response.status != 'failed'){
                                    Swal.fire(
                                        'Updated!',
                                        response.successMsg,
                                        response.status
                                        )
                                    $("#parent-obj-"+uuid).hide( "explode", {pieces: 32 }, 2000);
                                } else {
                                    'Sorry!',
                                    response.errorMsg,
                                    response.status
                                }
                            }
                        });
                    }
                }
            })

        });
    </script>
@endsection


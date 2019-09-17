@extends('layouts.app')
@section('title','Edit Threshold')
@section('content')

<form class="kt-form add-threshold-form" id="kt_form " method="POST" action="{{route('membership.threshold.update')}}" autocomplete="off">
    @csrf
    <input type="hidden" name="slug" value="{{ $threshold->slug }}">
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Threshold</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
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
                            <div class="col-12 col-sm-12 col-xl-12 col-xs-12 col-md-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Name" value="{{ $threshold->name ?? old('name') }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="row thresholds">

                                                        @foreach($threshold->details as $uuid=>$threshold)
                                                            <div class="threshold">
                                                                <div class="form-group">
                                                                @if ($loop->first)
                                                                    <button type="button" class="btn btn-sm btn-success btn-add-threshold">Add Threshold</button>
                                                                @else
                                                                    <button type="button" class="btn btn-sm btn-danger btn-remove-threshold">Remove Threshold</button>

                                                                @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" name="threshold[{{$uuid}}][0]" placeholder="Amount" value="{{$threshold[0]}}" min=1  required>

                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" name="threshold[{{$uuid}}][1]"  placeholder="Discount Percent" value="{{$threshold[1]}}" min=1 max=100 required>
                                                                </div>
                                                            </div>
                                                        @endforeach


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('css')

        <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .threshold{
                padding:2px;
            }
        </style>
@endsection

@section('js')
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>
    <script>
        $(document).on('click','.btn-add-threshold',function(e){
            var uuid=createUuid()
            e.preventDefault();
            var content='<div class="threshold">'+
                        '<div class="form-group">'+
                        '<button type="button" class="btn btn-sm btn-danger btn-remove-threshold">Remove Threshold</button>'+
                        '</div>'+
                        '<div class="form-group">'+
                        '<input type="number" class="form-control" name="threshold['+uuid+'][0]" placeholder="Amount" min=1  required>'+

                        '</div>'+
                        '<div class="form-group">'+
                        '<input type="number" class="form-control" name="threshold['+uuid+'][1]"  placeholder="Discount Percent" min=1 max=100 required>'+
                        '</div>'+
                        '</div>'
            $('.thresholds').append(content)
        })
        $(document).on('click','.btn-remove-threshold',function(e){
            $(this).parents('.threshold').remove()
        });
        // $(document).on('submit','.add-threshold-form',function(e){
        //     e.preventDefault()
        //     console.log($(this).serialize())
        // })


        function createUuid(length=32) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    </script>
@endsection

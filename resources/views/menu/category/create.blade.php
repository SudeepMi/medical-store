@extends('layouts.app')
@section('title','Create Menu Category')
@section('content')
<form class="kt-form" id="kt_form" method="POST" action="{{route('menu.category.store')}}">
@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Menu Category</h3>
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
                                    <button class="kt-nav__link drop-btn" type="submit" value="0" name="ref">
                                        <i class="kt-nav__link-icon flaticon2-reload"></i>
                                        <span class="kt-nav__link-text">Save & continue</span>
                                    </button>
                                </li>
                                <li class="kt-nav__item">
                                    <button class="kt-nav__link drop-btn" type="submit" value="1" name="ref">
                                        <i class="kt-nav__link-icon flaticon2-power"></i>
                                        <span class="kt-nav__link-text">Save & exit</span>
                                    </button>
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
                                    <h3 class="kt-section__title kt-section__title-lg">Menu Category Info:</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Name" value="{{ $name ?? old('name') }}" required>
                                                @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <!-- Description -->
                                            <div class="form-group">
                                                <label>Decription</label>
                                                <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"  placeholder="Description" rows="3" required>{{ $description ?? old('description') }}</textarea>
                                                @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">

                                                <label class="">Discountable</label>
                                                <div class="row">

                                                    <div class="col-lg-6">
                                                        <label class="kt-option" >
                                                                <span class="kt-option__control">
                                                                    <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                        <input type="radio" name="is_discountable" value="0"  checked>
                                                                        <span></span>
                                                                    </span>
                                                                    </span>
                                                            <span class="kt-option__label">
                                                                <span class="kt-option__head">
                                                                    <span class="kt-option__title">No</span>

                                                                    </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="kt-option" id="">
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="radio" name="is_discountable" value="1" @if(old('is_discountable')==1) checked @endif>
                                                                        <span></span>
                                                                </span>
                                                                </span>
                                                            <span class="kt-option__label">
                                                            <span class="kt-option__head">
                                                                <span class="kt-option__title">Yes</span>

                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="form-group discount-here">
                                                @if(old('discount'))
                                                    <label>Discount</label>
                                                    <input type="number" class="form-control  @error('discount') is-invalid @enderror" name="discount" id="discount"  placeholder="Discount" min=1 max=100 value="{{ $discount ?? old('discount') }}" required>
                                                    @error('discount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                                @endif
                                            </div>


                                        </div>
                                        <div class="col-md-6">



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
           .bootstrap-switch {
                display: block !required;
            }
        </style>
@endsection

@section('js')
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>
    <script>
        $(document).on('change','input[name="is_discountable"]',function(){
            if($(this).val()==1){
                var content='<label>Discount</label><input class="form-control" type="number" name="discount" id="discount"  placeholder="Discount" min=1 max=100 required>'
                $('.discount-here').html(content)
            }
            else{
                $('.discount-here').html('')
            }
        })
    </script>
@endsection

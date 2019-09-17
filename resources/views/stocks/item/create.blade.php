@extends('layouts.app')
@section('title', 'Create Stock Item')
@section('content')
<form class="kt-form" id="kt_form" method="POST" action="{{route('stock.item.store') }}">
    {{ @csrf_field() }}
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Add stock item</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">

                        <div class="btn-group hcustom-btn">
                            <button type="submit" class="btn btn-brand">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Stock Item:</h3>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label class="">Item Name</label>
                                            <input class="@error('item_name') is-invalid @enderror form-control" name="item_name" type="text" value="{{ $item_name ?? old('item_name') }}" placeholder="Stock Item" required>
                                                @error('item_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                        <div class="col-6">
                                            <label class="">Item Price</label>
                                            <input class="@error('price') is-invalid @enderror form-control" name="price" type="text" value="{{ $price ?? old('price') }}" placeholder="Stock Item Price" required>
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <label>Unit</label>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="kt-option">
                                                        <span class="kt-option__control">
                                                            <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                <input type="radio" name="unit" value="kg" checked>
                                                                    <span></span>
                                                            </span>
                                                            </span>
                                                        <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">KG</span>

                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="radio" name="unit" value="litre">
                                                                        <span></span>
                                                                </span>
                                                                </span>
                                                        <span class="kt-option__label">
                                                            <span class="kt-option__head">
                                                                <span class="kt-option__title">Litre</span>

                                                                    </span>
                                                            </span>
                                                    </label>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="radio" name="unit" value="packet">
                                                                        <span></span>
                                                                </span>
                                                            </span>
                                                        <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Packets</span>

                                                                    </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <div class="col-6">
                                        <label>Opening Stock</label>
                                            <input class="@error('opening_stock') is-invalid @enderror form-control" name="opening_stock" type="number" value="{{ $opening_stock ?? old('opening_stock') }}" placeholder="Opening Stock" min=0>
                                            @error('opening_stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
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

@endsection

@section('css')
        <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
@endsection

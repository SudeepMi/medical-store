@extends('layouts.app')

@section('title', 'Edit Menu Item')
@section('content')

<form class="kt-form" id="kt_form" method="POST" action="{{route('menu.item.update')}}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="item_slug" value="{{$item->slug}}">
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Menu Item Edit</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="btn-group">
                        <button class="btn btn-brand" type="submit">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Update</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12 col-xl-12  col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Menu Item Info: {{$item->code}}</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input class="form-control" name="name" type="text" placeholder="Name" value="{{$item->name}}" required>

                                            </div>
                                            <!-- Price -->
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control" type="number" name="price" placeholder="Price" value="{{$item->price}}" required>

                                            </div>
                                            <!-- Category -->
                                            <div class="form-group">
                                                <label>Category:</label>
                                                <select class="form-control kt-selectpicker" name="category" data-live-search="true" required>

                                                    <option value="" disabled selected>Select Any</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->slug}}" @if($category->id==$item->menu_category_id) selected @endif>{{$category->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>


                                            <!-- Discountable -->

                                            <div class="form-group">

                                                <label class="">Discountable</label>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="kt-option" id="">
                                                                <span class="kt-option__control">
                                                                    <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                        <input type="radio" name="is_discountable" value="1" @if($item->is_discountable ==1)checked @endif  id="discount_yes">
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

                                                    <div class="col-lg-6">
                                                        <label class="kt-option" >
                                                                    <span class="kt-option__control">
                                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                            <input type="radio" name="is_discountable" value="0" @if($item->is_discountable ==0)checked @endif id="discount_no">
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
                                                </div>

                                            </div>

                                            <div class="form-group" id="discount_per">
                                                @if($item->is_discountable ==1) 
                                                    <label>Discount %</label><input class="form-control" type="number" name="discount" placeholder="Discount %" value="{{$item->discount}}"min=1 max=100>
                                                @endif
                                            </div>
                                                <!-- Status -->
                                            <div class="form-group">

                                                    <label class="">Status</label>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label class="kt-option">
                                                                <span class="kt-option__control">
                                                                    <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                        <input type="radio" name="status" value="1" @if($item->status==1) checked @endif>
                                                                            <span></span>
                                                                    </span>
                                                                    </span>
                                                                <span class="kt-option__label">
                                                                <span class="kt-option__head">
                                                                    <span class="kt-option__title">Active</span>

                                                                    </span>
                                                                </span>
                                                            </label>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label class="kt-option">
                                                                    <span class="kt-option__control">
                                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                            <input type="radio" name="status" value="0" @if($item->status==0) checked @endif>
                                                                            <span></span>
                                                                        </span>
                                                                        </span>
                                                                <span class="kt-option__label">
                                                                    <span class="kt-option__head">
                                                                        <span class="kt-option__title">Inactive</span>

                                                                        </span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>

                                            </div>


                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- Description -->
                                            <div class="form-group">
                                                <label>Decription</label>
                                                <textarea class="form-control" name="description" id="description"  placeholder="Description" rows="13" required>{{$item->description}}</textarea>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class="upload-area @error('image') invalid @enderror"  id="uploadfile">
                                                       <div class="thumbnail" id="thumbnail">
                                                           <img src="{{ $images ?? asset('assets/media/logo.png') }}" width="150px" height="170px">
                                                       </div>
                                                    </div>
                                                    @error('image')
                                                        <span class="inavlid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                        <input type="file" class="files" name="image" value="{{ $item->img ?? old('item-img') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <!-- Stock -->
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Stock Items:</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Stock Items -->
                                            <div class="form-group">

                                                    <select class="form-control kt-selectpicker" name="stock_items" data-live-search="true" id="stock_items" multiple>
                                                        @foreach($stock_items as $item)
                                                            @if(in_array($item->slug, $this_stock))
                                                                <option id="stock-item-{{$item->id}}" value="{{$item->slug}}" data-unit="{{$item->unit}}"  data-name="{{$item->name}}"  data-slug="{{$item->slug}}" selected>{{$item->name}} s</option>
                                                            @else
                                                                <option id="stock-item-{{$item->id}}" value="{{$item->slug}}" data-unit="{{$item->unit}}"  data-name="{{$item->name}}"  data-slug="{{$item->slug}}">{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <!-- Name -->

                                        </div>
                                        <div class="col-md-6">
                                        <table class="table table-bordered" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Sn</th>
                                                        <th>Name</th>
                                                        <th>Unit</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stock-item-list">
                                                    @foreach($stocks as $stock)
                                                    <tr class="{{$stock->slug}}-stock">
                                                        <td><span class="list_sn"><span></td>
                                                        <td>{{$stock->name}}</td>
                                                        <td>{{$stock->unit}}</td>
                                                        <td><input class="form-control" type="number" name="item[{{$stock->slug}}]" value="{{$stock->pivot->quantity}}" required></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                           </table>

                                           <!-- Stock Items here -->
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

        <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/dragfile.css')}}" rel="stylesheet" type="text/css" />
        <style>
           .bootstrap-switch {
                display: block !required;
            }
        </style>
@endsection

@section('js')
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dragfile.js') }}" type="text/javascript"></script>
    <script>
        $('#stock_items').selectpicker()
        $('#stock_items').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var x = document.getElementById("stock_items");
            var option=x.options[clickedIndex]
            if(isSelected){ // Add Stock Item
                var unit=$(option).data('unit')
                var name=$(option).data('name')
                var slug=$(option).data('slug')
                var c= slug+'-stock'
                var tr=getTr(unit, name, slug, c)
                $('#stock-item-list').append(tr)
            }else{ // Remove Stock Item
                var slug=$(option).data('slug')
                var c= '.'+slug+'-stock'
                $(c).remove();
            }

        });
        function getTr(unit, name, slug, c){
            content=''
            content+='<tr class="'+c+'">'+
            '<td><span class="list_sn"><span></td>'+
            '<td>'+name+'</td>'+
            '<td>'+unit+'</td>'+
            '<td><input class="form-control" type="number" name="item['+slug+']" required></td>'+
            '</tr>'
            return content
        }
    </script>
    <script>
            $("#discount_yes").on('change',function() {
                $("#discount_per").append(' <label>Discount %</label><input class="form-control" type="number" name="discount" placeholder="Discount %" required>')
            })
            $("#discount_no").on('change',function() {
                $("#discount_per").empty()
            })
    </script>
@endsection

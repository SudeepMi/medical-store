@extends('layouts.app')

@section('title','Create Menu')

@section('content')


<form class="kt-form" id="kt_form" method="POST" action="{{route('menu.item.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Menu Item</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="btn-group">
                            <button class="btn btn-brand" type="submit" name="action" value="save">
                                <i class="la la-check"></i>
                                <span class="kt-hidden-mobile">Save</span>
                            </button>
                            <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">

                                        <i class="kt-nav__link-icon flaticon2-power"></i>
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
                                    <h3 class="kt-section__title kt-section__title-lg">Menu Item Info:</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Name" required>
                                                @error('name')
                                                <span class="inavlid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <!-- Price -->
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input class="form-control @error('price') is-invalid @enderror" type="number" name="price" placeholder="Price" required>
                                                @error('price')
                                                <span class="inavlid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <!-- Category -->
                                            <div class="form-group">
                                                <label>Category:</label>
                                                <select class="form-control kt-selectpicker @error('category') is-invalid @enderror" name="category" data-live-search="true" required>

                                                    <option value="" disabled selected>Select Any</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->slug}}">{{$category->name}}</option>
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
                                                                    <input type="radio" name="is_discountable" value="1" checked id="discount_yes">
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
                                                                        <input type="radio" name="is_discountable" value="0" checked id="discount_no">
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

                                            </div>
                                        </div>
                                        <div class="col-md-6"> <!-- Description -->

                                            <div class="form-group">
                                                <label>Decription</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"  placeholder="Description" rows="10" required></textarea>
                                                @error('description')
                                                <span class="inavlid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>

                                                <div class="upload-area @error('image') invalid @enderror"  id="uploadfile">
                                                        <h1>Drag File Here</h1>
                                                        <label for="files">or Upload File</label>
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
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                        <div class="col-12 col-sm-12 col-xl-12 col-xs-12 col-md-12">
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
                                                            <option id="stock-item-{{$item->id}}" value="{{$item->slug}}" data-unit="{{$item->unit}}"  data-name="{{$item->name}}"  data-slug="{{$item->slug}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <!-- Stock Items -->
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped" style="width:100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Sn</th>
                                                            <th>Name</th>
                                                            <th>Unit</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="stock-item-list">
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
        <link href="{{ asset('assets/css/dragfile.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
           .bootstrap-switch {
                display: block !required;
            }

            .invalid {
                border: 5px solid red;
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
            var subunit;
            switch(unit){
                case "kg":
                subunit = "gram";
                break;

                case "litre":
                subunit = "ml";
                 break;
                case "packet":
                subunit = "piece";
            }
            content=''
            content+='<tr class="'+c+'">'+
            '<td><span class="list_sn"><span></td>'+
            '<td>'+name+'</td>'+
            '<td>'+subunit+'</td>'+
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


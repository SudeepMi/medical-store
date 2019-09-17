
    <form class="kt-form stock-edit-form" id="kt_form" method="POST" action="{{route('stock.item.update') }}">
        @csrf
        <input type="hidden" value="{{ $item->slug }}" name="item_slug">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Edit stock item</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                          <div class="btn-group">
                        <button type="submit" class="btn btn-brand">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-10">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Stock Item:</h3>
                                        <label class="col-3 col-form-label">Item Name</label>
                                        <div class="col-9">
                                          <input class="form-control " id="update-item_name" name="item_name" type="text" value="{{ $item->name ?? old('item_name')}}" placeholder="Stock Item" >
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="update-item_name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>



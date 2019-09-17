
    <form class="kt-form utensil_edit" id="kt_form" method="post">
        @csrf
        <input type="hidden" name="slug" value="{{ $newuten->slug }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-3 col-form-label"> Name</label>
                                            <div class="col-9">
                                                <input class="form-control" name="name" id="utensil-update-name" type="text" value="{{ old('name') ?? $newuten->name }} " placeholder=" name" required>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="error-update-name"></strong>
                                                 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                <div class="row form-group">
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-3 col-form-label"> Status</label>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <label class="kt-option">
                                    <span class="kt-option__control">
                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                            <input type="radio" name="status" value="0" @if($newuten->status == 0) checked @endif>
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

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                        <label class="kt-option">
                                    <span class="kt-option__control">
                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                            <input type="radio" name="status" value="1" @if($newuten->status == 1) checked @endif>
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

                                </div>


                                <div class="btn-group">
                                    <button type="submit" class="btn btn-brand">
                                        <i class="la la-check"></i>
                                        <span class="kt-hidden-mobile">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



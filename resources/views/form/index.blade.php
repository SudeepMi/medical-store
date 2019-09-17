@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Sticky Form Actions <small class="small-txt">try to scroll the page</small></h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="#" class="btn btn-clean kt-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="kt-hidden-mobile">Back</span>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-brand">
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
                <form class="kt-form" id="kt_form">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Customer Info:</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">First Name</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="Nick">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Last Name</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="Watson">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Company Name</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="Loop Inc.">
                                            <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Contact Phone</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                <input type="text" class="form-control" value="+45678967456" placeholder="Phone" aria-describedby="basic-addon1">
                                            </div>
                                            <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Email Address</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-3 col-form-label">Company Site</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Username" value="loop">
                                                <div class="input-group-append"><span class="input-group-text">.com</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="kt-section">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Address Details:</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Country</label>
                                        <div class="col-9" >
                                            <select class="form-control kt-selectpicker" data-live-search="true" multiple>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Austria">Austria</option>
                                                <option value="China">China</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Thailand">Thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Address Line 1</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="District 6 1352 W. Olive Ave">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Address Line 2</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="Fresno 559-488-4020">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">City</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="Polo Alto">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">State / Province / Region</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="Los Angeles">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Zip / Postal Code</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" value="780456">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label"></label>
                                        <div class="col-9">
                                            <div class="kt-checkbox-single">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Use as shipping address.
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="kt-section">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Account:</h3>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Username</label>
                                        <div class="col-9">
                                            <div class="kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input">
                                                <input class="form-control" type="text" value="nick84">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Email Address</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                            </div>
                                            <span class="form-text text-muted">Email will not be publicly displayed. <a href="#" class="kt-link">Learn more</a>.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Language</label>
                                        <div class="col-9">
                                            <select class="form-control kt-selectpicker" data-live-search="true">
                                                <option>Select Language...</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Austria">Austria</option>
                                                <option value="China">China</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Thailand">Thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Time Zone</label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <select class="form-control kt-selectpicker" data-live-search="true"s>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Austria">Austria</option>
                                                <option value="China">China</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Thailand">Thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-group-last row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Communication</label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked> Email 
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked> SMS 
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Phone 
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                            <div class="kt-section kt-section--last">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Security:</h3>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Login verification</label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <button type="button" class="btn btn-outline-primary btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                                            <span class="form-text text-muted">
                                                After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised. 
                                                <a href="#" class="kt-link">Learn more</a>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Password reset verification</label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="kt-checkbox-single">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Require personal information to reset your password.
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">
                                                For extra security, this requires you to confirm your email or phone number when you reset your password.
                                                <a href="#" class="kt-link">Learn more</a>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Password reset verification</label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input data-switch="true" type="checkbox" data-on-color="info" data-on-text="Active" data-off-text="Inactive" data-handle-width="70">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Password reset verification</label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <input data-switch="true" type="checkbox" data-on-color="info" data-on-text="Enabled" data-off-text="Disabled" data-handle-width="70">
                                        </div>
                                    </div>
                                    <div class="form-group form-group-marginless">
                                        <label>Choose Delivery Type:</label>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="m_option_1" value="1" checked>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Standart Delivery</span>
                                                            <span class="kt-option__focus">Free</span>                                              
                                                        </span>
                                                        <span class="kt-option__body">
                                                            Estimated 14-20 Day Shipping 
                                                            (&nbsp;Duties end taxes may be due 
                                                            upon delivery&nbsp;)
                                                        </span>
                                                    </span>     
                                                </label> 
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                            <input type="radio" name="m_option_1" value="1">
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Fast Delivery</span>
                                                            <span class="kt-option__focus">$&nbsp;8.00 </span>                                              
                                                        </span>
                                                        <span class="kt-option__body">
                                                            Estimated 2-5 Day Shipping
                                                            (&nbsp;Duties end taxes may be due
                                                            upon delivery&nbsp;)
                                                        </span>
                                                    </span>     
                                                </label> 
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label"></label>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <button type="button" class="btn btn-outline-danger btn-sm kt-margin-t-5 kt-margin-b-5">Deactivate your account ?</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>

@endsection

@section('css')

<link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>
@endsection

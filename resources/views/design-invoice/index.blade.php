@extends('layouts.app')
@section('title', 'Design Invoice')
@section('content')
<div class="row hfont">
    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
            id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Software Setting</h3>
                </div>
                <div class="kt-portlet__head-toolbar" style="margin-top:20px;">
                    <div class="btn-group hcustom-btn">
                        <button class="btn btn-brand save-design-invoice-setting" type="submit">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save</span>
                        </button>
                        <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <div class="col-md-12">
                                        <!-- Name -->
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Company Name</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$settings != '' ? $settings['name-in-bill'] : '' }}" placeholder="Phone" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Company Address</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$settings != '' ? $settings['address-in-bill'] : '' }}" placeholder="Phone" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Company Phone</span>
                                                </div>
                                                <input type="text" class="form-control bill-design-text" value="{{$settings != '' ? $settings['phone-no-in-bill'] : '' }}" placeholder="Phone" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Company Reg. No.</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{$settings != '' ? $settings['vat-no-in-bill'] : '' }}" placeholder="Phone" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">BILL No.</span>
                                                </div>
                                                <input type="text" class="form-control" value="XXXXXXX (Auto fill)" readonly aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">BILL DATE</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{date('Y-m-d H:i:s')}}" readonly aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Customer Name</span>
                                                </div>
                                                <input type="text" class="form-control" value="Customer Name (Auto fill)" readonly aria-describedby="basic-addon1">
                                                <div class="input-group-prepend bill-design-right">
                                                    @if($config->show_customer_name == 1)
                                                    <a href="#" class="input-group-text" style="background-color: green;" id="customer-name-input-group">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @else
                                                    <a href="#" class="input-group-text" style="background-color: #ef4b4b;" id="customer-name-input-group">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" name="show_customer_name" id="show-customer-name" value="{{$config->show_customer_name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Customer PAN No.</span>
                                                </div>
                                                <input type="text" class="form-control" value="Customer Pan (Auto fill)" readonly aria-describedby="basic-addon1">
                                                <div class="input-group-prepend bill-design-right">
                                                    @if($config->show_pan_no == 1)
                                                    <a href="#" class="input-group-text" style="background-color: green;" id="customer-pan-input-group">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @else
                                                    <a href="#" class="input-group-text" style="background-color: #ef4b4b;" id="customer-pan-input-group">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" name="show_customer_pan" id="show-customer-pan" value="{{$config->show_pan_no}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Customer Address</span>
                                                </div>
                                                <input type="text" class="form-control" value="Customer Address (Auto fill)" readonly aria-describedby="basic-addon1">
                                                <div class="input-group-prepend bill-design-right">
                                                    @if($config->show_customer_address == 1)
                                                    <a href="#" class="input-group-text" style="background-color: green;" id="customer-address-input-group">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @else
                                                    <a href="#" class="input-group-text" style="background-color: #ef4b4b;" id="customer-address-input-group">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" name="show_customer_address" id="show-customer-address" value="{{$config->show_customer_address}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">BILL Amount in Words</span>
                                                </div>
                                                <input type="text" class="form-control" value="(Auto fill)" readonly aria-describedby="basic-addon1">
                                                <div class="input-group-prepend bill-design-right">
                                                    @if($config->show_amount_text == 1)
                                                    <a href="#" class="input-group-text" style="background-color: green;" id="bill-amount-input-group">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @else
                                                    <a href="#" class="input-group-text" style="background-color: #ef4b4b;" id="bill-amount-input-group">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" name="show_customer_address" id="show-bill-amount" value="{{$config->show_amount_text}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">BILL Greeting Note</span>
                                                </div>
                                                <input type="text" class="form-control" value="{{($settings != '') ? $settings['thank-you-note-in-bill'] : ''}}" aria-describedby="basic-addon1">
                                                <div class="input-group-prepend bill-design-right">
                                                    @if($config->show_greeting_note == 1)
                                                    <a href="#" class="input-group-text" style="background-color: green;" id="greeting-note-input-group">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @else
                                                    <a href="#" class="input-group-text" style="background-color: #ef4b4b;" id="greeting-note-input-group">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" name="show_greeting_note" id="show-greeting-note" value="{{$config->show_greeting_note}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row bill-design-form-row">
                                            <div class="input-group">
                                                <div class="input-group-prepend bill-design-parent">
                                                    <span class="input-group-text">Sales By: </span>
                                                </div>
                                                <input type="text" class="form-control" value="(Auto fill)" readonly value="Operator Name (Auto fill)" aria-describedby="basic-addon1">
                                                <div class="input-group-prepend bill-design-right">
                                                    @if($config->show_operator_name == 1)
                                                    <a href="#" class="input-group-text" style="background-color: green;" id="sales-by-input-group">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @else
                                                    <a href="#" class="input-group-text" style="background-color: #ef4b4b;" id="sales-by-input-group">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                    @endif
                                                    <input type="hidden" name="show_operator_name" id="show-sales-by" value="{{$config->show_operator_name}}">
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
        </div>
    </div>

    <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
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
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                        <div id="test-sample" style=" width: 750px; border:1px solid dimgray; ">
                            <table class="main-bill-sample" border="0" style="width: 100%; color: dimgray;">
                                <tr>
                                    <td style="text-align: center; text-transform: uppercase;">Tax Invoice</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; text-transform: uppercase;"
                                        class="company-name-text"><?php echo $settings['name-in-bill'] ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; text-transform: uppercase;"
                                        class="company-address-text"><?php echo $settings['address-in-bill'] ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; text-transform: uppercase;">phone : <span
                                            class="company-phone-text"><?php echo $settings['phone-no-in-bill'] ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; text-transform: uppercase;">Reg. no : <span
                                            class="company-reg-no-text"><?php echo $settings['vat-no-in-bill'] ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-transform: uppercase;">Bill no <span
                                            style="margin-left: 5px; margin-right: 5px;">:</span> <span>1234</span></td>
                                </tr>
                                <tr>
                                    <td style="">DATE <span style="margin-left: 22px; margin-right: 5px;">:</span>
                                        <span><?= date('Y-m-d H:i:s') ?></span></td>
                                </tr>
                                <tr id="bill-customer-name-html" style="{{$config['show_customer_name'] == 0 ? 'display:none' : ''}}">
                                    <td style="">Customer Name <span
                                            style="margin-left: 21px; margin-right: 5px;">:</span> <span>XXXXXX</span>
                                    </td>
                                </tr>
                                <tr id="bill-customer-pan-html" style="{{$config['show_pan_no'] == 0 ? 'display:none' : ''}}">
                                    <td style="">Customer PAN no <span
                                            style="margin-left: 6px; margin-right: 5px;">:</span> <span>XXXXXX</span>
                                    </td>
                                </tr>
                                <tr id="bill-customer-address-html" style="{{$config['show_customer_address'] == 0 ? 'display:none' : ''}}">
                                    <td style="">Customer Address <span
                                            style="margin-left: 6px; margin-right: 5px;">:</span> <span>XXXXXX</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" style="width: 100%; line-height: 20px;">
                                            <tr>
                                                <th
                                                    style=" border-top: 1px dashed #DCDCDC; border-bottom: 1px dashed #DCDCDC; font-weight: 400;">
                                                    SN</th>
                                                <th
                                                    style="text-align:left; border-top: 1px dashed #DCDCDC; border-bottom: 1px dashed #DCDCDC; font-weight: 400;">
                                                    PARTICULARS</th>
                                                <th
                                                    style="border-top: 1px dashed #DCDCDC; border-bottom: 1px dashed #DCDCDC; font-weight: 400;">
                                                    QTY.</th>
                                                <th
                                                    style="border-top: 1px dashed #DCDCDC; border-bottom: 1px dashed #DCDCDC; font-weight: 400;">
                                                    RATE</th>
                                                <th
                                                    style="padding:8px; border-top: 1px dashed #DCDCDC; border-bottom: 1px dashed #DCDCDC; font-weight: 400;">
                                                    AMOUNT</th>
                                            </tr>
                                            <tr style="text-transform: uppercase;">
                                                <td style="padding:5px 10px 0; vertical-align: top;">1</td>
                                                <td style="padding:5px 0px 0; vertical-align: top;">Marico Baker</td>
                                                <td style="padding:5px 10px 0; vertical-align: top;">19</td>
                                                <td style="padding:5px 10px 0; vertical-align: top;">50.50</td>
                                                <td style="padding:5px 10px 0; vertical-align: top;">1024</td>
                                            </tr>
                                            <tr style="text-transform: uppercase;">
                                                <td style="padding:1px 10px; vertical-align: top;">2</td>
                                                <td style="padding:1px 0px; vertical-align: top;">panpash masa colin
                                                    ultra</td>
                                                <td style="padding:1px 10px; vertical-align: top;">19</td>
                                                <td style="padding:1px 10px; vertical-align: top;">50.19</td>
                                                <td style="padding:1px 10px; vertical-align: top;">1024</td>
                                            </tr>
                                            <tr style="text-transform: uppercase;">
                                                <td style="padding:0px 10px 5px; vertical-align: top;">3</td>
                                                <td style="padding:0px 0px 5px; vertical-align: top;">ole ole ole ole
                                                </td>
                                                <td style="padding:0px 10px 5px; vertical-align: top;">19</td>
                                                <td style="padding:0px 10px 5px; vertical-align: top;">50</td>
                                                <td style="padding:0px 10px 5px; vertical-align: top;">1024</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="text-align:left; padding: 7px 1px 0; border-top: 1px dashed #DCDCDC;">
                                                    <span style=" margin-left: 45px;">Gross Amount</span></td>
                                                <td style="border-top: 1px dashed #DCDCDC; padding: 7px 0 0;">:</td>
                                                <td colspan="2"
                                                    style="text-align:left; padding: 8px 10px 0; border-top: 1px dashed #DCDCDC;">
                                                    <span style="margin-right: 14px;">20481</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align:left; padding: 1px;"><span
                                                        style=" margin-left: 45px;">Service Charge 10%</span></td>
                                                <td>:</td>
                                                <td colspan="2" style="text-align:left; padding: 1px 10px;"><span
                                                        style="margin-right: 14px;">100</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align:left; padding: 1px;"><span
                                                        style=" margin-left: 45px;">Discount</span></td>
                                                <td>:</td>
                                                <td colspan="2" style="text-align:left; padding: 1px 10px;"><span
                                                        style="margin-right: 14px;">100</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align:left; padding: 1px;"><span
                                                        style=" margin-left: 45px;">Taxable</span></td>
                                                <td>:</td>
                                                <td colspan="2" style="text-align:left; padding: 1px 10px;"><span
                                                        style="margin-right: 14px;">2148</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align:left; padding: 1px;"><span
                                                        style=" margin-left: 45px;">VAT 13%</span></td>
                                                <td>:</td>
                                                <td colspan="2" style="text-align:left; padding: 1px 10px;"><span
                                                        style="margin-right: 14px;">214.80</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align:left; padding: 1px;"><span
                                                        style=" margin-left: 45px;">Net Amount</span></td>
                                                <td>:</td>
                                                <td colspan="2" style="text-align:left; padding: 1px 10px;"><span
                                                        style="margin-right: 14px;">2148</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align:left; padding: 1px 4px 8px;"><span
                                                        style=" margin-left: 42px;">Changes Amount</span></td>
                                                <td style="padding: 1px 0px 8px;">:</td>
                                                <td colspan="2" style="text-align:left; padding: 1px 10px 8px;"><span
                                                        style="margin-right: 14px;">2148.16</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr id="bill-amount-in-words-html" style="{{$config['show_amount_text'] == 0 ? 'display:none' : ''}}">
                                    <td style="padding: 7px 0; border-top: 1px dashed #DCDCDC;"><span>Two Thousand One
                                            Hundred Forty Eight Only</span></td>
                                </tr>
                                <tr id="bill-greeting-note-html" style="{{$config['show_greeting_note'] == 0 ? 'display:none' : ''}}">
                                    <td style="padding: 7px 0; border-top: 1px dashed #DCDCDC;">
                                        <span><?php echo $settings['thank-you-note-in-bill'] ?></span></td>
                                </tr>
                                <tr id="bill-operator-name-html" style="{{$config['show_operator_name'] == 0 ? 'display:none' : ''}}">
                                    <td style="padding:7px 0; border-top: 1px dashed #DCDCDC;">
                                        SALES BY : XXXXXX
                                    </td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/custom/design-invoice.js')}}"></script>
@endsection

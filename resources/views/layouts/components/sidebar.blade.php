<div id="kt_quick_panel" class="kt-quick-panel">
    <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>

    <div class="kt-quick-panel__nav">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" data-toggle="tab" href="#main-menu-panel" role="tab">Main Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#main-settings" role="tab">Settings</a>
            </li>
        </ul>
    </div>

    <div class="kt-quick-panel__content">
        <div class="tab-content">
            <div class="tab-pane fade show kt-scroll active" id="main-menu-panel" role="tabpanel">
                <div class="kt-notification">

                    <a href="{{ route('design.index') }} " class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                            Bill Design
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('vendor.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Vendors
                                </div>
                            </div>
                    </a>
                    <a href="{{ route('debtor.index') }} " class="kt-notification__item">

                        <div class="kt-notification__item-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Debtors
                            </div>
                        </div>
                    </a>
                    <a href="{{route('drugs.category.index')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-line-chart kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Drugs Category
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('settings.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Software Settings
                                </div>
                            </div>
                    </a>
                    <a href="{{ route('drugs.item.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-box-1 kt-font-brand"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                   Drugs
                                </div>
                            </div>
                    </a>
                </div>
            </div>
            <div class="tab-pane kt-quick-panel__content-padding-x fade kt-scroll" id="main-settings" role="tabpanel">
                <form class="kt-form">
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Bill Setting</div>

                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Print KOT:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
                                <label>
                                    <input type="checkbox" @if($print_kot) checked="checked" @endif name="print_kot" class="bill-setting" data-key="print-kot">
                                    <span></span>
                            </label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Print Bill:</label>
                        <div class="col-4 kt-align-right">
                            <span class="kt-switch kt-switch--success kt-switch--sm">
                                <label>
                                    <input type="checkbox" @if($print_bill) checked="checked" @endif name="print_bill" class="bill-setting" data-key="print-bill">
                                    <span></span>
                            </label>
                            </span>
                        </div>
                    </div>

                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>


                </form>
            </div>
        </div>
    </div>
</div>

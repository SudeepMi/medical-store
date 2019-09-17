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

                    <!-- <a href="{{ route('bill.split') }} " class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-box-1 kt-font-brand"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                Bill Split
                                </div>
                            </div>
                    </a> -->

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
                    <a href="{{ route('membership.index') }} " class="kt-notification__item">

                        <div class="kt-notification__item-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Membership
                            </div>
                        </div>
                    </a>

                    <!-- <a href="{{ route('elements') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-box-1 kt-font-brand"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                Elements
                                </div>
                            </div>
                    </a> -->

                    <!-- <a href="{{route('form')}}" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-line-chart kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Form
                                </div>
                            </div>
                    </a>

                    <a href="{{ route('kot') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-box-1 kt-font-brand"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Kot
                                </div>
                            </div>
                    </a> -->

                    <a href="{{route('menu.index')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-line-chart kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Menu
                            </div>
                        </div>
                    </a>

                    <a href="{{route('menu.category.index')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-line-chart kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Menu Category
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('order.index') }} " class="kt-notification__item">

                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-box-1 kt-font-brand"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Order
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('retails.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Retails
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

                    <a href="{{ route('stock.item.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-box-1 kt-font-brand"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Stock Items
                                </div>
                            </div>
                    </a>

                    <a href="{{ route('tip.index') }} " class="kt-notification__item">

                        <div class="kt-notification__item-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Tips Managment
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('user.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                               <i class="fas fa-user"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                               Users
                                </div>
                            </div>
                    </a>

                    <a href="{{ route('stock.utensil.index') }} " class="kt-notification__item">

                            <div class="kt-notification__item-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title">
                                    Utensil
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

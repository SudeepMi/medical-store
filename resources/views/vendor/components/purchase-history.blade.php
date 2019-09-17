<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                     Purchase History
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <div class="dropdown dropdown-inline">
                           <a>Remaining Credit To Pay : {{ $info->total_credit - $info->amount_paid }}<a>
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                <table class="table table-striped- table-bordered table-hover table-checkable dataTable-init">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Invoice</th>
                        <th>Credit</th>
                        <th>Cash</th>
                        <th>Date</th>

                    </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1 ?>
                        @if (isset($info->purchase))
                        @foreach ($info->purchase as $purchase)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                       <a href="#" data-invoice="{{ $purchase->invoice }}" class="purchase-info kt-link kt-link--brand kt-font-bolder">{{ $purchase->invoice }}</a>
                                    </td>
                                    <td>{{ $purchase->credit ?? 0 }}</td>
                                    <td>{{ $purchase->cash ?? 0 }}</td>
                                    <td>{{ \Carbon\Carbon::parse ($purchase->created_at)->toFormattedDateString()  }}</td>

                                </tr>
                            @endforeach
                            @else
                       <tr>Purchase not Done</tr>
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@extends('layouts.app')
@section('title', 'Sales Report')
@section('content')
<input type="hidden" id="start-date" value="{{$date['start_date']}}">
<input type="hidden" id="end-date" value="{{$date['end_date']}}">

<div class="row">
    <div class="col-lg-6">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Sales Report
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="row">
                    <div class="col-lg-12" style="min-height:250px;">
                        <canvas id="sales-graph"></canvas>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Sales Report
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-toolbar-wrapper">
                        <form action="" id="daterange-form">
                            <input type="text" class="kt-input daterange" name="daterange" style="padding: .65rem 1rem;">
                            <div class="dropdown dropdown-inline">
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
                        </form>
                    </div>
                </div>      
            </div>
            <div class="kt-portlet__body">

                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-sm table-bordered table-hover table-checkable report-table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Invoice No</th>
                                    <th>Sub Total</th>
                                    <th>Dis Percent</th>
                                    <th>Discount</th>
                                    <th>SC Percent</th>
                                    <th>SC</th>
                                    <th>Total</th>
                                    <th>Round Value</th>
                                    <th>Cash</th>
                                    <th>Bank</th>
                                    <th>Credit</th>
                                    <th>Date</th>
                                    <th>User</th>




                                </tr>
                            </thead>

                            <tbody id="reports-container">
                           

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                            
                                                             
@endsection

@section('css')
        <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/aside-modal.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>

    <script>
        var report_table=$('.report-table').DataTable( {
                    responsive: true,                   
                });
        var ctx = document.getElementById('sales-graph').getContext('2d');
        var sales_graph = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                
                datasets: [{
                    label: 'Sales',
                    data: [],
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                            scaleLabel: {
                                display: false,
                                labelString: '1K=1000'
                            },
                            ticks: {
                                beginAtZero: true,                            
                                callback: function(label, index, labels) {
                                    return label/1000+'k';
                                }
                            }
                        }]
                }
            }
        });
        $(document).ready(function(){
            var from=$('#start-date').val()
            var to=$('#end-date').val()
            updateWeeklySalesChart(from,to)

            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                maxDate: moment()
            }, function(start, end, label) {
                updateWeeklySalesChart(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'))
            });
        })


        function updateWeeklySalesChart(from,to){  
            showLoader()
            $.ajax({
                method: "POST",
                data:{
                    from:from,
                    to:to
                },
                url: '/api/get-sales-report',            
            })
            .done(function( res ) {
                var data=JSON.parse(res)
                sales_graph.data.labels=data.labels
                sales_graph.data.datasets[0].data=data.data
                sales_graph.update()
                report_table.clear();
                report_table.destroy();
                var content=getTr(data.invoices)
                $('#reports-container').html(content)
                report_table=$('.report-table').DataTable( {
                    responsive: true,                   
                });
                removeLoader()

                window.history.pushState("", "Title", "/report/sales?daterange="+$('input[name="daterange"]').val());
            })
        }
        function getTr(invoices){
            console.log(invoices)
            var content=''
            $.each(invoices, function( index, invoice ) {
                content+='<tr>'
                content+='<td>'+ ++index +'</td>'
                content+='<td>'+invoice.invoice_no+'</td>'
                content+='<td>'+invoice.sub_total+'</td>'
                content+='<td>'+invoice.discount_percent+'</td>'
                content+='<td>'+invoice.discount+'</td>'
                content+='<td>'+invoice.service_charge_percent+'</td>'
                content+='<td>'+invoice.service_charge_amount+'</td>'
                content+='<td>'+invoice.total+'</td>'
                content+='<td>'+invoice.round+'</td>'
                content+='<td>'+invoice.cash+'</td>'
                content+='<td>'+invoice.bank+'</td>'
                content+='<td>'+invoice.credit+'</td>'
                content+='<td>'+invoice.date+'</td>'
                content+='<td>'+invoice.user+'</td>'

                content+='</tr>'
            });
            
            return content

        }
    </script>
@endsection

@section('modals')
@endsection

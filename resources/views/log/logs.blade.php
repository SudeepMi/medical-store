@extends('layouts.app')
@section('title', 'Recent Activity')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        Recent Logs
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline hcustom-btn">
                                <select name="class" id="log_class" class="form-control">
                                    <option selected disabled>Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class }}">{{ $class }}</option>
                                        @endforeach
                                            <option value="all" selected>All</option>
                                    </select>
                            </div>
                            <div class="dropdown dropdown-inline hcustom-btn">
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
                    <form class="kt-form kt-form--fit">
                        <div class="row kt-margin-b-20">
                            <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                                <label>Date:</label>
                                <div class="input-daterange input-group" id="kt_datepicker">
                                    <input type="text" class="form-control kt-input" name="from" placeholder="From" value="{{$from ?? old('from')}}" data-col-index="6"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                    </div>
                                    <input type="text" class="form-control kt-input" name="to" placeholder="To" value="{{$to ?? old('from')}}" data-col-index="6"/>
                                </div>
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--md kt-separator--dashed"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button class="btn btn-primary btn-brand--icon">
                                    <span>
                                        <i class="la la-search"></i>
                                        <span>Search</span>
                                    </span>
                                </button>

                                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                    <span>
                                        <i class="la la-close"></i>
                                        <span>Reset</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                    <table class="table table-striped- table-bordered table-hover table-checkable log-table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Message</th>
                            <th>Time</th>

                        </tr>
                        </thead>

                        <tbody id="logs">

                        {{-- @foreach($data as $log)
                            <tr>
                                <td>{{  $loop->iteration }}</td>
                                <td data-search="{{ $log->class }}">{{ $log->context->message }}</td>
                                <td>{{ $log->date->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('css')

    <link href="{{ asset('assets/css/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('assets/js/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/table-init.js') }}" type="text/javascript"></script>


   <script>
    var table=$('.log-table').DataTable( {
                    responsive: true,
                    buttons:["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
                });
        var classes = 'all';
        function FillLogs(classes){
            $.ajax({
                method: "GET",
                url: '/logs/logbook',
                data: { classes: classes},
            }).done(function(res){

                var data = JSON.parse(res)

                counter =1;
                var content=''
                for(var key in data){

                    var date = moment(data[key].date.date).format(' MMMM Do YYYY');
                    console.log(date);
                 content+='<tr>'
                        +'<td>'+counter+'</td>'
                        +'<td data-search='+key.class+'>'+data[key].context.message+'</td>'
                        +'<td>'+date+'</td></tr>'
                        counter++;
                }
                table.clear();
                table.destroy();
                $('#logs').html(content)
                table=$('.log-table').DataTable( {
                    responsive: true,
                    buttons:["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
                });
            })
        }

        $(document).ready(function(){
            FillLogs(classes);
        })

        $(function(){

            $('#log_class').on('change', function () {
                classes = $(this).val();
                FillLogs(classes)
            });


        });
    </script>


@endsection

@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-6 col-xl-6 col-sm-12 order-lg-1 order-xl-1">
            <div class="kt-portlet">
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <center><h5 class="pt-3 m-0">Sales Report (Last 7 days)</h5></center>
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <canvas id="weekly-sales"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 col-sm-12 order-lg-2 order-xl-2">
            <div class="kt-portlet">
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <center><h5 class="pt-3 m-0">Monthly Report (Last 12 months)</h5></center>

                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <canvas id="monthly-sales"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-6 col-sm-12 order-lg-3 order-xl-4">
            <div class="kt-portlet"> <!--Sales-->
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <center><h5 class="pt-3 m-0">Sales Report</h5></center>
                    <div class="row row-no-padding row-col-separator-xl">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Today
                                        </h4>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-brand">
                                        RS. {{ $sales['today'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            This Week
                                        </h4>
                                    </div>
                                    <span class="kt-widget24__stats kt-font-warning">
                                        RS. {{ $sales['week'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            This Month
                                        </h4>
                                    </div>

                                    <span class="kt-widget24__stats kt-font-danger">
                                            RS. {{ $sales['month'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Total
                                        </h4>
                                    </div>

                                    <span class="kt-widget24__stats kt-font-success">
                                            RS. {{ $sales['total'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-6 col-lg-6 col-sm-12 order-lg-3 order-xl-1">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Best Sellers
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab">
                                    Latest
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab">
                                    Month
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
                                    Year
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab4_content" role="tab">
                                    All time
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                            <div class="kt-widget5" id="latest-item">
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget5_tab2_content">
                            <div class="kt-widget5" id="month-item">
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget5_tab3_content">
                            <div class="kt-widget5" id="year-item">
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget5_tab4_content">
                            <div class="kt-widget5" id="alltime-item">

                            </div>
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
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <script>
    //Weekly Chart
        var ctx = document.getElementById('weekly-sales').getContext('2d');
        var weekly_chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['', '', '', '', '', '',''],
                datasets: [{
                    label: 'Sales',
                    data: [0,0,0,0,0,0,0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)'

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
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
    //Monthly Chart
    var ctx = document.getElementById('monthly-sales').getContext('2d');
        var monthly_chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', '','', '', '', '', '', ''],
                datasets: [{
                    label: 'Sales',
                    data: [0,0,0,0,0,0,0,0,0,0,0,0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',

                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
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
    $( document ).ready(function() {
        init();
    });

    function init(){
        updateWeeklySalesChart()
        updateMonthlySalesChart()
        RecentActivity()
        AlltimeBestSellers()
        LatestBestSellers()
        MonthBestSellers()
        YearBestSellers()
        // setTimeout(init, 9000);
    }
    function updateWeeklySalesChart(){
        $.ajax({
            method: "GET",
            url: 'api/get-weekly-sales',
        })
        .done(function( res ) {
            var data=JSON.parse(res)
            weekly_chart.data.labels=data.labels
            weekly_chart.data.datasets[0].data=data.data
            weekly_chart.update()

        })
    }
    function updateMonthlySalesChart(){
        $.ajax({
            method: "GET",
            url: 'api/get-monthly-sales',
        })
        .done(function( res ) {
            var data=JSON.parse(res)
            monthly_chart.data.labels=data.labels
            monthly_chart.data.datasets[0].data=data.data
            monthly_chart.update()

        })
    }
    function AlltimeBestSellers(){
        $.ajax({
            method: "POST",
            url: 'api/get-alltime-salers',
        })
        .done( function(res){
            var data = JSON.parse(res)
            $("#alltime-item").empty()
            for(var key in data){
                $("#alltime-item").append('<div class="kt-widget5__item">'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__section">'+
                            '<a href="#" class="kt-widget5__title">'+data[key].name+
                            '</a>'+
                            '<p class="kt-widget4__text">'+
                                'Menu Category'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__stats">'+
                            '<span class="kt-widget5__number">'+
                            '</span>'+data[key].quantity+
                            '<span class="kt-widget5__sales">Sales</span>'+
                        '</div>'+
                    '</div>'+
                '</div>')
            }

        })
    }

    function LatestBestSellers(){
        $.ajax({
            method: "POST",
            url: 'api/get-latest-salers',
        })
        .done( function(res){
            var data = JSON.parse(res)
            $("#latest-item").empty()
            for(var key in data){
                $("#latest-item").append('<div class="kt-widget5__item">'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__section">'+
                            '<a href="#" class="kt-widget5__title">'+data[key].name+
                            '</a>'+
                            '<p class="kt-widget4__text">'+
                                'Menu Category'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__stats">'+
                            '<span class="kt-widget5__number">'+
                            '</span>'+data[key].quantity+
                            '<span class="kt-widget5__sales">Sales</span>'+
                        '</div>'+
                    '</div>'+
                '</div>')
            }

        })
    }

    function MonthBestSellers(){
        $.ajax({
            method: "POST",
            url: 'api/get-month-salers',
        })
        .done( function(res){
            var data = JSON.parse(res)
            $("#month-item").empty()
            for(var key in data){
                $("#month-item").append('<div class="kt-widget5__item">'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__section">'+
                            '<a href="#" class="kt-widget5__title">'+data[key].name+
                            '</a>'+
                            '<p class="kt-widget4__text">'+
                                'Menu Category'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__stats">'+
                            '<span class="kt-widget5__number">'+
                            '</span>'+data[key].quantity+
                            '<span class="kt-widget5__sales">Sales</span>'+
                        '</div>'+
                    '</div>'+
                '</div>')
            }

        })
    }

    function YearBestSellers(){
        $.ajax({
            method: "POST",
            url: 'api/get-year-salers',
        })
        .done( function(res){
            var data = JSON.parse(res)
            $("#year-item").empty();
            for(var key in data){
                $("#year-item").append('<div class="kt-widget5__item">'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__section">'+
                            '<a href="#" class="kt-widget5__title">'+data[key].name+
                            '</a>'+
                            '<p class="kt-widget4__text">'+
                                'Menu Category'+
                            '</p>'+
                        '</div>'+
                    '</div>'+
                    '<div class="kt-widget5__content">'+
                        '<div class="kt-widget5__stats">'+
                            '<span class="kt-widget5__number">'+
                            '</span>'+data[key].quantity+
                            '<span class="kt-widget5__sales">Sales</span>'+
                        '</div>'+
                    '</div>'+
                '</div>')
            }

        })
    }

    function RecentActivity(){
        $.ajax({
            method: "get",
            url: 'api/get-today-logs',
        })
        .done( function(res){
          var data = JSON.parse(res)
          $("#activities").empty();
          for(var key in data){
            $("#activities").append('<div class="kt-timeline-v2__item"><span class="kt-timeline-v2__item-time">'+
                  '</span>'+data[key].time+
                  '<div class="kt-timeline-v2__item-cricle">'+
                        '<i class="fa fa-genderless kt-font-danger"></i>'+
                    '</div><div class="kt-timeline-v2__item-text  kt-padding-top-5">'+
                            data[key].message+' <a href="#" class="kt-link kt-link--brand kt-font-bolder"> '+ data[key].user+' </a></div></div>')

          }
        })

    }
    </script>
@endsection


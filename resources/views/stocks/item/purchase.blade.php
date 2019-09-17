@extends('layouts.app')

@section('title','Purchase Stock Items')
@section('css')

@endsection
@section('content')
<form class="kt-form  purchas-form" id="kt_form" method="POST" action="{{route('stock.item.purchase.store')}}">
@csrf
<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Purchase Stock Items</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="btn-group">
                        <button class="btn btn-brand" type="submit" id="submit">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save</span>
                        </button>
                        <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <button class="kt-nav__link drop-btn" type="submit" value="0" name="ref">
                                        <i class="kt-nav__link-icon flaticon2-reload"></i>
                                        <span class="kt-nav__link-text">Save & continue</span>
                                    </button>
                                </li>
                                <li class="kt-nav__item">
                                    <button class="kt-nav__link drop-btn" type="submit" value="1" name="ref">
                                        <i class="kt-nav__link-icon flaticon2-power"></i>
                                        <span class="kt-nav__link-text">Save & exit</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-xl-12 col-xs-12 col-md-12">
                            <!-- Stock -->
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h3 class="kt-section__title kt-section__title-lg">Stock Items:</h3>
                                    <div class="row">
                                        <div class="col-md-5">
                                                <!--debitors-->
                                                <div class="form-group">
                                                 <label>From :</label>
                                                 <select class="form-control kt-selectpicker" name="vendor" data-live-search="true" id="vendor" size="1" required>
                                                        <option selected>Choose Vendor</option>
                                                    @foreach($debitors as $debitor)
                                                        <option value="{{$debitor->slug}}" data-credit="{{ $debitor->total_credit }}" data-remaining="{{ $debitor->total_credit - $debitor->amount_paid ?? $debitor->opening_amount }}"  data-name="{{ $debitor->name}}" data-oamount="{{ $debitor->opening_amount}}"  data-slug="{{ $debitor->slug}}" >{{ $debitor->name}}</option>
                                                     @endforeach
                                                 </select>
                                         </div>
                                         <div class="form-group">
                                                <label>Invoice No :</label>
                                                <input type="number" class="form-control" name="invoice_no" placeholder="Invoice No." required>
                                             </div>
                                            <!-- Stock Items -->
                                            <div class="form-group">
                                                    <label>Stock Items:</label>
                                                    <select class="form-control kt-selectpicker" name="stock_items[]" data-live-search="true" id="stock_items" multiple required>
                                                        @foreach($items as $item)
                                                            <option id="stock-item-{{$item->id}}" value="{{$item->slug}}" data-unit="{{$item->unit}}"  data-name="{{$item->name}}"  data-slug="{{$item->slug}}" data-price="{{ $item->price }}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Mode Of Payment :</label>
                                                <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label class="kt-option" >
                                                        <span class="kt-option__control">
                                                            <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                    <input type="checkbox" name="mode[]" class="" id="cash" >
                                                                <span></span>
                                                            </span>
                                                            </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">Cash</span>

                                                            </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <label class="kt-option" >
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--check-bold kt-radio--dark">
                                                                        <input type="checkbox" name="mode[]" class="" id="credit" >
                                                                        <input type="hidden" name="total" value="" id="total_due">
                                                                    <span></span>
                                                                </span>
                                                                </span>
                                                        <span class="kt-option__label">
                                                            <span class="kt-option__head">
                                                                <span class="kt-option__title">Credit</span>

                                                                </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- Name -->

                                        </div>
                                        <div class="col-md-7">
                                                <table class="table table-bordered mt-4" style="width:100%;" id="">
                                                        <thead>
                                                            <tr>
                                                                <th>Debitor Name</th>
                                                                <th>Opening balance</th>
                                                                <th>Total Credit</th>
                                                                <th>Remain To Pay</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="debitor-info">

                                                            </tbody>
                                                </table>

                                           <table class="table table-bordered mt-4" style="width:100%;" id="stocks">
                                                <thead>
                                                    <tr>
                                                        <th>Sn</th>
                                                        <th>Name</th>
                                                        <th>Unit</th>
                                                        <th>Quantity</th>
                                                        <th>Rate</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stock-item-list">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan=5>Grand Total</th>
                                                        <th id="grand_total">0</th>
                                                    </tr>
                                                </tfoot>
                                           </table>
                                           <div class="col-md-8" style="width:100%;" id="payment">
                                            <div class="form-group" id="cashPay">

                                            </div>
                                            <div class="form-group" id="creditPay">

                                            </div>
                                           </div>
                                           <!-- Stock Items here -->
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
</form>

@endsection

@section('css')
        <link href="{{ asset('assets/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
           .bootstrap-switch {
                display: block !required;
            }
        </style>
@endsection

@section('js')
    <script src="{{ asset('assets/custom/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/custom/bootstrap-switch.js') }}" type="text/javascript"></script>

    <script>
        $('#stock_items').selectpicker()
        $('#stock_items').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var x = document.getElementById("stock_items");
            var option=x.options[clickedIndex]
            if(isSelected){ // Add Stock Item

                var subunit;
                var ratio;
                var unit=$(option).data('unit')
                switch(unit){
                    case "kg":
                    subunit = "gram";
                    ratio = 1000;
                    break;

                    case "litre":
                    subunit = "ml";
                    ratio = 1000;
                     break;
                    case "packet":
                    subunit = "piece";
                    ratio  = 1;
                }
                var name=$(option).data('name')
                var slug=$(option).data('slug')
                var price=$(option).data('price')
                var c= slug+'-stock'
                var tr=getTr(unit, name, slug, c, price,subunit,ratio)
                $('#stock-item-list').prepend(tr)

            }else{ // Remove Stock Item
                var slug=$(option).data('slug')
                var c= '.'+slug+'-stock'
                $(c).remove();
                $("#grandtotal").empty()
            }

        });
        function getTr(unit, name, slug, c, price,subunit,ratio){
            content=''
            content+='<tr class="stock-item '+c+'" id="">'+
            '<td><span class="list_sn"><span></td>'+
            '<td>'+name+'</td>'+
            '<td><select class="form-control kt-selectpicker change" id="units" name="unit['+slug+']"><option value="1"  data-id="1" selected>'+unit+'</option><option value="2" data-id="'+ratio+'">'+subunit+'</option></select></td>'+
            '<td><input class="form-control quantity change" value="" type="number" name="quantity['+slug+']" required></td>'+
            '<td><input class="form-control rate change" value="'+price+'" type="number" name="rate['+slug+']" required></td>'+
            '<td><input class="form-control total" value="" type="number" name="total['+slug+']" disabled required></td>'+
            '</tr>'
            return content
        }
    </script>
    <script>
        function p(){
            $("#cash_paid").on("keypress", function (evt) {
                if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                {
                    evt.preventDefault();
                }
            });
        }
    </script>
    <script>
            $('#vendor').selectpicker()
            $('#vendor').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var x = document.getElementById("vendor");
                var opt=x.options[clickedIndex]

                if(isSelected){ //add debitor detail
                    var remaining=$(opt).data('remaining')
                    var d_name=$(opt).data('name')
                    var opening_amount = $(opt).data('oamount')
                    var credit = $(opt).data('credit')
                    var d_slug=$(opt).data('slug')
                    var cl=slug
                    var clas='.'+cl
                    var tr=getTrs(remaining, d_name, d_slug, cl, opening_amount,credit)
                    $('#debitor-info').empty();
                    $('#debitor-info').append(tr)
                }else{ // Remove debitor detail

                    var slug=$(opt).data('slug')
                    var c= '.'+slug
                    $(c).remove();
                }

            });
            function getTrs(remaining, name, slug, c, opening_amount, credit){
                content=''
                content+='<tr class="'+c+'">'+
                '<td>'+name+'</td>'+
                '<td>'+opening_amount+'</td>'+
                '<td>'+credit+'</td>'+
                '<td>'+remaining+'</td>'+
                '</tr>'
                return content
            }

            var ratio;
            var rate;
            var quantity;


    $(document).on('change','.change', function(){
        var grand_total =0; 
        $('.stock-item').each(function(){
            var rate=$(this).find('.rate').val()
            var quantity=$(this).find('.quantity').val()
            var unit=$(this).find('#units option:selected').data("id")
            if(unit != null){
                rate = rate/unit;
            }
            var this_total=(+rate) * (+quantity)
            grand_total+=this_total
            $(this).find('.total').val(this_total)
            $("#total_due").val(grand_total)
        })
        $("#grand_total").text(grand_total.toFixed(2))
    })


$("#cash").on('change', function(){
        if(this.checked){
        $("#cashPay").prepend('<label class="cashMode">Amount Paid</label>'+
        '<input type="number" value="" class="form-control" id="cash_paid" name="cash_amount" required></label>'
        +'<span class="cashError"></span>'
        +'<br><span class="info" id="calc_cash"></span>')
        checkCash();
        p();
        }else{
            $("#cashPay").empty()
        }
    })

$("#credit").on('change', function(){
        if(this.checked){
        $("#creditPay").prepend('<label class="creditMode">Credit Amount</label>'+
        '<span class="info" id="calc"></span>'+
        '<input type="number" value="" class="form-control" id="credit_paid" name="credit_amount" required></label>'
        +'<span class="creditError"></span>'
        +'<br><span class="info" id="calc_credit"></span>')
        checkCredit();
        }else{
            $("#creditPay").empty()
        }
    })



function checkCash(){

    $("#cash_paid").on('change', function(){
        var total = $("#grand_total").text()
        var credit = parseInt($("#credit_paid").val())
        var rem=0;
        var paid_cash = $(this).val()
        var sum=0;

       if (isNaN(credit)){
        sum = parseInt(paid_cash)

        if(total != sum){
            $(".cashError").text("Cash Amount Is Not Equal to Total Amount.")
            rem = (total - sum).toFixed(2)
            if(isNaN(rem)){ rem = 0; }
            $("#calc_cash").text('Remaining: '+rem)
        }
    }else{
        sum = parseInt(paid_cash) + parseInt(credit)
        if(total != sum){
            $(".cashError").text(" Sum of Cash & Credit Is Not Equal to Toatal Amount.")
        }
    }

    if(total == sum){
        $("#total_due").val(total)
        $(".cashError").empty()
        $(".creditError").empty()
        $("#calc_credit").empty()
        $("#calc_cash").empty()
    }
    })
}

function checkCredit(){


    $("#credit_paid").on('change', function(){
        var total =parseInt($("#grand_total").text())
        var cash = parseInt($("#cash_paid").val())
        var credit = $(this).val()
        var sum=0;
        if (isNaN(cash)){
            sum = parseInt(credit)
            rem = (total - sum).toFixed(2)
            if(isNaN(rem)){ rem = 0; }
            $("#calc_credit").text('Remaining: '+rem)

            if(total != sum){
                $(".creditError").text("Credit Amount Is Not Equal to Total Amount.")
            }
        }else{
            sum = parseInt(cash) + parseInt(credit)
            rem = total - sum
            if(isNaN(rem)){ rem = 0; }
            $("#calc_credit").text('Remaining: '+rem)
            if(total != sum){
                $(".creditError").text(" Sum of Cash & Credit Is Not Equal to Toatal Amount.")
            }
        }

        if(total == sum){
            $("#total_due").val(total)
            $(".cashError").empty()
            $(".creditError").empty()
            $("#calc_credit").empty()
            $("#calc_cash").empty()
        }
    })
}







</script>

        @endsection

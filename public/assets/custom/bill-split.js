$(document).on('click', '.btn-show-customer', function (e) {
    e.preventDefault();
    $(this).parents('.customer-content').find('.cash-customer-details').hide();
    $(this).parents('.customer-content').find('.customer-details').show();
})

$(document).on('click', '.btn-show-cash-customer', function (e) {
    e.preventDefault();
    var $parent = $(this).parents('.customer-content').find('.customer-details');
    $parent.find('input.form-control').val('');
    $parent.hide();
    $(this).parents('.customer-content').find('.cash-customer-details').show();
})

$(document).on('mouseover', '.bill-split-item', function (e) {
    e.preventDefault();
    $(this).find('.kt-badge').removeClass('kt-badge--success').addClass('kt-badge--brand'); 
})

$(document).on('mouseleave', '.bill-split-item', function (e) {
    e.preventDefault();
    $(this).find('.kt-badge').addClass('kt-badge--success').removeClass('kt-badge--brand'); 
})

$(document).on('change', '.bill-switch', function (e) {
    e.preventDefault();
    if ($(this).is(':checked')) {
        $('.bill-switch').not(this).prop('checked', false);
    }
    else {
        alert('Please select other switches to inactive this switch');
        $(this).prop('checked', true);
    }
})
$(document).on('click','#btn-add-bill',function(){
    var random_id=createClassName()
    var is_service_charge=$('#is_service_charge').val();
    var content='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-15 bill" data-uuid="'+random_id+'"> <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile bill-splited" style="min-height: 81.5vh;"> <div class="kt-portlet__head kt-portlet__head--lg"> <div class="kt-portlet__head-label"> <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success"> <label> <input type="checkbox" name="" class="bill-switch"> <span></span> </label> </span> </div> <div class="kt-portlet__head-toolbar"> <button type="button" class="btn btn-outline-dark" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="Add Table to the workplace" data-original-title="" title=""> <i class="la la-print"></i> Print </button> </div> </div> <div class="kt-portlet__body"> <div class="customer-content"> <div class="row cash-customer-details"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="input-group"> <input type="text" class="form-control" readonly value="Cash Customer"> <div class="input-group-append"> <button class="btn btn-warning btn-icon btn-show-customer" type="button"> <i class="la la-edit"></i> </button> </div> </div> </div> </div> <div class="row customer-details" style="display: none;"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="form-group row mb-0 hide-in-mobile"> <div class="col-lg-6"> <input type="text" class="form-control" name="c_name" placeholder="Enter Customer Name"> </div> <div class="col-lg-6"> <div class="input-group pr-0"> <input type="number" class="form-control"  name="c_phone" placeholder="Enter Phone Number"> <div class="input-group-append"> <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button"> <i class="la la-trash"></i> </button> </div> </div> </div> </div> <div class="form-group row mb-0 show-in-mobile"> <div class="col-lg-6"> <div class="input-group pr-0"> <input type="text" class="form-control"  name="c_name" placeholder="Enter Customer Name"> <div class="input-group-append"> <button class="btn btn-danger btn-icon btn-show-cash-customer" type="button"> <i class="la la-trash"></i> </button> </div> </div> </div> <div class="col-lg-6"> <input type="number" class="form-control"  name="c_phone"  placeholder="Enter Phone Number"> </div> </div> <div class="form-group row mb-0"> <div class="col-lg-6"> <input type="text" class="form-control"  name="c_pan" placeholder="Enter Customer PAN"> </div> <div class="col-lg-6"> <input type="number" class="form-control"  name="pax" placeholder="Enter PAX"> </div> </div> </div> </div> <div class="row mt-15"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="bill-split-menu-list"> <table class="table"> <thead class="thead-light"> <tr> <th>Name</th> <th>Price</th> <th>Quantity</th> <th>Total</th> <th></th> </tr> </thead> <tbody class="bill-split-display-list"> </tbody> </table> </div> </div> </div> <div class="row mt-15"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <table class="table bill-split-payments"> <tbody> <tr> <th>Total</th> <td> <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">NPR</span></span> <input type="number" class="form-control total_amount" readonly> </div> </td> </tr> <tr> <th>Discount Percent</th> <td> <div class="input-group"> <input type="number" class="form-control discount_percent change-effect"> <span class="input-group-append"><span class="input-group-text">%</span></span> </div> </td> </tr> <tr> <th>Discount Amount</th> <td> <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">NPR</span></span> <input type="number" class="form-control discount_amount" readonly> </div> </td> </tr>'
        if(is_service_charge) {
            var service_charge_rate=$('#service_charge_rate').val();

            content+='<tr> <th>Service Charge</th> <td> <div class="input-group"> <input type="number" class="form-control service_charge_amount"> <input type="hidden" class="form-control service_charge_percent" value="'+service_charge_rate+'"> <span class="input-group-append"><span class="input-group-text">'+service_charge_rate+'%</span></span> </div> </td> </tr>'
        }   
        content+='<tr> <th>Grand Total</th> <td> <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">NPR</span></span> <input type="number" class="form-control grand_total" readonly> </div> </td> </tr> <tr> <th>Received Amount</th> <td> <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">NPR</span></span> <input type="number" class="form-control received_amount change-effect"> </div> </td> </tr> <tr> <th>Tip Amount</th> <td> <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">NPR</span></span> <input type="number" class="form-control tip_amount change-effect"> </div> </td> </tr> <tr> <th>Change Amount</th> <td> <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">NPR</span></span> <input type="number" class="form-control change_amount" readonly> </div> </td> </tr> </tbody> </table> </div> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <p>Payment Type</p> <div class="form-group form-group-last"> <div class="row"> <div class="col-lg-6"> <label class="kt-option"> <span class="kt-option__control"> <span class="kt-radio kt-radio--check-bold kt-radio--dark"> <input type="radio" name="payment_type['+random_id+']" value="cash" checked> <span></span> </span> </span> <span class="kt-option__label"> <span class="kt-option__head"> <span class="kt-option__title">CASH</span> </span> </span> </label> </div> <div class="col-lg-6"> <label class="kt-option"> <span class="kt-option__control"> <span class="kt-radio kt-radio--check-bold kt-radio--dark"> <input type="radio" name="payment_type['+random_id+']" value="bank"> <span></span> </span> </span> <span class="kt-option__label"> <span class="kt-option__head"> <span class="kt-option__title">BANK / CARD</span> </span> </span> </label> </div> </div> </div> </div> </div> </div> </div> </div> </div>'
    $('.bill-list').append(content)
})
$(document).on('click', '.bill-split-item', function (e) {
    e.preventDefault();
    var item= "item-"+$(this).data('slug');
    var max_quantity=$(this).data('quantity')
    var quantity=0;
    $( '.item.'+item ).each(function( index ) {
        var this_val=$(this).val()
        quantity= +quantity+ +this_val;
    });
    quantity=quantity/2

    if(quantity>=max_quantity){
        Swal.fire({
            title: 'Attention',
            text: 'Max limite reached',
            type: 'info',
            showConfirmButton: true,
        })
    }else{
        
        var $this=$('.bill-switch:checked').parents('.bill-splited').find('.bill-split-display-list').find('.'+item)
        var quantity=+quantity+1;
        if($this.length){
            var price=$(this).data('price')
            var old_val=$this.val()
            var new_val= +old_val+1
            $this.val(new_val)
        }else{
            var class_name = createClassName()
            var content = '<tr class="items-list" data-price="'+$(this).data('price')+'" data-slug="'+$(this).data('slug')+'">'+
                '<th>'+$(this).data('name')+'</th>'+
                '<td>'+$(this).data('price')+'</td>'+
                '<td>'+
                '<input type="number" class="item '+class_name+' '+item+' input-spinner form-control-sm" value="1" min=1 >'+
                '</td>'+
                '<td class="price">'+$(this).data('price')+'</td><td><button type="button" class="btn btn-sm btn-outline-danger btn-icon btn-remove-item"><i class="la la-times"></i></button></td>'+
                '</tr>';        
            $('.bill-switch:checked').parents('.bill-splited').find('.bill-split-display-list').prepend(content);
            // inputInit()
            $('.'+class_name).inputSpinner()
            $('.input-spinner').attr('readonly',true)
        }
        var remaining= max_quantity-quantity
        $(this).find('.remaining-qty').text(remaining)
        updatePrice()
    }
    
})
$(document).on('click','.btn-remove-item',function(e){
    e.preventDefault();
    var slug=$(this).parents('tr').data('slug')
    var class_name='bill-split-item-'+slug

    var item= "item-"+slug;
    var current_value=$(this).parents('tr').find('.item').val()
    var quantity=0;
    $( '.item.'+item ).each(function( index ) {
        var this_val=$(this).val()
        quantity= +quantity+ +this_val;
    });
    quantity=quantity/2
    console.log('MAx qty='+max_quantity)
    console.log('qty selected='+quantity)
    console.log('current_value='+current_value)
    var max_quantity=$('.'+class_name).data('quantity')
    $('.'+class_name).find('.remaining-qty').text(+max_quantity- +quantity+ +current_value)
    $(this).parents('tr').remove()
    updatePrice()
})
$(document).on("change",'.input-spinner',function (e) {
    $that=$(this)
    e.preventDefault()

    var value = $('.input-spinner').val()
    var slug=$(this).parents('tr').data('slug')
    var class_name='bill-split-item-'+slug
    var item= "item-"+slug;
    var max_qty=$('.'+class_name).data('quantity')
    var quantity=0;
    $( '.item.'+item ).each(function( index ) {
        var this_val=$(this).val()
        quantity= +quantity+ +this_val;
    });
    quantity=quantity/2
    var current_value=0;
    if(quantity>max_qty){
         current_value = $that.val()
        current_value =  current_value-1 
        $that.val(current_value)
        Swal.fire({
            title: 'Attention',
            text: 'Max limite reached',
            type: 'info',
            showConfirmButton: true,
        })
    }else{
        current_value = $that.val()
        $that.val(current_value)
    }

    //Final quantity
    final_quantity=0
    $( '.item.'+item ).each(function( index ) {
        var this_val=$(this).val()
        final_quantity= +final_quantity+ +this_val;
    });
    final_quantity=final_quantity/2
    //Final quantity
    updatePrice()
    $('.'+class_name).find('.remaining-qty').text(+max_qty- +final_quantity)
    
})

$(document).on('click','#print-and-close',function(e){
    var items = new Object();
    $('.bill-split-item').each(function(){
        var item= new Object();
        item['qty']=$(this).data('quantity')
        item['slug']=$(this).data('slug')
        item['used_qty']=0
        items[$(this).data('slug')]=item
       
    })
    //Used qty
    $('.item').each(function(){
        var this_val=$(this).val()
        items[$(this).parents('tr').data('slug')]['used_qty']+= +this_val/2
    })
    //Used qty
    //Check all quantity used
    var status=true
    $.each( items, function( key, value ) {
        if(value['qty']!=value['used_qty']){
            status=false;
            return false;
        }
      });
    
    //Check all quantity used
    if(status){
        var bill_status=true
        var bills= new Object();
        $('.bill').each(function(key, value){
            var bills_items= new Object();
            var data= new Object();
            var uuid=$(this).data('uuid')
            data['discount_percent']=$(this).find('.discount_percent').val()?$(this).find('.discount_percent').val():0;
            data['received_amount']=$(this).find('.received_amount').val()?$(this).find('.received_amount').val():0;
            data['tip_amount']=$(this).find('.tip_amount').val()?$(this).find('.tip_amount').val():0;
            data['payment_type']=$(this).find('input[name="payment_type['+uuid+']"]:checked').val();
          
            //Customer Details
            data['customer_name']=$(this).find('.hide-in-mobile').find('input[name="c_name"]').val();
            data['customer_phone']=$(this).find('.hide-in-mobile').find('input[name="c_phone"]').val();
            data['customer_pan']=$(this).find('input[name="c_pan"]').val();
            data['pax']=$(this).find('input[name="pax"]').val();
            
            //Customer Details
            if($(this).find('.item').length<=0){
                bill_status=false;
                return false
            }else{
                $(this).find('.item').each(function(){             
                    bills_items[$(this).parents('tr').data('slug')]=$(this).val()
                })
                data['items']=bills_items
                bills[key]=data
            }
        })
        if(!bill_status){
            alert('Bill empty')
            return false;
        }else{
            $.ajax({
                method: "POST",
                url: '/order/pay-split-bill',
                data: { 
                    table: $('#table_id').val(),
                    bills: bills

                 }
            })
            .done(function( data ) {
                var res=JSON.parse(data)
                if(res.print_bill){
                    alert('Print Bill and Close')
                }else{
                    alert(' Close')

                }
                printSplitBill(res.bills)
                window.location.replace(res.redirect_url);

            })
            

        }

    }else{
        alert('not success')

    }

})
$(document).on('change','.change-effect',function(){
    updatePrice()
})
function printSplitBill(bills){
    $('#main-content').hide();
    $.each(bills, function( index, bill ) {
        $('#print-content').append(bill);
    });
    window.print();
    $('#print-content').html('');
    $('#main-content').show();

}
function inputInit(){
    $(".input-spinner").inputSpinner()
}

function createClassName(length=32) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
function updatePrice(){
    var is_service_charge=$('#is_service_charge').val();

    $('.bill').each(function(){
        var this_total=0;
        var discount_percent=$(this).find('.discount_percent').val();
       
        $(this).find('.items-list').each(function(){
            var price=$(this).data('price');
            var quantity=$(this).find('.item').val();
            var total=+price*+quantity;
            this_total+= +total
            $(this).find('.price').text(total)
            
        })
        //Discount
            var discount_amount=(+discount_percent/100)* +this_total;
            grand_total= +this_total- +discount_amount
            $(this).find('.discount_amount').val(discount_amount)

        //Discount
        //Service Charge
        if(is_service_charge){
            var service_charge_rate=$('#service_charge_rate').val();

            var service_charge_amount=(+service_charge_rate/100)* +grand_total;
            grand_total= +grand_total+ +service_charge_amount
            $(this).find('.service_charge_amount').val(service_charge_amount)

        }
        //Service Charge
        
        var total_before_round=grand_total

        var grand_total=Math.round(total_before_round)
        var round=parseFloat(grand_total-total_before_round).toFixed(2)
        //Received
            var received_amount=$(this).find('.received_amount').val()?$(this).find('.received_amount').val():0
            if(received_amount==0){

            }else{
                var tip_amount=$(this).find('.tip_amount').val()
                var change_amount= +received_amount- +tip_amount - +grand_total
                $(this).find('.change_amount').val(change_amount)
            }
            
        //Received
        $(this).find('.total_amount').val(this_total)
        $(this).find('.grand_total').val(grand_total)
        $(this).find('.round').val(round)
        
            
    })
}

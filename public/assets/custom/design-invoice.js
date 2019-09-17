//customer name select or not
$(document).on("click", "#customer-name-input-group", function(e){
    e.preventDefault();
    var showNumber = $("#show-customer-name").val();
    if(showNumber == 1) {
        $(this).css({"background-color": "#ef4b4b"});
        $(this).html('<i class="fas fa-times-circle"></i>');
        $("#show-customer-name").val(0);
        $("#bill-customer-name-html").css({"display": "none"});
    } else {
        $(this).css({"background-color": "green"});
        $(this).html('<i class="fas fa-check-circle"></i>');
        $("#show-customer-name").val(1);        
        $("#bill-customer-name-html").css({"display": ""});
    }
})

//customer address select or not
$(document).on("click", "#customer-address-input-group", function(e){
    e.preventDefault();
    var showNumber = $("#show-customer-address").val();
    if(showNumber == 1) {
        $(this).css({"background-color": "#ef4b4b"});
        $(this).html('<i class="fas fa-times-circle"></i>');
        $("#show-customer-address").val(0);
        $("#bill-customer-address-html").css({"display": "none"});
    } else {
        $(this).css({"background-color": "green"});
        $(this).html('<i class="fas fa-check-circle"></i>');
        $("#show-customer-address").val(1);
        $("#bill-customer-address-html").css({"display": ""});
    }
})

//customer pan select or not
$(document).on("click", "#customer-pan-input-group", function(e){
    e.preventDefault();
    var showNumber = $("#show-customer-pan").val();
    if(showNumber == 1) {
        $(this).css({"background-color": "#ef4b4b"});
        $(this).html('<i class="fas fa-times-circle"></i>');
        $("#show-customer-pan").val(0);
        $("#bill-customer-pan-html").css({"display": "none"});
    } else {
        $(this).css({"background-color": "green"});
        $(this).html('<i class="fas fa-check-circle"></i>');
        $("#show-customer-pan").val(1);
        $("#bill-customer-pan-html").css({"display": ""});
    }
})

//bill amount select or not
$(document).on("click", "#bill-amount-input-group", function(e){
    e.preventDefault();
    var showNumber = $("#show-bill-amount").val();
    if(showNumber == 1) {
        $(this).css({"background-color": "#ef4b4b"});
        $(this).html('<i class="fas fa-times-circle"></i>');
        $("#show-bill-amount").val(0);
        $("#bill-amount-in-words-html").css({"display": "none"});
    } else {
        $(this).css({"background-color": "green"});
        $(this).html('<i class="fas fa-check-circle"></i>');
        $("#show-bill-amount").val(1);
        $("#bill-amount-in-words-html").css({"display": ""});
    }
})

//bill greeting note select or not
$(document).on("click", "#greeting-note-input-group", function(e){
    e.preventDefault();
    var showNumber = $("#show-greeting-note").val();
    if(showNumber == 1) {
        $(this).css({"background-color": "#ef4b4b"});
        $(this).html('<i class="fas fa-times-circle"></i>');
        $("#show-greeting-note").val(0);
        $("#bill-greeting-note-html").css({"display": "none"});
    } else {
        $(this).css({"background-color": "green"});
        $(this).html('<i class="fas fa-check-circle"></i>');
        $("#show-greeting-note").val(1);
        $("#bill-greeting-note-html").css({"display": ""});
    }
})

//sales by select or not
$(document).on("click", "#sales-by-input-group", function(e){
    e.preventDefault();
    var showNumber = $("#show-sales-by").val();
    if(showNumber == 1) {
        $(this).css({"background-color": "#ef4b4b"});
        $(this).html('<i class="fas fa-times-circle"></i>');
        $("#show-sales-by").val(0);
        $("#bill-operator-name-html").css({"display": "none"});
    } else {
        $(this).css({"background-color": "green"});
        $(this).html('<i class="fas fa-check-circle"></i>');
        $("#show-sales-by").val(1);
        $("#bill-operator-name-html").css({"display": ""});
    }
});

$(document).on('click', '.save-design-invoice-setting', function(e){
    e.preventDefault();
    var isCustomerName = $("#show-customer-name").val();
    var isCustomerPan = $("#show-customer-pan").val();
    var isCustomerAddress = $("#show-customer-address").val();
    var isBillAmount = $("#show-bill-amount").val();
    var isBillGreetingNote = $("#show-greeting-note").val();
    var isOperatorName = $("#show-sales-by").val();
console.log(isOperatorName)
console.log(isBillGreetingNote)
console.log(isBillAmount)
    $.ajax({
        url: base_url+'/design-invoice/update',
        data: {
                isCustomerName: isCustomerName, 
                isCustomerPan: isCustomerPan,
                isCustomerAddress: isCustomerAddress,
                isBillAmount: isBillAmount,
                isBillGreetingNote: isBillGreetingNote,
                isOperatorName: isOperatorName
            },
        type: 'POST',
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if(response.status != 'failed'){
                Swal.fire(
                    'Updated!',
                    response.successMsg,
                    response.status
                    )
            } else {
                'Sorry!',
                response.successMsg,
                response.status
            }
        }
    })
})
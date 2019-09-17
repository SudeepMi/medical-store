$('#instafilta-filter').instaFilta({
    targets: '.isotope-item'
})

$(document).on('click', '.btn-isotope', function (e) {
    e.preventDefault();
    $('.clear-search').trigger('click');
    var filter = $(this).data('filter');
    if (filter == '*') {
        $('.isotope-item').show();
    }
    else if (filter != '') {
        $('.isotope-item').hide();
        $('.isotope-item'+filter).show();
    }
})

$(document).on('click', '.clear-search', function (e) {
    e.preventDefault();
    $(this).parents('.input-group').find('input[name=search]').val('');
    $('.isotope-item').show();
})

$(document).on('click', '.order-tabs .nav-link', function (e) {
    e.preventDefault();
    $('.order-tabs').find('.nav-link').removeClass('btn btn-brand kt-font-light');
    $(this).addClass('btn btn-brand kt-font-light');
})

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

$(document).on('click', '.bootstrap-touchspin-up', function (e) {
    e.preventDefault();
    var $input = $(this).parents('.bootstrap-touchspin').find('input[type=number]');
    var qty = parseInt($input.val());
    $input.val(++qty);
})

$(document).on('click', '.bootstrap-touchspin-down', function (e) {
    e.preventDefault();
    var $input = $(this).parents('.bootstrap-touchspin').find('input[type=number]');
    var qty = parseInt($input.val());
    $input.val(--qty);
})
$(document).on('click', '.btn-kot-item', function (e) {
    e.preventDefault();
    var curr_qty = $(this).data('qty');
    var qty = prompt('Enter the number of quantity to cancel?', curr_qty); 
    if (qty != null) {
        if (qty > 0) {
            alert('Use Sweet Alert 2 for this feature.');
            $(this).parents('.kot-item-parent').remove();
        }
        else {
            alert('Use Sweet Alert 2 for this feature. Please enter a valid number');
        }
    }
})
$(document).on('click', '.btn-kot', function (e) {
    e.preventDefault();
    if (confirm('Are You Sure?')) {
        alert('Use Sweet Alert 2 for this feature.');
        $(this).parents('.kot-parent').remove();
    }
})
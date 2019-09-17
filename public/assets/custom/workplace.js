$(document).on('click', '.clear-search', function (e) {
    e.preventDefault();
    $(this).parents('.input-group').find('input[name=search]').val('')
})

$(document).on('click', '.btn-tabs', function (e) {
    e.preventDefault();
    var $this  = $(this);
    var target = $this.data('target');
    var title  = $this.data('title');
    $('.custom-tab-content').find('.custom-tab-pane').removeClass('is-active');
    $(target).addClass('is-active');
    $this.parents('.btn-group').find('button.dropdown-toggle').html(title);
})


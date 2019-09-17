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

var iii = 100;
$(document).on('click', '.btn-add-table', function (e) {
    e.preventDefault(); iii++;
    var content = '<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">'+
                        '<div class="kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid">'+
                            '<div class="kt-portlet__body">'+
                                '<div class="kt-portlet__content">'+
                                    '<h3>Table : G'+iii+'</h3>'+
                                    '<p>Occupied at 2019-12-12 -- 12:12</p>'+
                                    '<p>Next Booking for 2019-12-12 -- 12:12</p>'+
                                    '<p>PAX: 6</p>'+
                                '</div>'+
                           ' </div> '+ 
                            '<div class="kt-portlet__foot kt-portlet__foot--sm kt-align-left">'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Occupy"><i class="flaticon-layer"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Book"><i class="flaticon-layers"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Merge"><i class="la la-compress"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Unmerge"><i class="la la-expand"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Manage Booking"><i class="la la-book"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Move"><i class="la la-arrows-h"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="View"><i class="la la-eye"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Close"><i class="la la-times"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Edit"><i class="la la-edit"></i></a>'+
                                '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Delete"><i class="la la-trash"></i></a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
    $('.custom-tab-pane.is-active').find('.sortable').append(content);
})

var ist = 0;
$('.row.sortable').each(function (i, val) { ist++;
    new Sortable(document.getElementById('sortable-table-' + ist), {
        animation: 150,
        ghostClass: 'blue-background-class'
    });
})
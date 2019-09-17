var $grid = $('.isotope-element-container').isotope({
  itemSelector: '.isotope-item',
  layoutMode: 'fitRows'
});

$('.filters-btn-group').on( 'click', '.btn-isotope-filter', function() {
  var filterValue = $( this ).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});

$('.filters-btn-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', '.btn-isotope-filter', function() {
    $buttonGroup.find('.is-active').removeClass('is-active');
    $( this ).addClass('is-active');
  });
});
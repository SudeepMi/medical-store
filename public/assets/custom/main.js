$(document).on('click', '#show-occupied-tables', function (e) {
    e.preventDefault();
    $.ajax({
        method: "GET",
        url: '/table/get-occupied-table'
    })
    .done(function( res ) {
        var tables= getTableList(res.data)
        $('#occupied-table-list').html(tables)
        $('#list-occupied-tables').css('right', 0);
        

    })
})
function getTableList(tables){
    var content=''
    $.each(tables, function( index, value ) {
        content+='<a href="'+value.occupy_url+'" class="btn btn-elevate btn-bold btn-lg btn-success btn-block">'
        content+=value.name+' <small>(PAX: '+value.pax+') ('+value.occupied_time+')</small></a>'
    });
    return content
    
}
$(document).on('click', '#show-booked-tables', function (e) {
    e.preventDefault();
    $.ajax({
        method: "GET",
        url: '/table/get-today-booked-table'
    })
    .done(function( res ) {
        if(res.status == "success"){ 
            var tables= getTodayBookedTableList(res.todayBookings)
            // console.log(tables)
            $('#todays-table-bookings').html(tables)
            $('#list-booked-tables').css('right', 0);
        }
    })
})
function getTodayBookedTableList(tables){
    var content=''
    var x = 0;
    $.each(tables, function( index, value ) {
        if(value.today_booked_table != null){
            $.each(value.today_booked_table, function( index, val ) { console.log(val)
                content+='<a href="#" class="btn btn-elevate btn-bold btn-lg btn-info btn-block">';
                content+=value.name+' <small>(PAX: '+val["pax"]+') ('+val.booking_date +' ['+val.start_time+' - '+val.end_time+']'+')</small></a>';
            })
        } else {
            if(x == 0) {
                content+='<a href="#" class="btn btn-elevate btn-bold btn-lg btn-warning btn-block">No Booking for Today </a>';
            x++;
            }
        }
        });
    return content;
    
}
$(document).on('click', '.kt_panel_close', function (e) {
    e.preventDefault();
    $('.kt-demo-panel').css('right', '-370px');
    $('#occupied-table-list').html('')
    $('#booked-table-list').html('')

})
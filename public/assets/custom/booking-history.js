$(function(){

    $(document).on("click", ".edit-booking-detail", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "post",
            url: base_url+"/table/booking-detail-edit",
            data: {id: id},
            async: false,
            dataType: 'json',
            success: function(response) {
                if(response.status != "failed") {
                    $(".booking-detail-content").html(response.view);
                    $("#table-book-modal-edit").modal("show");
                }
            }
        })
    })


    $("#table-booking-form-edit").validate({
        ignore: " ",
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            phone: {
                required: true,
                minlength: 8
            },
            address: {
                required: true
            },
            pax: {
                required: true,
                minlength: 1
            },
            booking_date: {
                required: true
            },
            from: {
                required: true,
                remote:{
                            data: { 
                                        booking_date: $('#booking-table-date').val(), 
                                        table_id: $('#booking-table-id').val(),
                                        floor_id: $('#booking-table-floor-id').val()},
                            url: base_url+"/workplace/table-booking-check-start",
                            type:"post"
                        }
            },
            to: {
                required: true,
                remote:{
                    data: { 
                                booking_date: $('#booking-table-date').val(), 
                                table_id: 4, //$('#booking-table-id').val(),
                                floor_id: 1},//$('#booking-table-floor-id').val()},
                    url: base_url+"/workplace/table-booking-check-end",
                    type:"post"
                }
            }
        },

        messages: {
            from: {
                remote: "This start time is already booked. Please change time."
            },
            
            to: {
                remote: "This end time is already booked. Please change time."
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: base_url+'/workplace/table-booking-update',
                data: $("#table-booking-form-edit").serialize(),
                type: 'post',
                beforeSend: function() {
                    // setting a timeout
                    Swal.fire({
                        title: 'Please Wail...',
                        animation: false,
                        customClass: {
                            popup: 'animated tada'
                        },
                        showConfirmButton: false
                      })
                },
                success: function(response) {
                    if(response.status != "failed") { 
                        location.reload();
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Booking Saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else { console.log('issue');
                        Swal.fire(
                            'Sorry!',
                            response.errorMsg,
                            response.status
                        )
                    }
                }
            })
            return false; // required to block normal submit since you used ajax
        }
    });

    $(document).on("click", ".status-change-booking", function(e){
        e.preventDefault();

        var $this = $(this);
        var id = $this.parents('tr').data('id');
        console.log($this.parents('tr').find('.status-control').attr('id'));
        if($this.parents('tr').find('.status-control').attr('id') == 1) {
            msgText     = 'Do you want to Cancel this Booking?';
            successMsg  = 'This Booking is Calcelled now.';
            errorMsg    = 'Sorry, Could not Cancelled this Booking at this time. Please try again.';
            content     = '<span class="btn btn-sm btn-danger">Cancelled</span>';
            new_val     = 0;

        } else {
            msgText     = 'Do you want to Re-Book this Booking?';
            successMsg  = 'This Setting is Re-Book now.';
            errorMsg    = 'Sorry, Could not Re-Book this Setting at this time. Please try again.';

            content     = '<span class="btn btn-sm btn-success">Booked</span>';
            new_val     = 1;

        }

        Swal.fire({
        title: 'Are you sure?',
        text: msgText,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'

        }).then( function(result) {
        if(result.value){

            $.ajax({
                url: base_url+'/table/change-booking-status',
                data: {id: id},
                type: 'POST',
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {
                    if(response.status != 'failed'){
                        $this.parents('tr').find('.status-control').html(content);

                        $this.parents('tr').find('.status-control').attr('id', new_val);

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
            });
        }
        })

    })
})
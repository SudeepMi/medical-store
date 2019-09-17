
$(function(){
    var tbl = 0;
    var flr = 0;
    $(document).on("click", ".btn-table-merge", function(e){
        e.preventDefault();
        var uuid = $(this).data("uuid");
        var floor_slug = $(this).data("floor");
        $("#base-table-uuid").val(uuid);
        var content = '<div class="form-group">'+
                            '<label>Selete Table :</label>'+
                            '<select class="form-control modal-selectpicker" name="merged_to[]" data-live-search="true"title="Choose Table to Merge" multiple required>';
                $.each(floors, function(index, floor){  
                    if(floor.slug == floor_slug){ 
                        $.each(floor.active_tables, function(index, value){  
                            if(value.uuid != uuid) {
            content +=          '<option value="'+value.uuid+'">'+value.name+'</option>';
                            }
                        });
                    }
                })                
                            
            content +=        '</select>'+
                        '</div>';
            console.log(content)
            $("#modal-merging-tables").html(content);
            $('.modal-selectpicker').selectpicker();
            
        $("#table-merge-modal").modal("show");
        $("#table-merge-modal").css({"display": "block"});
    })

    // unmerge table
    $(document).on("click", ".btn-table-unmerge", function(e){
        e.preventDefault();

        var uuid = $(this).data('uuid'); 
        var base = $(this).data('base');
        msgText     = 'Do you want to Unmerge this Table from '+base+'?';
        successMsg  = 'This Table is Unmerged now.';
        errorMsg    = 'Sorry, Could not Unmerge this Table at this time. Please try again.'; 

        Swal.fire({
            title: 'Are you sure?',
            text: msgText,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, unmerge it!'

        }).then( function(result) {
            if(result.value){

                $.ajax({
                    method: "POST",
                        data: {uuid: uuid},
                        url: base_url+'/workplace/table-unmerge',
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
                            location.reload();
                        } else {
                            Swal.fire(
                                'Sorry!',
                                response.errorMsg,
                                response.status
                            )
                        }
                    }
                });
            }
        })

    });

    $(document).on("click", ".btn-table-book", function(e){
        e.preventDefault();
        var table_id = $(this).data("id");
        var table = $(this).data("table");
        var floor_id = $(this).data("floor");
      
        $("#table-book-modal").modal("show");
        $("#booking-table-id").val(table_id);
        $("#booking-table-name").val(table);
        $("#booking-table-floor-id").val(floor_id)
        var d = new Date(), h = d.getHours(), m = d.getMinutes();
     
        if(h < 10) h = '0' + h; 
        if(m < 10) m = '0' + m;
        $("#booking-time-start").attr({'value' : h + ':' + m});
        // $("#booking-time-start").attr({'min' : h + ':' + m});
        var h1 = parseInt(h)+1;
        if(h1 < 10) h1 = '0' + h1;
        $("#booking-time-to").attr({'value' : h1 + ':' + m});  
        // $("#booking-time-to").attr({'min' : (h+1) + ':' + m});
    })

    //Booking save with JQuery Validation
    $("#table-booking-form").validate({
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
                                table_id: $('#booking-table-id').val(),
                                floor_id: $('#booking-table-floor-id').val()},
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
                url: base_url+'/workplace/table-booking',
                data: $("#table-booking-form").serialize(),
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
                    if(response.status != "failed") { console.log("success")
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

    // $(document).on('click', '.save-booking-detail', function(e) {
    //     e.preventDefault();
    //     var $this = $(this);
    //     $.ajax({
    //         url: base_url+'/workplace/table-booking',
    //         data: $("#table-booking-form").serialize(),
    //         type: 'post',
    //         beforeSend: function() {
    //             // setting a timeout
    //             Swal.fire({
    //                 title: 'Please Wail...',
    //                 animation: false,
    //                 customClass: {
    //                     popup: 'animated tada'
    //                 },
    //                 showConfirmButton: false
    //               })
    //         },
    //         success: function(response) {
    //             if(response.status != "failed") { console.log("success")
    //                 location.reload();
    //                 Swal.fire({
    //                     position: 'top-end',
    //                     type: 'success',
    //                     title: 'Booking Saved',
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 })
    //             } else { console.log('issue');
    //                 Swal.fire(
    //                     'Sorry!',
    //                     response.errorMsg,
    //                     response.status
    //                 )
    //             }
    //         }
    //     })
    // })

})
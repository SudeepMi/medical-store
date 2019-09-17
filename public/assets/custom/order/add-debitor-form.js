$("#add-debitor-form").validate({
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
        email: {
            required: true,
            email:true,
            remote:base_url+"/debtor/check-email",
        }
    },

    messages: {
        email: {
            remote: "Email already exist."
        },
    },
    submitHandler: function (form) {
        $.ajax({
            url: base_url+'/debtor/add-debtor',
            data: $("#add-debitor-form").serialize(),
            type: 'post',
            beforeSend: function() {
                // setting a timeout
                showLoader()
            },
            success: function(response) {
                if(response.status != "failed") { 
                    var res=JSON.parse(response)
                    var options=''
                    $.each(res.debitors, function( index, debitor ) {
                        if(debitor.slug==res.selected){
                            options+='<option value="'+debitor.slug+'" selected>'+debitor.name+'</option>'
                        }else{
                            options+='<option value="'+debitor.slug+'" >'+debitor.name+'</option>'
                        }
                    });
                    $('#debitor-select').html(options)
                    $('#debitor-select').selectpicker('refresh')
                    $('.add-debitor-modal').modal('hide') 

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Debtor Added',
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
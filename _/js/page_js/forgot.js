    var baseURI = $('base').attr('href');
    function sleep(ms) {
      return new Promise(resolve => setTimeout(resolve, ms));
    }
    $("#formForgot").on('submit', function(e) {
        e.preventDefault();
        
        var formAction = $("#formForgot").attr('action');
        var dataEmail = {
            submit: $("#submitEmail").attr('name'),
            user_email: $("#user_email").val(),
            debu_token: $('.csrf_token').attr('value')
        };

        Swal.fire({
            title: 'Please Wait!',
            text: 'Creating Reset Link...',
            type: 'info',
            showConfirmButton: false
        });

        sleep(2000).then(() => {
            
            $.ajax({
                type: "POST",
                url: formAction,
                data: dataEmail,
                dataType: 'json',
                success: function(data) {
                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                    
                    if (data.result == 1) {
                        Swal.fire('Success!', data.msg, 'success');
                        setTimeout(function () { window.location.href = baseURI + '/login';}, 2000);
                    } else {
                        Swal.fire('Failed!', data.msg, 'error');
                    }
                }
            });
        });
        return false;
    });
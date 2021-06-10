    var baseURI = $('base').attr('href');

    $("#formForgot").on('submit', function(e) {
        e.preventDefault();
        
        var formAction = $("#formForgot").attr('action');
        var dataEmail = {
            submit: $("#submitEmail").attr('name'),
            user_email: $("#user_email").val(),
            debu_token: $('.csrf_token').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataEmail,
            dataType: 'json',
            success: function(data) {
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                $('.msg_forgot').html(data.msg);
                $("#msg_forgot").slideDown('slow');
                
                if (data.result == 1) {
                    $('#msg_forgot').attr('class', 'alert alert-success');
                    $("#msg_forgot").alert().delay(6000).slideUp('slow');
                    setTimeout(function () { window.location.href = baseURI + '/login';}, 2000);
                } else {
                    $('#msg_forgot').attr('class', 'alert alert-danger');
                    $("#msg_forgot").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });
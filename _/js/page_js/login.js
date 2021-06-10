    var baseURI = $('base').attr('href');
    
    $("#formLogin").on('submit', function(e) {
        e.preventDefault();
        
        var formAction = $("#formLogin").attr('action');
        var dataLogin = {
        	submit: $("#submitLogin").attr('name'),
            user_name: $("#user_name").val(),
            user_password: $("#user_password").val(),
            debu_token: $('.csrf_token').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataLogin,
            dataType: 'json',
            success: function(data) {
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                $("#msg_form").slideDown('fast');
                $('.msg_form').html(data.msg);
                
                if (data.result == 1) {
                    $('#msg_form').attr('class', 'alert alert-success');
                    setTimeout(function () { window.location.href = baseURI + data.url;}, 3000);
                } else {
                    $('#msg_form').attr('class', 'alert alert-danger');
                    $("#msg_form").alert().delay(3000).slideUp('slow');
                }
            }
        });
        return false;
    });

    $("#formActivation").on('submit', function(e) {
        e.preventDefault();
        
        var formAction = $("#formActivation").attr('action');
        var dataActive = {
            submit: $("#submitPassword").attr('name'),
            user_token: $("#user_token").val(),
            user_password: $("#user_password").val(),
            repeat_password: $("#repeat_password").val(),
            debu_token: $('.csrf_token').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataActive,
            dataType: 'json',
            success: function(data) {
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                $('.msg_active').html(data.msg);
                $("#msg_active").slideDown('fast');
                
                if (data.result == 1) {
                    $('#msg_active').attr('class', 'alert alert-success');
                    setTimeout(function () { window.location.href = baseURI + 'login'; }, 2000);
                } else {
                    $('#msg_active').attr('class', 'alert alert-danger');
                    $("#msg_active").alert().delay(3000).slideUp('slow');
                }
                
            }
        });
        return false;
    });
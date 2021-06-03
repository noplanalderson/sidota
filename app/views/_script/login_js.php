<script>
	$("#formLogin").on('submit', function(e) {
        e.preventDefault();
        
        var formAction = $("#formLogin").attr('action');
        var dataLogin = {
        	submit: $("#submitLogin").attr('name'),
            user_name: $("#user_name").val(),
            user_password: $("#user_password").val(),
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataLogin,
            dataType: 'json',
            success: function(data) {
                
                $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                $("#msg_form").slideDown('fast');
                $('.msg_form').html(data.msg);
                
                if (data.result == 1) {
                    $('#msg_form').attr('class', 'alert alert-success');
                    setTimeout(function () { window.location.href = "<?= base_url();?>" + data.url;}, 3000);
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
            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
        };

        $.ajax({
            type: "POST",
            url: formAction,
            data: dataActive,
            dataType: 'json',
            success: function(data) {
                $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                $('.msg_active').html(data.msg);
                $("#msg_active").slideDown('fast');
                
                if (data.result == 1) {
                    $('#msg_active').attr('class', 'alert alert-success');
                    setTimeout(function () { window.location.href = "<?= base_url('login');?>";}, 2000);
                } else {
                    $('#msg_active').attr('class', 'alert alert-danger');
                    $("#msg_active").alert().delay(3000).slideUp('slow');
                }
                
            }
        });
        return false;
    });
</script>
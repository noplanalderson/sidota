  $(document).ready(function(e){
    $("#passwordForm").on('submit', function(e) {
      e.preventDefault();

        var formAction = $("#passwordForm").attr('action');

        $.ajax({
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            url: formAction,
            dataType: 'json',
            success: function(data) {
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
                }
            }
        });
        return false;
    });
  });
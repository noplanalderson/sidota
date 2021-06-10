	$(document).ready(function(e){
      $("#employeeForm").on('submit', function(e) {
        e.preventDefault();

          var formAction = $("#employeeForm").attr('action');

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
                  $('.message').html(data.msg);
                  $("#message").slideDown('slow');

                  if (data.result == 1) {
                      $('#message').attr('class', 'alert alert-success');
                  } else {
                      $('#message').attr('class', 'alert alert-danger');
                  }

                  $("#message").alert().delay(6000).slideUp('slow');
                  $('body,html').animate({scrollTop: 156}, 800);
              }
          });
          return false;
      });
    });
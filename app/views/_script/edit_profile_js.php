<script nonce="bVZkTTBydlY0T2RBbElMWXlKVjA">
  $(".picture_upload").fileinput({
      theme: "fas",
      uploadUrl: "<?= base_url('upload-pp'); ?>",
      uploadAsync: true,
      showRemove: false,
      showUpload: false,
      showZoom: true,
      showDrag: false,
      showBrowse: false,
      browseOnZoneClick: true,
      showCancel: true,
      autoReplace: false,
      autoOrientImage: true,
      initialPreviewAsData: true,
      uploadExtraData: function() {
          return { 
            id: "<?= encrypt($employee->user_id); ?>",
          };
      },
      initialPreview: [
        "<?= site_url('_/images/users/'.encrypt($employee->user_id).'/'.$employee->employee_picture);?>"
      ],
      initialPreviewConfig: [<?= json_encode($json_picture); ?>]

  }).on('fileuploaded', function(event, data) {
    $('#employee_picture').attr('src', "<?= site_url('/_/images/users/');?>" + data.response.image);
    $('body,html').animate({scrollTop: 156}, 1000);
  });

  $(document).ready(function(e){
      $("#accountForm").on('submit', function(e) {
        e.preventDefault();

          var formAction = $("#accountForm").attr('action');

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
                  
                  $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                  $('.message').html(data.msg);
                  $("#message").slideDown('slow');

                  if (data.result == 1) {

                      var new_bio   = $('textarea[name="employee_bio"]').val();
                      var new_phone = $('input[name="employee_phone"]').val();
                      var new_email = $('input[name="user_email"]').val();
                      var facebook  = $('input[name="facebook"]').val();
                      var instagram = $('input[name="instagram"]').val();
                      var website   = $('input[name="website"]').val();

                      $('#message').attr('class', 'alert alert-success');
                      $('.az-profile-bio').html(new_bio);
                      $('#employee_phone').attr('href', 'tel:'+new_phone).html(new_phone);
                      $('#user_email').attr('href', 'mailto:'+new_email).html(new_email);
                      $('#facebook').attr('href', facebook).html(facebook);
                      $('#instagram').attr('href', instagram).html(instagram);
                      $('#website').attr('href', website).html(website);

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
</script>
<script>
	$(function(){
    'use strict'

	    $(document).ready(function(){
	      $('.select2').select2({
	        placeholder: 'Choose Categeories'
	      });
	    });
   	});

  $("#app_icon").fileinput({
      theme: "fas",
      uploadUrl: "<?= base_url('upload-asset'); ?>",

      showRemove: false,
      showUpload: false,
      showZoom: true,
      showDrag: false,
      showBrowse: false,
      browseOnZoneClick: true,
      showCancel: true,
      autoReplace: false,
      uploadAsync: true,
      autoOrientImage: true,
      initialPreviewAsData: true,
      uploadExtraData: function() {
          return { 
            id: "app_icon",
          };
      },
      initialPreview: [
        "<?= site_url('_/images/sites/'.$this->app->app_icon);?>",
      ],
      initialPreviewConfig: [<?= json_encode($json_icon); ?>]

  }).on('fileuploaded', function(event, data) {
    setTimeout(function(){
        location.reload();
    },3000);
  });

  $("#app_logo").fileinput({
      theme: "fas",
      uploadUrl: "<?= base_url('upload-asset'); ?>",

      showRemove: false,
      showUpload: false,
      showZoom: true,
      showDrag: false,
      showBrowse: false,
      browseOnZoneClick: true,
      showCancel: true,
      autoReplace: false,
      uploadAsync: true,
      autoOrientImage: true,
      initialPreviewAsData: true,
      uploadExtraData: function() {
          return { 
            id: "app_logo",
          };
      },
      initialPreview: [
        "<?= site_url('_/images/sites/'.$this->app->app_logo);?>",
      ],
      initialPreviewConfig: [<?= json_encode($json_logo); ?>]

  }).on('fileuploaded', function(event, data) {
    setTimeout(function(){
        location.reload();
    },3000);
  });

  $("#app_logo_login").fileinput({
      theme: "fas",
      uploadUrl: "<?= base_url('upload-asset'); ?>",

      showRemove: false,
      showUpload: false,
      showZoom: true,
      showDrag: false,
      showBrowse: false,
      browseOnZoneClick: true,
      showCancel: true,
      autoReplace: false,
      uploadAsync: true,
      autoOrientImage: true,
      initialPreviewAsData: true,
      uploadExtraData: function() {
          return { 
            id: "app_logo_login",
          };
      },
      initialPreview: [
        "<?= site_url('_/images/sites/'.$this->app->app_logo_login);?>",
      ],
      initialPreviewConfig: [<?= json_encode($json_logo_login); ?>]

  }).on('fileuploaded', function(event, data) {
    setTimeout(function(){
        location.reload();
    },3000);
  });

    $(document).ready(function(e){
      $("#settingForm").on('submit', function(e) {
        e.preventDefault();

          var formAction = $("#settingForm").attr('action');

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
</script>
<script>
	$(function(){
    'use strict'

	    $(document).ready(function(){
	      $('.select2').select2({
	        placeholder: 'Choose Categeories'
	      });
	    });
   	});

	$("#file").fileinput({
	    theme: "fas",
	    uploadUrl: "",
        showRemove: false,
        showUpload: false,
        showZoom: true,
        showDrag: false,
        showBrowse: false,
        browseOnZoneClick: true,
        showRemove: false,
        showCancel: true,
        autoReplace: true
	});

    $(document).ready(function(e){
      $("#ebookForm").on('submit', function(e) {
        e.preventDefault();

          var formAction = $("#ebookForm").attr('action');

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
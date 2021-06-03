<script>
	$("#files").fileinput({
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
	    $(".upload-form").on('submit', function(e) {
	    	e.preventDefault();

	    	var ajaxTime = new Date().getTime();

	        var formAction = $(".upload-form").attr('action');

	    	$('.loading').html('Uploading files. Please wait...');
	        $("#loading").slideDown('slow');
	        $('#loading').attr('class', 'alert alert-warning');

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
	            }
	        }).done(function() {
	            $("#loading").alert().slideUp('slow');
	        });
	        return false;
	    });
	});
</script>
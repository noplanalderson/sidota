	$("#files").fileinput({
	    theme: "fas",
	    uploadUrl: "",
        showRemove: false,
        showUpload: false,
		fileActionSettings: {
            showZoom: false,
            showDrag: false
        },
        showBrowse: false,
        browseOnZoneClick: true,
        showRemove: false,
        showCancel: true,
        autoReplace: true,
        previewFileIcon: '<i class="fas fa-file"></i>',
	    allowedPreviewTypes: null, // set to empty, null or false to disable preview for all types
	    previewFileIconSettings: {
	        'doc': '<i class="fas fa-file-word text-primary"></i>',
	        'xls': '<i class="fas fa-file-excel text-success"></i>',
	        'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
	        'jpg': '<i class="fas fa-file-image text-warning"></i>',
	        'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
	        'zip': '<i class="fas fa-file-archive text-muted"></i>',
	        'htm': '<i class="fas fa-file-code text-info"></i>',
	        'txt': '<i class="fas fa-file-text text-info"></i>',
	        'mov': '<i class="fas fa-file-movie-o text-warning"></i>',
	        'mp3': '<i class="fas fa-file-audio text-warning"></i>',
	    },
	    previewFileExtSettings: {
	        'doc': function(ext) {
	            return ext.match(/(doc|docx)$/i);
	        },
	        'xls': function(ext) {
	            return ext.match(/(xls|xlsx)$/i);
	        },
	        'ppt': function(ext) {
	            return ext.match(/(ppt|pptx)$/i);
	        },
	        'zip': function(ext) {
	            return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
	        },
	        'htm': function(ext) {
	            return ext.match(/(php|js|css|htm|html)$/i);
	        },
	        'txt': function(ext) {
	            return ext.match(/(txt|ini|md)$/i);
	        },
	        'mov': function(ext) {
	            return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
	        },
	        'mp3': function(ext) {
	            return ext.match(/(mp3|wav)$/i);
	        },
	    }
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
	                $('.csrf_token').val(data.token);
	                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
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
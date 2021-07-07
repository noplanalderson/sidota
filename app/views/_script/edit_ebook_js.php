<script nonce="<?= NONCE ?>">
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
        fileActionSettings: {
            showZoom: false,
            showDrag: false
        },
        showBrowse: false,
        browseOnZoneClick: true,
        showCancel: true,
        autoReplace: true,
        uploadAsync: true,
        initialPreviewAsData: true,
        uploadExtraData: function() {
          return { 
            id: <?= $ebook->ebook_id; ?>,
            upload_date: "<?= date('Y-m-d'); ?>"
          };
        },
        initialPreview: [
            "<?= site_url('_/files/'.encrypt($ebook->employee_id).'/'.$ebook->month.'/'.$ebook->ebook_file);?>"
        
        ],
        initialPreviewConfig: [<?= json_encode($json_ebook); ?>],
        preferIconicPreview: true,
        previewFileIconSettings: {
            'doc': '<i class="fas fa-file-word text-primary"></i>',
            'xls': '<i class="fas fa-file-excel text-success"></i>',
            'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
            'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
            'txt': '<i class="fas fa-file text-info"></i>',
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
            'txt': function(ext) {
                return ext.match(/(txt)$/i);
            },
            'pdf': function(ext) {
                return ext.match(/(pdf)$/i);
            }
        }
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
</script>
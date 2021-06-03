<script>
  $(function(){
    'use strict'

    $(document).ready(function(){
      $('.select2').select2({
        placeholder: 'Choose Category'
      });
    });

    $('.fc-datepicker').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'yy-mm-dd'
    });

    $(function() {
      $('#action').tagsInput({
        width: 'auto',
        defaultText:"Action"
      });
      $('#result').tagsInput({
        width: 'auto',
        defaultText:"Result"
      });
    });
  });

  $(".picture_upload").fileinput({
      theme: "fas",
      uploadUrl: "<?= base_url('upload-documentation'); ?>",

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
            id: <?= $report->activity_id; ?>,
            date_activity: "<?= date('Y-m-d'); ?>"
          };
      },
      initialPreview: [
        <?php foreach ($pictures as $picture) :?>
        "<?= site_url('_/images/uploads/'.encrypt($picture['employee_id']).'/'.$picture['month'].'/'.$picture['picture']);?>",
        <?php endforeach;?>
      ],
      initialPreviewConfig: <?= json_encode($json_pictures); ?>

  });

  $(document).ready(function(e){
      $("#activityForm").on('submit', function(e) {
        e.preventDefault();

          var formAction = $("#activityForm").attr('action');

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
                  $("#message").alert().slideDown('slow');
                  $('body,html').animate({scrollTop: 156}, 800);

                  if (data.result == 1) {
                      $('#message').attr('class', 'alert alert-success');
                      setTimeout(location.reload.bind(location), 6500);
                  } else {
                      $('#message').attr('class', 'alert alert-danger');
                  }

                  $("#message").alert().delay(6000).slideUp('slow');
              }
          });
          return false;
      });
  });
  
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper       = $("#field"); //Fields wrapper
    var add_button      = $("#add"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $(wrapper).append('<div class="row added mg-t-20"><div class="col-md-4 mg-t-5 mg-md-t-0"><input type="text" id="tool-'+x+'" name="tool[]" class="form-control" placeholder="Tool" value=""></div><div class="col-md-4 mg-t-5 mg-md-t-0"><input type="text" id="owner-'+x+'" name="tool_owner[]" class="form-control" placeholder="Tool Owner" value=""></div><a href="#" class="remove_field"><i class="fas fa-times-circle"></i></a></div>'); //add input box

        var form_id = x - 1;
        var tool = $('input[id="tool-'+form_id+'"]').val();
        var owner = $('input[id="owner-'+form_id+'"]').val();

        if(tool !== '' && owner !== '')
        {
          $.ajax({
            type: "POST",
            url: "<?= base_url('add-tool')?>",
            data: {
              activity_id : <?= $report->activity_id; ?>,
              tool : tool,
              tool_owner : owner
            },
            dataType: 'json',
            success: function(data) {
                  
              $('#tool_msg').html(data.msg);
              $("#tool_msg").alert().fadeIn('slow');

              if (data.result == 1) {
                  $('#tool_msg').attr('class', 'text-success');
              } else {
                  $('#tool_msg').attr('class', 'text-danger');
              }

              $("#tool_msg").alert().delay(6000).fadeOut('slow');
            }
          });
        }
      }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); 
      if($('input[name="tool[]"]').length > 1)
      {
        $(this).parent('.added').remove(); x--;
      }
    })

    $(wrapper).on("click",".remove_tool", function(e){ //user click on remove text
      e.preventDefault(); 
      const tool_id = $(this).data('id');
      $.ajax({
          type: "GET",
          url: "<?= base_url('remove-tool/')?>" + tool_id,
          dataType: 'json',
          success: function(data) {

            if (data.result == 1) {
              if($('input[name="tool[]"]').length > 1)
              {
                $('.' + tool_id).fadeOut(1000,function(){ 
                    $('.' + tool_id).remove();                    
                });
              }
              else
              {
                $('input[name="tool[]"]').val('');
                $('input[name="tool_owner[]"]').val('');
              }
            }
          }
      });
    })
  });
</script>
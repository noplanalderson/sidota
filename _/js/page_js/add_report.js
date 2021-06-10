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
      uploadUrl: "",
      showRemove: false,
      showUpload: false,
      showZoom: true,
      showDrag: false,
      showBrowse: false,
      browseOnZoneClick: true,
      showCancel: true,
      autoReplace: false,
      autoOrientImage: true
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
        $(wrapper).append('<div class="row added mg-t-20"><div class="col-md-4 mg-t-5 mg-md-t-0"><input type="text" name="tool[]" class="form-control" placeholder="Tool" value=""></div><div class="col-md-4 mg-t-5 mg-md-t-0"><input type="text" name="tool_owner[]" class="form-control" placeholder="Tool Owner" value=""></div><a href="#" class="remove_field"><i class="fas fa-times-circle"></i></a></div>'); //add input box
      }
    });
    
    $(wrapper).on("click",".remove_tool", function(e){ //user click on remove text
      e.preventDefault();
      if($('input[name="tool[]"]').length > 1)
      {
        $(this).parent('.added').remove(); x--;
      }
      else
      {
        $('input[name="tool[]"]').val('');
        $('input[name="tool_owner[]"]').val('');
      }
    })
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
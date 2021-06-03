<script>
  $(document).ready(function(){
    'use strict';

    $('.utilities').DataTable({
      ordering: false,
      dom: '<"left"l><"right"fr>tip',
    });
  });

  $(function(){
    $('.add-jobdesc').on('click', function() {
      $('.modal-title').html('Add Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', '<?= base_url("add-utility/jobdesc");?>');

        $('#jobdesc_id').val('');
        $('#jobdesc_name').val('');
        $('#type_id').val('');
    });

    $('.edit-jobdesc').on('click', function() {
      $('.modal-title').html('Edit Jobdesc');
      $('.modal-footer button[type=submit]').html('Edit');
      $('.modal-body form').attr('action', '<?= base_url("edit-utility/jobdesc");?>');

      const jobdesc_id = $(this).data('id');
      $.ajax({
          url: '<?= base_url("get-jobdesc");?>',
          data: {
                  id: jobdesc_id, 
                  <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
              },
          method: 'post',
          dataType: 'json',
          success: function(data){
              $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
              $('#jobdesc_id').val(jobdesc_id);
              $('#jobdesc_name').val(data.jobdesc_name);
              $('#type_id').val(data.type_id);
          }
      });
    });

    $('.add-act-category').on('click', function() {
      $('.modal-title').html('Add Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', '<?= base_url("add-utility/act-category");?>');

        $('#category_activity_id').val('');
        $('#category_activity').val('');
    });

    $('.edit-act-category').on('click', function() {
      $('.modal-title').html('Edit Activity Category');
      $('.modal-footer button[type=submit]').html('Edit');
      $('.modal-body form').attr('action', '<?= base_url("edit-utility/act-category");?>');

      const category_activity_id = $(this).data('id');
      $.ajax({
          url: '<?= base_url("get-act-category");?>',
          data: {
                  id: category_activity_id, 
                  <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
              },
          method: 'post',
          dataType: 'json',
          success: function(data){
              $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
              $('#category_activity_id').val(category_activity_id);
              $('#category_activity').val(data.category_activity);
          }
      });
    });

    $('.add-ebook-category').on('click', function() {
      $('.modal-title').html('Add Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', '<?= base_url("add-utility/ebook-category");?>');

        $('#id_category').val('');
        $('#category').val('');
    });

    $('.edit-ebook-category').on('click', function() {
      $('.modal-title').html('Edit Ebook Category');
      $('.modal-footer button[type=submit]').html('Edit');
      $('.modal-body form').attr('action', '<?= base_url("edit-utility/ebook-category");?>');

      const id_category = $(this).data('id');
      $.ajax({
          url: '<?= base_url("get-ebook-category");?>',
          data: {
                  id: id_category, 
                  <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
              },
          method: 'post',
          dataType: 'json',
          success: function(data){
              $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
              $('#id_category').val(id_category);
              $('#category').val(data.category);
          }
      });
    });
  });

  $(document).ready(function(e){
    $("#jobdescForm").on('submit', function(e) {
      e.preventDefault();

        var formAction = $("#jobdescForm").attr('action');
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
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                $('.jobdesc_msg').html(data.msg);
                $("#jobdesc_msg").slideDown('fast');

                if (data.result == 1) {
                    $('#jobdesc_msg').attr('class', 'alert alert-success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('#jobdesc_msg').attr('class', 'alert alert-danger');
                    $("#jobdesc_msg").alert().delay(6000).slideUp('slow');
                }
            }
        });
        return false;
    });
  });

  $(document).ready(function(e){
    $("#actCatForm").on('submit', function(e) {
      e.preventDefault();

        var formAction = $("#actCatForm").attr('action');
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
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                $('.catAct_msg').html(data.msg);
                $("#catAct_msg").slideDown('fast');

                if (data.result == 1) {
                    $('#catAct_msg').attr('class', 'alert alert-success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('#catAct_msg').attr('class', 'alert alert-danger');
                    $("#catAct_msg").alert().delay(6000).slideUp('slow');
                }
            }
        });
        return false;
    });
  });

  $(document).ready(function(e){
    $("#ebookCatForm").on('submit', function(e) {
      e.preventDefault();

        var formAction = $("#ebookCatForm").attr('action');
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
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                $('.ebookCat_msg').html(data.msg);
                $("#ebookCat_msg").slideDown('fast');

                if (data.result == 1) {
                    $('#ebookCat_msg').attr('class', 'alert alert-success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    $('#ebookCat_msg').attr('class', 'alert alert-danger');
                    $("#ebookCat_msg").alert().delay(6000).slideUp('slow');
                }
            }
        });
        return false;
    });
  });

  $(".utilities").on('click', '.delete-btn', function(){
      var result = confirm("Are You Sure to Delete this Item?");

      if (result) {
          var $tr = $(this).closest('tr');
          const id = $(this).data('id');
          var item = $(this).attr('id');

          $.ajax({
              url: '<?= base_url("delete-utility/");?>' + item,
              data: {
                      id: id, 
                      <?= $this->security->get_csrf_token_name();?>: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                  },
              method: 'post',
              dataType: 'json',
              success: function(data) {
                  $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                  $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                  
                  $("#delete_msg").slideDown('fast');
                  
                  if (data.result == 1) {
                      $('#delete_msg').attr('class', 'alert alert-success');
                      $tr.find('td').fadeOut(1000,function(){ 
                          $tr.remove();                    
                      });
                  } else {
                      $('#delete_msg').attr('class', 'alert alert-danger');
                  }

                  $('.delete_msg').html(data.msg);
                  $("#delete_msg").alert().delay(6000).slideUp('slow');
              }
          });
      }
  });
</script>
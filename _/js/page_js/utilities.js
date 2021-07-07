  var baseURI = $('base').attr('href');

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
        $('.modal-body form').attr('action', baseURI + 'add-utility/jobdesc');

        $('#jobdesc_id').val('');
        $('#jobdesc_name').val('');
        $('#type_id').val('');
    });

    $('.utilities').on('click', '.edit-jobdesc', function() {
      $('.modal-title').html('Edit Jobdesc');
      $('.modal-footer button[type=submit]').html('Edit');
      $('.modal-body form').attr('action', baseURI + 'edit-utility/jobdesc');

      const jobdesc_id = $(this).data('id');
      $.ajax({
          url: baseURI + 'get-jobdesc',
          data: {
                  id: jobdesc_id, 
                  debu_token: $('.csrf_token').attr('value')
              },
          method: 'post',
          dataType: 'json',
          success: function(data){
              $('.csrf_token').val(data.token);
              $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
              $('#jobdesc_id').val(jobdesc_id);
              $('#jobdesc_name').val(data.jobdesc_name);
              $('#type_id').val(data.type_id);
          }
      });
    });

    $('.add-act-category').on('click', function() {
      $('.modal-title').html('Add Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', baseURI + 'add-utility/act-category');

        $('#category_activity_id').val('');
        $('#category_activity').val('');
    });

    $('.utilities').on('click', '.edit-act-category', function() {
      $('.modal-title').html('Edit Activity Category');
      $('.modal-footer button[type=submit]').html('Edit');
      $('.modal-body form').attr('action', baseURI + 'edit-utility/act-category');

      const category_activity_id = $(this).data('id');
      $.ajax({
          url: baseURI + 'get-act-category',
          data: {
                  id: category_activity_id, 
                  debu_token: $('.csrf_token').attr('value')
              },
          method: 'post',
          dataType: 'json',
          success: function(data){
              $('.csrf_token').val(data.token);
              $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
              $('#category_activity_id').val(category_activity_id);
              $('#category_activity').val(data.category_activity);
          }
      });
    });

    $('.add-ebook-category').on('click', function() {
      $('.modal-title').html('Add Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action', baseURI + 'add-utility/ebook-category');

        $('#id_category').val('');
        $('#category').val('');
    });

    $('.utilities').on('click','.edit-ebook-category', function() {
      $('.modal-title').html('Edit Ebook Category');
      $('.modal-footer button[type=submit]').html('Edit');
      $('.modal-body form').attr('action', baseURI + 'edit-utility/ebook-category');

      const id_category = $(this).data('id');
      $.ajax({
          url: baseURI + 'get-ebook-category',
          data: {
                  id: id_category, 
                  debu_token: $('.csrf_token').attr('value')
              },
          method: 'post',
          dataType: 'json',
          success: function(data){
              $('.csrf_token').val(data.token);
              $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
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
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
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
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
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
                
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                    setTimeout(location.reload.bind(location), 1000);
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
                }
            }
        });
        return false;
    });
  });

  $(".utilities").on('click', '.delete-btn', function(e){
      e.preventDefault();

      Swal.fire({
        text: 'Are You sure to delete this utility?',
        showCancelButton: true,
        type: 'warning',
        confirmButtonText: 'Yes',
        reverseButtons: true
      }).then((result) => {

      if (result.value == true) {

        var $tr = $(this).closest('tr');
        const id = $(this).data('id');
        var item = $(this).attr('id');

        $.ajax({
            url: baseURI + 'delete-utility/' + item,
            data: {
                    id: id, 
                    debu_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
                
                if (data.result == 1) {
                    Swal.fire('Success!', data.msg, 'success');
                    $tr.find('td').fadeOut(1000,function(){ 
                        $tr.remove();                    
                    });
                } else {
                    Swal.fire('Failed!', data.msg, 'error');
                }
            }
        });
      }
    })
  });
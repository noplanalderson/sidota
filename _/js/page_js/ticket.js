  var baseURI = $('base').attr('href');

  $(document).ready(function(){
    'use strict';

    $('#ticket').DataTable({
      responsive: true,
      "language": {
        "paginate": {
          "previous": "<i class='fas fa-chevron-left'></i>",
          "next": "<i class='fas fa-chevron-right'></i>",
        },
      },
      ordering: false,
          dom: '<"left"l><"right"fr>Btip',
          buttons: [
          {
            extend: 'excelHtml5',
            pageSize: 'A4',
            title: "Ticket List",
              exportOptions: {
                columns: [0,1,2,3,4,5,6]
              }
          },
          {
            extend: 'pdfHtml5',
            pageSize: 'Legal',
            orientation: 'landscape',
            title: "Ticket List",
              customize : function(doc) {
                doc.content.splice(0, 1, {
                  text: [{
                    text: "Ticket List \n\n\n",
                    fontSize: 14,
                    alignment: 'center'
                  }]
                });
                doc.content[1].margin = [ 10, 0, 10, 0 ];
                doc.content[1].table.widths = [80,100,80,200,100,120,120];
              },
            exportOptions: {
              columns: [0,1,2,3,4,5,6]
            }
          }
        ]
    });

    var deleteLinks = document.querySelectorAll('.delete');

    for (var i = 0; i < deleteLinks.length; i++) {
      deleteLinks[i].addEventListener('click', function(event) {
          event.preventDefault();

          var choice = confirm(this.getAttribute('title'));

          if (choice) {
            window.location.href = this.getAttribute('href');
          }
      });
    }
  });

  $(".ticket-status").on('change', function(){
    var status = $('select[name="status"]').val();
    window.location.href = baseURI + "/ticket/" + status;
  });

 
  $('.add-ticket').on('click', function() {
      $('.modal-title').html('Add Ticket');
      $('.modal-footer button[type=submit]').html('Add');
      $('.modal-body form').attr('action', baseURI + '/add-ticket');

      $('#ticket_code').val('');
      $('#reporter').val('');
      $('#problem_report').val('');
      $('#date_report').val('');
      $('#location').val('');
      $('#category_activity_id').select2({
          width: '100%',
          dropdownParent: $('#ticketModal'),
          minimumResultsForSearch: Infinity,
          placeholder: 'Choose Category'
      }).val('').trigger('change');
  });

  $('.edit-ticket').on('click', function() {
    $('.modal-title').html('Edit Ticket');
    $('.modal-footer button[type=submit]').html('Edit');
    $('.modal-body form').attr('action', baseURI + '/edit-ticket');

    const ticket_code = $(this).data('id');

    $.ajax({
        url: baseURI + '/get-ticket',
        data: {
                id: ticket_code, 
                debu_token: $('.csrf_token').attr('value')
            },
        method: 'post',
        dataType: 'json',
        success: function(data){
            
            $('.csrf_token').val(data.token);
            $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

            $('#ticket_code').val(ticket_code);
            $('#reporter').val(data.reporter);
            $('#problem_report').val(data.problem_report);
            $('#date_report').val(data.date_report);
            $('#location').val(data.location);
            $('#category_activity_id').select2({
                width: '100%',
                dropdownParent: $('#ticketModal'),
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose Category'
            }).val(data.category_activity_id).trigger('change');
        }
    });
  });


  $("#submit").click(function() {
      
      var formAction = $("#ticketForm").attr('action');

      var ticketData = {
          ticket_code : $('#ticket_code').val(),
          reporter : $('#reporter').val(),
          problem_report : $('#problem_report').val(),
          date_report : $('#date_report').val(),
          location : $('#location').val(),
          category_activity_id : $('#category_activity_id').val(),
          debu_token : $('.csrf_token').attr('value')
      };

      $.ajax({
          type: "POST",
          url: formAction,
          data: ticketData,
          dataType: 'json',
          success: function(data) {
              
              $('.csrf_token').val(data.token);
              $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);
              
              $('.message').html(data.msg);
              $("#message").slideDown('slow');

              if (data.result == 1) {
                  $('#message').attr('class', 'alert alert-success');
                  setTimeout(location.reload.bind(location), 1000);
              } else {
                  $('#message').attr('class', 'alert alert-danger');
                  $("#message").alert().delay(3000).slideUp('slow');
              }
          }
      });
      return false;
  });

  $("#ticket").on('click', '.delete-btn', function(){
      var result = confirm("Are You Sure to Delete Ticket?");

      if (result) {
          var $tr = $(this).closest('tr');
          const ticket_code = $(this).data('id');
          $.ajax({
              url: baseURI + '/delete-ticket',
              data: {
                      id: ticket_code, 
                      debu_token: $('.csrf_token').attr('value')
                  },
              method: 'post',
              dataType: 'json',
              success: function(data) {
                  $('.modal-body .csrf_token').val(data.token);
                  $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                  $('.delete_msg').html(data.msg);
                  $("#delete_msg").slideDown('slow');
                  
                  if (data.result == 1) {
                      $('#delete_msg').attr('class', 'alert alert-success');
                      $tr.find('td').fadeOut(1000,function(){ 
                          $tr.remove();                    
                      });
                  } else {
                      $('#delete_msg').attr('class', 'alert alert-danger');
                  }
                  
                  $("#delete_msg").alert().delay(6000).slideUp('slow');
              }
          });
      }
  });
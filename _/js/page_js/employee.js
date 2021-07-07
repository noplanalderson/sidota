  $('#employees').DataTable({
    responsive: true,
    "language": {
      "info": "Showing _START_ to _END_ from _TOTAL_ employees",
      "emptyTable": "No Employee Data",
      "lengthMenu": "_MENU_ &nbsp; employees/page",
      "search": "Search: ",
      "zeroRecords": "Employee not Found",
      "paginate": {
        "previous": "<i class='fas fa-chevron-left'></i>",
        "next": "<i class='fas fa-chevron-right'></i>",
      },
    },
    ordering: false,
    dom: '<"left"l><"right"fr>tip',
  });

  $("#employees").on('click', '.delete-btn', function(e){
      e.preventDefault();

      Swal.fire({
        text: 'Are You sure to delete this employee?',
        showCancelButton: true,
        type: 'warning',
        confirmButtonText: 'Yes',
        reverseButtons: true
      }).then((result) => {

      if (result.value == true) {
          var $tr = $(this).closest('tr');
          const employee_id = $(this).data('id');

          $.ajax({
            url: baseURI + 'delete-employee',
            data: { 
              id: employee_id,
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
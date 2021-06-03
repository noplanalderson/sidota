<script>
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

  $("#employees").on('click', '.delete-btn', function(){
    var result = confirm("Are You sure to delete this employee?");

      if (result) {
          var $tr = $(this).closest('tr');
          const employee_id = $(this).data('id');

          $.ajax({
              url: '<?= base_url("delete-employee");?>',
              data: { 
                id: employee_id,
                <?= $this->security->get_csrf_token_name();?>: $('meta[name="X-CSRF-TOKEN"]').attr('content')
              },
              method: 'post',
              dataType: 'json',
              success: function(data) {

                $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                  $('#delete_msg').attr('class', 'alert alert-success');
                  $tr.find('td').fadeOut(1000,function(){ 
                    $tr.remove();                    
                  });
                } 
                else {
                  $('#delete_msg').attr('class', 'alert alert-danger');
                }

                $('.delete_msg').html(data.msg);
                $("#delete_msg").slideDown('slow');
                $("#delete_msg").alert().delay(6000).slideUp('slow');
              }
          });
      }
  });
</script>
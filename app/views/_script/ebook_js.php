<script>
  $(document).ready(function(){
    'use strict';

    $('#ebook').DataTable({
      responsive: true,
      "language": {
        "info": "Showing _START_ to _END_ from _TOTAL_ ebook",
        "emptyTable": "No Ebook List",
        "lengthMenu": "_MENU_ &nbsp; ebook/page",
        "search": "Search: ",
        "zeroRecords": "Ebook not Found",
        "paginate": {
          "previous": "<i class='fas fa-chevron-left'></i>",
          "next": "<i class='fas fa-chevron-right'></i>",
        },
      },
      ordering: false,
      dom: '<"left"l><"right"fr>tip',
    });
  });

  $("#ebook").on('click', '.delete-btn', function(){
      var result = confirm("Are You Sure to Delete Ebook?");

      if (result) {
          var $tr = $(this).closest('tr');
          const ebook_hash = $(this).data('id');

          $.ajax({
              url: '<?= base_url("delete-ebook");?>',
              data: { 
                hash: ebook_hash,
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
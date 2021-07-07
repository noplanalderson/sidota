  var baseURI = $('base').attr('href');

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

  $("#ebook").on('click', '.delete-btn', function(e){
      e.preventDefault();

      Swal.fire({
        text: 'Are You sure to delete this image?',
        showCancelButton: true,
        type: 'question',
        confirmButtonText: 'Yes',
        reverseButtons: true
      }).then((result) => {

      if (result.value == true) {
          var $tr = $(this).closest('tr');
          const ebook_hash = $(this).data('id');

          $.ajax({
              url: baseURI + '/delete-ebook',
              data: { 
                hash: ebook_hash,
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
                } 
                else {
                  Swal.fire('Failed!', data.msg, 'error');
                }
              }
          });
      }
    })
  });
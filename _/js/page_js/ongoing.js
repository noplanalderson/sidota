  var baseURI = $('base').attr('href');

  $(document).ready(function(){
    'use strict';

    $('#ongoing').DataTable({
      responsive: true,
      "language": {
        "info": "Showing _START_ to _END_ from _TOTAL_ Activities",
        "emptyTable": "No Pending or On Progress Activity",
        "lengthMenu": "_MENU_ &nbsp; data/page",
        "search": "Cari: ",
        "zeroRecords": "Activity not Found",
        "paginate": {
          "previous": "<i class='fas fa-chevron-left'></i>",
          "next": "<i class='fas fa-chevron-right'></i>",
        },
      },
      ordering: false,
    });
  });

  $("#ongoing").on('change', '.status', function(e){

    e.preventDefault();

    var $tr = $(this).closest('tr');
    const activity_id = $(this).data('id');

    Swal.fire({
      text: 'Are You sure to update this report?',
      showCancelButton: true,
      type: 'question',
      confirmButtonText: 'Yes',
      reverseButtons: true
    }).then((result) => {

      if (result.value == true) {

          $.ajax({
              url: baseURI + '/update-progress',
              data: { 
                id: activity_id,
                status: $('select[data-id="'+activity_id+'"]').val(),
                debu_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
              },
              method: 'post',
              dataType: 'json',
              success: function(data) {

                $('.csrf_token').val(data.token);
                $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                if (data.result == 1) {
                  swal("Success!", data.msg, "success");
                  if(data.progress === 'finished') {
                    $tr.find('td').fadeOut(1000,function(){ 
                      $tr.remove();                    
                    });
                  }
                } 
                else {

                  swal("Failed!", data.msg, "danger");
                }
              }
          });
      }
      else
      {
        $('select[data-id="'+activity_id+'"]').val( $('select[data-id="'+activity_id+'"]').find("option[selected]").val() );
      }
    })
  });
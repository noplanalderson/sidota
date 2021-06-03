<script>
  $(document).ready(function(){
    'use strict';

    $('#ongoing').DataTable({
      responsive: true,
      "language": {
        "info": "Showing _START_ to _END_ from _TOTAL_ report",
        "emptyTable": "No Pending Job",
        "lengthMenu": "_MENU_ &nbsp; reports/page",
        "search": "Cari: ",
        "zeroRecords": "Report not Found",
        "paginate": {
          "previous": "<i class='fas fa-chevron-left'></i>",
          "next": "<i class='fas fa-chevron-right'></i>",
        },
      },
      "pageLength": 5,
      "lengthMenu": [ [5, 10, 25, -1], [5, 10, 25, "All"] ],
      ordering: false,
          dom: '<"left"l><"right"fr>Btip',
          buttons: [
          {
            extend: 'excelHtml5',
            pageSize: 'Legal',
            orientation: 'landscape',
            title: "Pending Job Reports - Last Week",
            messageTop: "PENDING JOB REPORTS \n",

            messageTop: "<?= $yesterday.' - '.$now;?> \n",
              exportOptions: {
                columns: [0,1,2,3,4]
              }
          },
          {
            extend: 'pdfHtml5',
            pageSize: 'Legal',
            orientation: 'landscape',
            title: "Pending Job Reports - Last Week",
              customize : function(doc) {
                doc.content.splice(0, 1, {
                  text: [
                    {
                    text: "PENDING JOB REPORTS \n",
                    fontSize: 14,
                    alignment: 'center'
                    }, 
                    {
                      text: "<?= $yesterday.' - '.$now;?> \n\n\n",
                      fontSize: 11,
                      alignment: 'center'
                    },
                  ]
                });
                doc.content[1].margin = [ 10, 0, 10, 0 ];
                doc.content[1].table.widths = [110,120,220,220,80];
              },
            exportOptions: {
              columns: [0,1,2,3,4]
            }
          }
        ]
    });
  });


  $("#ongoing").on('change', '.status', function(){
    var result = confirm("Are You sure to update this report?");

    if (result) {
      var $tr = $(this).closest('tr');
      const activity_id = $(this).data('id');

      $.ajax({
        url: '<?= base_url("update-progress");?>',
        data: { 
          id: activity_id,
          status: $('select[data-id="'+activity_id+'"]').val(),
          <?= $this->security->get_csrf_token_name();?>: $('meta[name="X-CSRF-TOKEN"]').attr('content')
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {

          $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);
          $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

          if (data.result == 1) {
            $('#message').attr('class', 'alert alert-success');
            if(data.progress === 'finished') {
              $tr.find('td').fadeOut(1000,function(){ 
                $tr.remove();                    
              });
            }
          } 
          else {
            $('#message').attr('class', 'alert alert-danger');
          }

          $('.message').html(data.msg);
          $("#message").slideDown('slow');
          $("#message").alert().delay(6000).slideUp('slow');
        }
      });
    }
  });
</script>
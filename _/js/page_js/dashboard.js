  var baseURI = $('base').attr('href');
  var ongoingPeriod = $('.ongoing-period').text();

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

            messageTop: ongoingPeriod + "\n",
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
                      text: ongoingPeriod + "\n\n\n",
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


  $("#ongoing").on('change', '.status', function(e){

    e.preventDefault();

    Swal.fire({
      text: 'Are You sure to update this report?',
      showCancelButton: true,
      type: 'question',
      confirmButtonText: 'Yes',
      reverseButtons: true
    }).then((result) => {

      if (result.value == true) {

        var $tr = $(this).closest('tr');
        const activity_id = $(this).data('id');

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
              swal("Failed!", data.msg, "error");
            }
          }
        });
      }
    })
  });
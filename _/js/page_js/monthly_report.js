  var baseURI = $('base').attr("href");
  var employeeName = $('.employee-name').text();
  var employeeJobdesc = $('.employee-jobdesc').text();
  var title = $('title').text();

  var reports = $('#reports').DataTable({
    responsive: true,
    "language": {
      "info": "Showing _START_ to _END_ from _TOTAL_ reports",
      "emptyTable": "No activity report",
      "lengthMenu": "_MENU_ &nbsp; reports/page",
      "search": "Search: ",
      "zeroRecords": "No report found",
      "paginate": {
        "previous": "<i class='fas fa-chevron-left'></i>",
        "next": "<i class='fas fa-chevron-right'></i>",
      },
    },
    columns: [
          null,
          null,
          null,
          null,
          null,
          null,
          null,
          {
              "render": function(data, type, row){
                  return data.split("- ").join("<br/>- \n");
              }
          },
          null
      ],
    ordering: false,
        dom: '<"left"l><"right"fr>Btip',
        buttons: [
        {
          extend: 'excelHtml5',
          pageSize: 'Legal',
          orientation: 'landscape',
          title: "Work Reports - " + employeeName,
          messageTop: employeeName + "\n",
          messageTop: employeeJobdesc + "\n",
          title: "Work Report " + title,
            exportOptions: {
              columns: [0,1,2,3,4,5,6,7]
            }
        },
        {
          extend: 'pdfHtml5',
          pageSize: 'Legal',
          orientation: 'landscape',
          title: "Work Report " + title,
            customize : function(doc) {
              doc.content.splice(0, 1, {
                text: [
                  {
                  text: employeeName + "\n",
                  fontSize: 14,
                  alignment: 'center'
                  }, 
                  {
                    text: employeeJobdesc + "\n\n\n",
                    fontSize: 11,
                    alignment: 'center'
                  },
                ]
              });
              doc.content[1].margin = [ 10, 0, 10, 0 ];
              doc.content[1].table.widths = [80,60,80,80,150,130,130,130];
            },
          exportOptions: {
            columns: [0,1,2,3,4,5,6,7]
          }
        }
      ]
  });

  $("#reports").on('click', '.delete-btn', function(){
    var result = confirm("Are You sure to delete this report?");

      if (result) {
          var $tr = $(this).closest('tr');
          const activity_id = $(this).data('id');

          $.ajax({
              url: baseURI + '/delete-report',
              data: { 
                id: activity_id,
                debu_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
              },
              method: 'post',
              dataType: 'json',
              success: function(data) {

                $('.csrf_token').val(data.token);
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
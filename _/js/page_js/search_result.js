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
          }
      ],
    ordering: false,
    dom: '<"left"l><"right"fr>tip',
  });
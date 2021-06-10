  $('.fc-datepicker').datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    dateFormat: 'yy-mm-dd'
  });

  $("#copy").on('click', function(e) {
    e.preventDefault();
    if (document.selection) 
    {
      var range = document.body.createTextRange();
      range.moveToElementText(document.getElementById('area'));
      range.select().createTextRange();
      document.execCommand("copy");
    } 
    else if (window.getSelection) 
    {
      var range = document.createRange();
      range.selectNode(document.getElementById('area'));
      window.getSelection().addRange(range);
      document.execCommand("copy");
      alert("Report Copied.")
    }
  });

  $("#shift").on('change', function(e) {
    $("#dailyForm").submit();
  });
var baseURI = $('base').attr('href');

jQuery(function() {
    jQuery( "#from" ).datepicker({
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: "yy-mm-dd",
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    jQuery( "#to" ).datepicker({
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: "yy-mm-dd",
      onClose: function( selectedDate ) {
        jQuery( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
});

  $(".report-period").on('submit', function(e) {
      e.preventDefault();
      
      var dataPeriod = {
          submit: $("#submit").attr('name'),
          uid: $("#uid").val(),
          from: $("#from").val(),
          to: $("#to").val(),
          debu_token: $('.csrf_token').attr('value')
      };

      var start = parseInt((new Date(dataPeriod.from).getTime() / 1000).toFixed(0));
      var end = parseInt((new Date(dataPeriod.to).getTime() / 1000).toFixed(0));

      var url = start + '-' + end + '/' + dataPeriod.uid;
      window.location.href = baseURI + "/periodic-report/" + url;
  });

  $(".documentation-period").on('submit', function(e) {
      e.preventDefault();
      
      var dataPeriod = {
          submit: $("#submit").attr('name'),
          uid: $("#uid").val(),
          from: $("#from").val(),
          to: $("#to").val(),
          debu_token: $('.csrf_token').attr('value')
      };

      var start = parseInt((new Date(dataPeriod.from).getTime() / 1000).toFixed(0));
      var end = parseInt((new Date(dataPeriod.to).getTime() / 1000).toFixed(0));

      var url = start + '-' + end + '/' + dataPeriod.uid;
      window.location.href = baseURI + "/periodic-documentation/" + url;
  });
<script>
jQuery(function() {
    jQuery( "#from" ).datepicker({
      // defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      dateFormat: "yy-mm-dd",
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    jQuery( "#to" ).datepicker({
      // defaultDate: "+1w",
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
          <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
      };

      var start = parseInt((new Date(dataPeriod.from).getTime() / 1000).toFixed(0));
      var end = parseInt((new Date(dataPeriod.to).getTime() / 1000).toFixed(0));

      var url = start + '-' + end + '/' + dataPeriod.uid;
      window.location.href = "<?= base_url('periodic-report/');?>" + url;
  });

  $(".documentation-period").on('submit', function(e) {
      e.preventDefault();
      
      var dataPeriod = {
          submit: $("#submit").attr('name'),
          uid: $("#uid").val(),
          from: $("#from").val(),
          to: $("#to").val(),
          <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
      };

      var start = parseInt((new Date(dataPeriod.from).getTime() / 1000).toFixed(0));
      var end = parseInt((new Date(dataPeriod.to).getTime() / 1000).toFixed(0));

      var url = start + '-' + end + '/' + dataPeriod.uid;
      window.location.href = "<?= base_url('periodic-documentation/');?>" + url;
  });
</script>
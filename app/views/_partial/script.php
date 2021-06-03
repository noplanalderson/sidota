<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

		<!-- js -->
		<?= js('core.min') ?>

		<?= js('root-fw.min') ?>

		<?= js('azia') ?>

		<?php $this->_CI->load_js_plugin() ?>
		
		<?php $this->_CI->load_js() ?>
		
		<?= $custom_js; ?>
		
		<script>
		$(".formSearch").on('submit', function(e) {
	        e.preventDefault();
	        
	        var formAction = $(".formSearch").attr('action');
	        var dataLogin = {
	            query: $(".query").val(),
	            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
	        };

	        $.ajax({
	            type: "POST",
	            url: formAction,
	            data: dataLogin,
	            dataType: 'json',
	            success: function(data) {
	                
	                $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);

	                if (data.result == 1) {
	                    window.location.href = "<?= base_url();?>" + data.url;
	                } else {
	                    alert(data.msg);
	                }
	            }
	        });
	        return false;
	    });
	    $(".formSearchLeft").on('submit', function(e) {
	        e.preventDefault();
	        
	        var formAction = $(".formSearchLeft").attr('action');
	        var dataLogin = {
	            query: $(".query_left").val(),
	            <?= $this->security->get_csrf_token_name();?>: $('input[name="<?= $this->security->get_csrf_token_name();?>"]').attr('value')
	        };

	        $.ajax({
	            type: "POST",
	            url: formAction,
	            data: dataLogin,
	            dataType: 'json',
	            success: function(data) {
	                
	                $('input[name="<?= $this->security->get_csrf_token_name();?>"]').val(data.token);

	                if (data.result == 1) {
	                    window.location.href = "<?= base_url();?>" + data.url;
	                } else {
	                    alert(data.msg);
	                }
	            }
	        });
	        return false;
	    });
		</script>
	</body>
</html>
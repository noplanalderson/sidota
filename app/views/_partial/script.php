<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

		<!-- js -->
		<?= js('core.min') ?>

		<?= js('root-fw.min') ?>

		<?= js('azia') ?>

		<?= js('page_js/search') ?>

		<?php $this->_CI->load_js_plugin() ?>
		
		<?php $this->_CI->load_js() ?>
		
		<script src="https://unpkg.com/sweetalert2@7.24.1/dist/sweetalert2.js"></script>

		<?= $custom_js; ?>

	</body>
</html>
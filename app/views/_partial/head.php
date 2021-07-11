<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Sistem Dokumentasi Data Center">
    <meta name="author" content="debu_semesta">
    <meta name="X-CSRF-TOKEN" content="<?= $this->security->get_csrf_hash();?>">
    
    <base href="<?= base_url() ?>">
    
		<title><?= $title ?></title>

		<!-- App favicon -->
		<?= show_image('sites/'.$this->app->app_icon, 'icon', 'rel="icon" type="image/png" sizes="16x16"') ?>

		<!-- Core -->
		<?= css('azia2') ?>

		<?= css('inject') ?>
			
		<?php $this->_CI->load_css() ?>
		
		<?php $this->_CI->load_css_plugin() ?>

		<link href="https://unpkg.com/sweetalert2@7.24.1/dist/sweetalert2.css" rel="stylesheet">

		<style nonce="<?= NONCE ?>">
			body {
				background : url('<?= backgrounds() ?>');
				background-repeat: no-repeat;
			  background-size: cover;
			}

			.swal2-popup {
			    display: none;
			    position: relative;
			    flex-direction: column;
			    justify-content: center;
			    width: 32em;
			    max-width: 100%;
			    padding: 1.25em;
			    border-radius: 0.3125em;
			    background: #3a3a3a;
			    font-family: inherit;
			    font-size: 1rem;
			    box-sizing: border-box;
			}

			.swal2-popup #swal2-content {
			    text-align: center;
			    color: #fff;
			}

			.swal2-popup #swal2-title {
			    text-align: center;
			    color: #fff;
			}
		</style>
</head>
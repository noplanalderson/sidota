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
    
    <base href="<?= base_url() ?>">
    
		<title><?= $title ?></title>

		<!-- App favicon -->
		<?= show_image('sites/'.$this->app->app_icon, 'icon', 'rel="icon" type="image/png" sizes="16x16"') ?>
		
		<!-- Core -->
		<?= css('azia2') ?>

		<?php $this->_CI->load_css() ?>
		
		<?php $this->_CI->load_css_plugin() ?>

		<!-- Custom Theme files -->
		<link href="<?= site_url('_/css/login.css');?>" rel="stylesheet" type="text/css" media="all" />
		<!-- //Custom Theme files -->

		<style nonce="<?= NONCE; ?>">
			.login-main{
			    background-image: url('<?= login_backgrounds() ?>');
			    background-repeat: repeat-x;
			    animation: slideleft 20000s infinite linear;
			    -webkit-animation: slideleft 20000s infinite linear;
			    background-size: cover;
				-webkit-background-size:cover;
				-moz-background-size:cover; 
			    background-attachment: fixed;
			    position: relative;
				min-height: 100vh;
			}
		</style>
		<!-- web font -->
		<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
		<!-- //web font -->

</head>
<body>

<!-- main -->
<div class="login-main"> 
	<div class="bg-layer">
		<h3>&nbsp;</h3>
		<div id="msg_form" class="alert">
        <p class="msg_form"></p>
    </div>
		<div class="header-main">
			<div class="main-icon">
				<?= show_image('sites/'.$this->app->app_logo_login, 'image', 'alt="Logo" class="logo-login"')?>
			</div>
			<div class="header-left-bottom">
				<?= form_open('login/auth', 'id="formLogin" method="post" accept-charset="utf-8"');?>
					<div class="form-group mt-2">
		  				<input type="text" id="user_name" name="user_name" class="form-control" placeholder="Username" autofocus autocomplete="off" autocapitalize="none" autocorrect="off" required="required">
		  			</div>
		  			<div class="form-group">
		  				<input type="password" id="user_password" name="user_password" class="form-control" placeholder="**********" required="required" autocapitalize="none" autocorrect="off" autocomplete="off">
		  			</div>
					<div class="bottom">
						<button type="submit" id="submitLogin" name="submit" class="btn btn-primary pd-x-30 rounded float-right">Login</button>
					</div>
					<div class="links">
						<p><a href="<?= base_url('forgot-password');?>">Forgot Password?</a></p>
						<p class="right"><a href="#">Version : <?= APP_VERSION ?></a></p>
						<div class="clear"></div>
					</div>
				</form>	
			</div>
		</div>
		
		<!-- copyright -->
		<div class="copyright">
			<p class="font-weight-light"><?= $this->app->footer_text;?><br/>Copyright &copy; <?= date('Y');?></p>
		</div>
		<!-- //copyright --> 
	</div>
</div>
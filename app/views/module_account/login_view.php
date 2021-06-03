  <body class="az-body bg-login">
    <div class="row">
      <div class="col-md-3 mg-t-10 msg_login">
        <div id="msg_form" class="alert d-none">
            <p class="msg_form"></p>
        </div>
      </div>
    </div>
    <div class="az-signin-wrapper">
      <div class="az-card-signin ht-xs-500">

        <!-- az-signin-header -->
        <div class="az-signin-header">
          <?= show_image('sites/'.$this->app->app_logo_login, 'image', 'alt="Logo" class="logo-login"')?>
        </div>
        
  			<?= form_open('login/auth', 'id="formLogin" method="post" accept-charset="utf-8"');?>

  			<div class="form-group mt-2">
  				<input type="text" id="user_name" name="user_name" class="form-control" placeholder="Username" autofocus autocomplete="off" autocapitalize="none" autocorrect="off" required="required">
  			</div>
  			<div class="form-group">
  				<input type="password" id="user_password" name="user_password" class="form-control" placeholder="**********" required="required" autocapitalize="none" autocorrect="off" autocomplete="off">
  			</div>
  			<div class="row text-right mb-2">
  				<div class="col-sm-12">
  					<small class="text-black mr-2">Version : <?= APP_VERSION ?></small>
  				</div>
  			</div>
    			
        <!-- button-group -->
        <button type="submit" id="submitLogin" name="login" class="btn btn-primary pd-x-30 rounded float-right">Login</button>
        <a href="<?= base_url('forgot-password');?>" class="btn btn-dark rounded">Forgot Password?</a>
        </form>
        
        <div class="az-signin-footer">
          <small class="text-dark position-relative mt-1 font-weight-normal"><?= $this->app->footer_text;?><br/>Copyright &copy; <?= date('Y');?></small>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->
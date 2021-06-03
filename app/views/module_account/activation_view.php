  <body class="az-body bg-login">
    <div class="row">
      <div class="col-md-3 mg-t-10 msg_login">
        <div id="msg_active" class="alert d-none">
            <p class="msg_active"></p>
        </div>
      </div>
    </div>
    <div class="az-signin-wrapper">
      <div class="az-card-signin ht-xs-600">

        <!-- az-signin-header -->
        <div class="az-signin-header">
          <?= show_image('sites/'.$this->app->app_logo_login, 'image', 'alt="Logo" class="logo-login"')?>
        </div>
        
  			<?= form_open('do-activation', 'id="formActivation" method="post" accept-charset="utf-8"');?>
  			<input type="hidden" id="user_token" name="user_token" value="<?= $user_token; ?>">
  			<div class="form-group">
  				<label for="user_password">Set Password</label>
  				<input type="password" id="user_password" name="user_password" class="form-control" placeholder="**********" required="required" autocapitalize="none" autocorrect="off" autocomplete="off">
  				<small class="text-danger">Password must contain Uppercase, Lowercase, Numeric, and Symbol min. 8 characters.</small>
  			</div>
  			<div class="form-group">
  				<label for="repeat_password">Set Password</label>
  				<input type="password" id="repeat_password" name="repeat_password" class="form-control" placeholder="**********" required="required" autocapitalize="none" autocorrect="off" autocomplete="off">
  			</div>
  			<div class="row text-right mb-2">
  				<div class="col-sm-12">
  					<small class="text-black mr-2">Version : <?= APP_VERSION ?></small>
  				</div>
  			</div>
    			
        <!-- button-group -->
        <button type="submit" id="submitPassword" name="login" class="btn btn-primary pd-x-30 rounded float-right">Login</button>
        <a href="<?= base_url('forgot-password');?>" class="btn btn-dark rounded">Forgot Password?</a>
        </form>
        
        <div class="az-signin-footer">
          <small class="text-dark position-relative mt-1 font-weight-normal"><?= $this->app->footer_text;?><br/>Copyright &copy; <?= date('Y');?></small>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->
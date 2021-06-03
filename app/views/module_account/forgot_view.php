  <body class="az-body bg-login">
    <div class="row">
      <div class="col-md-3 mg-t-10 msg_login">
        <div id="msg_forgot" class="alert d-none">
            <p class="msg_forgot"></p>
        </div>
      </div>
    </div>
    <div class="az-signin-wrapper">
      <div class="az-card-signin ht-xs-500">

        <!-- az-signin-header -->
        <div class="az-signin-header">
          <?= show_image('sites/'.$this->app->app_logo_login, 'image', 'alt="Logo" class="logo-login"')?>
        </div>
        
  			<?= form_open('forgot-password/submit', 'id="formForgot" method="post" accept-charset="utf-8"');?>

  			<div class="form-group mt-2">
  				<input type="email" id="user_email" name="user_email" class="form-control" placeholder="youremail@somewhere.domain" autofocus autocomplete="off" autocapitalize="none" autocorrect="off" required="required">
  			</div>
  			<div class="row text-right mb-2">
  				<div class="col-sm-12">
  					<small class="text-black mr-2">Version : <?= APP_VERSION ?></small>
  				</div>
  			</div>
    			
        <!-- button-group -->
        <button type="submit" id="submitEmail" name="submit" class="btn btn-primary pd-x-30 rounded float-right">Submit</button>
        <a href="<?= base_url('login');?>" class="btn btn-dark rounded">Try Login?</a>
        </form>
        
        <div class="az-signin-footer">
          <small class="text-dark position-relative mt-1 font-weight-normal"><?= $this->app->footer_text;?><br/>Copyright &copy; <?= date('Y');?></small>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->
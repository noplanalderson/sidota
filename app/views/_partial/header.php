<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

  <body class="az-dashboard">
    <div class="az-header">
      	<div class="container bg-dark p-3">
        	<div class="az-header-left text-white-50">
        		<?= show_image('sites/'.$this->app->app_logo, 'image', 'alt="App Logo" class="logo-db az-logo"') ?>
            
         		<a href="" id="azNavShow" class="az-header-menu-icon d-lg-none text-white-50"><i class="icon ion-md-list"></i></a>
        	</div>

		<!-- az-header-left -->
        <div class="az-header-center">
          <?php if(!empty($this->app_m->getContentMenu('search-result'))) :?>
          <?= form_open('search', 'class="formSearch" method="post" accept-charset="utf-8"');?>
            <input type="text" name="query" class="form-control bg-dark text-white query rounded" pattern="([A-z0-9À-ž\s]){2,}" placeholder="Search activities or jobs..." title="Only alphanumeric and Space Allowed" required>
            <button type="submit" name="submit" class="btn"><i class="fas fa-search text-white-50"></i></button>
          </form>
          <?php endif;?>
        </div>

        <!-- az-header-center -->
        <div class="az-header-right float-right">
          <?php if(!empty($this->app_m->getContentMenu('ticket-detail'))) :?>
          <div class="dropdown az-header-notification">
            <a href="#" <?php if($this->unapprove > 0):?>class="new"<?php endif;?>><i class="fas fa-ticket-alt text-white-50"></i></a>
            <div class="dropdown-menu bg-dark text-white rounded">
              <div class="az-dropdown-header mg-b-20 d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back text-white-50"></i></a>
              </div>
              <h6 class="az-notification-title text-white">Ticket</h6>
              <p class="az-notification-text"><?= $this->unapprove; ?> Unapproved Ticket</p>
              <div class="az-notification-list">
                <?php foreach ($this->notif as $notif) :?>

                <div class="media new">
                  <a href="<?= base_url('ticket-detail/'.encrypt($notif->ticket_code));?>" class="text-dark">
                    <div class="media-body">
                      <p class="text-primary"><?= $notif->problem_report;?></p>
                      <span>Created by <?= $notif->employee_name.' &bull; '.$notif->date_report; ?></span>
                    </div>
                    <!-- media-body -->
                  </a>
                </div><!-- media -->
                <?php endforeach;?>
              
              </div>
              <!-- az-notification-list -->
              <div class="dropdown-footer"><a href="<?= base_url('ticket');?>">See all tickets</a></div>
            </div>
            <!-- dropdown-menu -->
          </div>
          <?php endif;?>
          <!-- az-header-notification -->
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="<?= site_url('_/images/users/'.encrypt($this->session->userdata('uid')).'/thumbnail/'.$this->user->employee_picture);?>" alt="<?= $this->user->employee_name;?>"></a>
            <div class="dropdown-menu bg-dark text-white rounded">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back text-white-50"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="<?= site_url('_/images/users/'.encrypt($this->session->userdata('uid')).'/thumbnail/'.$this->user->employee_picture);?>" alt="<?= $this->user->employee_name;?>">
                </div><!-- az-img-user -->
                <h6 class="text-white"><?= $this->user->user_name;?></h6>
                <span class="text-center"><?= ucwords($this->user->jobdesc_name).' '.$this->user->jobdesc_series;?></span>
              </div><!-- az-header-profile -->

              <a href="<?= base_url('edit-profile');?>" class="dropdown-item text-white"><i class="fa fa-user"></i> Change Profile</a>
              <a href="<?= base_url('change-password');?>" class="dropdown-item text-white"><i class="fa fa-key"></i> Change Password</a>
              <a href="<?= base_url('logout');?>" class="dropdown-item text-white"><i class="fa fa-power-off"></i> Logout</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->
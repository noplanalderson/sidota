<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-profile mt-3 mb-5">
      <div class="container mn-ht-100p">
        <div class="az-content-left az-content-left-profile pd-30 text-white bg-dark rounded">

          <div class="az-profile-overview">
            <div class="az-img-user">
              <img src="<?= site_url('_/images/users/'.encrypt($profile->user_id).'/thumbnail/'.$profile->employee_picture);?>" alt="<?= $profile->employee_name;?>">
            </div><!-- az-img-user -->
            <div class="d-flex justify-content-between mg-b-20">
              <div>
                <h5 class="az-profile-name text-white"><?= $profile->employee_name;?></h5>
                <p class="az-profile-name-text"><?= ucwords($profile->jobdesc_name).' '.$profile->jobdesc_series;?></p>
              </div>
            </div>

            <div class="az-profile-bio text-white">
              <?= ucfirst($profile->employee_bio);?>
            </div><!-- az-profile-bio -->

            <hr class="mg-y-30">

            <label class="az-content-label tx-13 mg-b-20 text-white">Websites &amp; Sosial Media</label>
            <div class="az-profile-social-list">
              <div class="media">
                <div class="media-icon"><i class="icon ion-logo-whatsapp"></i></div>
                <div class="media-body">
                  <span>Phone/Whatsapp</span>
                  <a href="tel:<?= $profile->employee_phone;?>"><?= $profile->employee_phone;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-md-mail"></i></div>
                <div class="media-body">
                  <span>Email</span>
                  <a href="mailto:<?= $profile->user_email;?>"><?= $profile->user_email;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-logo-facebook"></i></div>
                <div class="media-body">
                  <span>Facebook</span>
                  <a href="<?= $profile->facebook;?>" target="_blank"><?= $profile->facebook;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-logo-instagram"></i></div>
                <div class="media-body">
                  <span>Instagram</span>
                  <a href="<?= $profile->instagram;?>" target="_blank"><?= $profile->instagram;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-md-globe"></i></div>
                <div class="media-body">
                  <span>Blog/Website</span>
                  <a href="<?= $profile->website;?>" target="_blank"><?= $profile->website;?></a>
                </div>
              </div><!-- media -->
            </div><!-- az-profile-social-list -->

          </div><!-- az-profile-overview -->

        </div><!-- az-content-left -->
        <div class="az-content-body az-content-body-profile bg-dark pd-20 text-white rounded">
          <nav class="nav az-nav-line">
            <a href="" class="nav-link active ml-2" data-toggle="tab">Employee Bio</a>
          </nav>

          <div class="az-profile-body pd-30">

            <div class="row mg-b-20">
              <div class="col-md-7 col-xl-8">
                <div class="az-profile-view-chart">
                  <canvas id="chartArea"></canvas>
                  <div class="az-profile-view-info">
                    <div class="d-flex align-items-baseline">
                      <h6 class="text-white">Performance</h6>
                    </div>
                    <p>last <?= $this->app->show_month;?> months</p>
                  </div>
                </div>
              </div><!-- col -->
              <div class="col-md-5 col-xl-4 mg-t-40 mg-md-t-0">
                <div class="az-content-label tx-13 mg-b-20 text-white">Top 5 Activity Categories</div>
                  <?php
                  
                  if(empty($categories))
                  {
                    echo "<center>You don't have activity</center>";
                  }

                  foreach ($categories as $category) :?>

                  <div class="az-traffic-detail-item">
                    <div>
                      <?php $percentage = ($category->count / $category->total) * 100;?>

                      <span><?= $category->category_activity;?></span>
                      <span><?= $category->count;?> <span>(<?= round($percentage, 0);?>%)</span></span>
                    </div>
                    <progress class="w-100 random-color" value="<?= round($percentage, 0);?>" min="0" max="100"></progress>
                    <!-- progress -->
                  </div>
                  <?php endforeach;?>
              </div><!-- col -->
            </div><!-- row -->

            <hr class="mg-y-40">

            <div class="row">
              <div class="col-md-12 col-xl-8">
                <div class="az-content-label tx-13 mg-b-25 text-white">Place, DoB & Address</div>
                <div class="az-profile-work-list">
                  <div class="media">
                    <div class="media-logo bg-success"><i class="icon ion-md-calendar"></i></div>
                    <div class="media-body">
                      <h6 class="text-white">Place - Date of Birth</h6>
                      <span><?= $profile->employee_place_ob;?>, <?=  $profile->employee_date_ob;?></span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="media">
                    <div class="media-logo bg-primary"><i class="icon ion-md-locate"></i></div>
                    <div class="media-body">
                      <h6 class="text-white">Address</h6>
                      <span><?= $profile->employee_address;?></span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                </div><!-- az-profile-work-list -->
              </div><!-- col -->
            </div><!-- row -->

            <div class="mg-b-20"></div>

          </div><!-- az-profile-body -->
        </div><!-- az-content-body -->
      </div><!-- container -->
    </div><!-- az-content -->

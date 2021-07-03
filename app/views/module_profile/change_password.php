<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-profile">
      <div class="container mn-ht-100p">
        <div class="az-content-left az-content-left-profile bg-dark pd-20 text-white">

          <div class="az-profile-overview bg-dark">
            <div class="az-img-user">
              <img id="employee_picture" src="<?= site_url('./_/images/users/'.encrypt($this->session->userdata('uid')).'/'.$employee->employee_picture);?>" alt="<?= $employee->employee_name;?>">
            </div><!-- az-img-user -->
            <div class="d-flex justify-content-between mg-b-20">
              <div>
                <h5 class="az-profile-name text-white"><?= $employee->employee_name;?></h5>
                <p class="az-profile-name-text text-white"><?= ucwords($employee->jobdesc_name).' '.$employee->jobdesc_series;?></p>
              </div>
            </div>

            <div class="az-profile-bio text-white">
              <?= ucfirst($employee->employee_bio);?>
            </div><!-- az-profile-bio -->

            <hr class="mg-y-30">

            <label class="az-content-label tx-13 mg-b-20 text-white">Websites &amp; Social Media</label>
            <div class="az-profile-social-list">
              <div class="media">
                <div class="media-icon"><i class="icon ion-logo-whatsapp"></i></div>
                <div class="media-body">
                  <span>Phone/Whatsapp</span>
                  <a href="tel:<?= $employee->employee_phone;?>" id="employee_phone"><?= $employee->employee_phone;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-md-mail"></i></div>
                <div class="media-body">
                  <span>Email</span>
                  <a href="mailto:<?= $employee->user_email;?>" id="user_email"><?= $employee->user_email;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-logo-facebook"></i></div>
                <div class="media-body">
                  <span>Facebook</span>
                  <a href="<?= $employee->facebook;?>" id="facebook" target="_blank"><?= $employee->facebook;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-logo-instagram"></i></div>
                <div class="media-body">
                  <span>Instagram</span>
                  <a href="<?= $employee->instagram;?>" id="instagram" target="_blank"><?= $employee->instagram;?></a>
                </div>
              </div><!-- media -->
              <div class="media">
                <div class="media-icon"><i class="icon ion-md-globe"></i></div>
                <div class="media-body">
                  <span>Blog/Website</span>
                  <a href="<?= $employee->website;?>" id="website" target="_blank"><?= $employee->website;?></a>
                </div>
              </div><!-- media -->
            </div><!-- az-profile-social-list -->

          </div><!-- az-profile-overview -->

        </div><!-- az-content-left -->
        <div class="az-content-body az-content-body-profile bg-dark pd-20 text-white">
          <nav class="nav az-nav-line">
            <a href="" class="nav-link active text-white" data-toggle="tab">Password Setting</a>
          </nav>

          <div class="az-profile-body">

            <div class="row mg-b-20">
              <div class="col-md-12 col-xl-12">
                <div id="message" class="alert d-none">
                  <small class="message"></small>
                </div>
                <div class="az-profile-work-list">
                  <?= form_open('submit-password', 'id="passwordForm" method="post"');?>

                    <div class="">
                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Password *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input id="user_password" type="password" name="user_password" 
                                  class="form-control" 
                                  placeholder="*********"
                                  pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[.!@$%?/~_]).{8,20}$" 
                                  title="Password must contain uppercase, lowercase, numeric, and symbol 8-20 characters" required="required" autocomplete="off">
                          <small class="text-danger">Password must contain uppercase, lowercase, numeric, and symbol 8-20 characters.</small>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Repeat Password *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input id="user_password2" type="password" name="user_password2" 
                                  class="form-control" 
                                  placeholder="*********" 
                                  required="required" autocomplete="off">
                        </div><!-- col -->
                      </div><!-- row -->
                      <button type="submit" name="submit" class="btn btn-az-primary pd-x-30 mg-r-5">Submit</button>
                      <button type="reset" class="btn btn-secondary pd-x-30">Reset</button>
                    </div>
                  </form>
                </div><!-- az-profile-work-list -->
              </div><!-- col -->
            </div><!-- row -->

            <div class="mg-b-20"></div>

          </div><!-- az-profile-body -->
        </div><!-- az-content-body -->
      </div><!-- container -->
    </div><!-- az-content -->
<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-profile mt-3 mb-5">
      <div class="container mn-ht-100p">
        <div class="az-content-left az-content-left-profile bg-dark pd-20 text-white rounded">

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
        <div class="az-content-body az-content-body-profile bg-dark pd-20 text-white rounded">
          <nav class="nav az-nav-line">
            <a href="" class="nav-link active" data-toggle="tab">Profile Setting</a>
          </nav>

          <div class="az-profile-body">

            <div class="row mg-b-20">
              <div class="col-md-12 col-xl-12">
                <div class="az-profile-work-list">
                  <?= form_open('change-profile', 'id="accountForm" method="post"');?>

                    <div class="">
                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="text-white form-label mg-b-0">Employee Name</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="text" name="employee_name" class="form-control bg-dark text-white" value="<?= $employee->employee_name;?>" readonly>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="text-white form-label mg-b-0">Username *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="text" name="user_name" class="form-control bg-dark text-white" placeholder="Username"  value="<?= $employee->user_name;?>" required>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label text-white mg-b-0">Place of Birth *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="text" name="employee_place_ob" class="form-control bg-dark text-white" placeholder="Place of Birth" value="<?= $employee->employee_place_ob;?>" required>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Tanggal Lahir *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-calendar tx-24 lh--9 op-6"></i>
                              </div>
                            </div>
                            <input type="date" name="employee_date_ob" class="form-control bg-dark text-white" data-parsley-errors-container="#slError" placeholder="YYYY-MM-DD" value="<?= $employee->employee_date_ob;?>" required>
                          </div>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Employee Address *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <textarea rows="3" name="employee_address" class="form-control bg-dark text-white" placeholder="Employee Address" required><?= $employee->employee_address;?></textarea>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Employee Bio</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <textarea rows="3" name="employee_bio" class="form-control bg-dark text-white" placeholder="Employee Bio" required><?= $employee->employee_bio;?></textarea>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Phone *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="text" min-length="[9]" max-length="[14]" name="employee_phone" class="form-control bg-dark text-white" placeholder="Phone" value="<?= $employee->employee_phone;?>" required>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Email *</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="email" name="user_email" class="form-control bg-dark text-white" placeholder="you@somewhere.com" value="<?= $employee->user_email;?>" required>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Facebook</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="url" name="facebook" class="form-control bg-dark text-white" placeholder="https://facebook.com/yourprofile" value="<?= $employee->facebook;?>">
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Instagram</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="url" name="instagram" class="form-control bg-dark text-white" placeholder="https://instagram.com/youraccount" value="<?= $employee->instagram;?>">
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Website</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <input type="url" name="website" class="form-control bg-dark text-white" placeholder="https://website.com/" value="<?= $employee->website;?>">
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                          <label class="form-label mg-b-0 text-white">Profile Picture</label>
                        </div><!-- col -->
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                          <div class="file-loading">
                              <input name="picture" type="file" class="picture_upload"
                              data-allowed-file-extensions='["jpg","jpeg","png","webp"]' />
                          </div>
                          <small class="text-danger font-weight-normal">Max. Size 5 MB</small>
                        </div><!-- col -->
                      </div><!-- row -->
                      <button type="submit" name="submit" class="btn btn-az-primary pd-x-30 mg-r-5">Submit</button>
                      <button type="reset" class="btn btn-dark pd-x-30">Reset</button>
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

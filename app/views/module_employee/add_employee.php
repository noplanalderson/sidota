<?php defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-3">ADD EMPLOYEE</h6>
            </div>
            <div class="card-body pd-sm-40 bg-dark-200">
              <?= form_open('submit-employee', 'id="employeeForm" method="post"');?>

                <div class="">
                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Employee Name</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="text" name="employee_name" class="form-control bg-dark text-white" placeholder="Employee Name" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Username *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="text" name="user_name" class="form-control bg-dark text-white" placeholder="Username" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Jobdesc *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <div id="jobdesc" class="parsley-select">
                        <select class="form-control bg-dark text-white jobdesc w-100" data-placeholder="Choose Jobdesc"  data-parsley-errors-container="#slErrorJobdesc" name="jobdesc_id" required>
                          <option value="">Choose Jobdesc</option>
                          <?php foreach ($jobdescs as $jobdesc) :?>

                          <option value="<?= $jobdesc->jobdesc_id;?>">
                            <?= strtoupper($jobdesc->jobdesc_name);?></option>
                          <?php endforeach;?>

                        </select>
                        <div id="slErrorJobdesc"></div>
                      </div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Place of Birth *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="text" name="employee_place_ob" class="form-control bg-dark text-white" placeholder="Place of Birth" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Date of Birth *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-calendar tx-24 lh--9 op-6"></i>
                          </div>
                        </div>
                        <input type="date" name="employee_date_ob" class="form-control bg-dark text-white" data-parsley-errors-container="#slError" placeholder="YYYY-MM-DD" required>
                      </div>
                      <div id="slError"></div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Employee Address *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <textarea rows="3" name="employee_address" class="form-control bg-dark text-white" required></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Employee Bio</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <textarea rows="3" name="employee_bio" class="form-control bg-dark text-white"></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Phone *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="text" name="employee_phone" class="form-control bg-dark text-white" placeholder="Employee Phone" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Email *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="email" name="user_email" class="form-control bg-dark text-white" placeholder="you@somewhere.com" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Facebook</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="url" name="facebook" class="form-control bg-dark text-white" placeholder="https://facebook.com/yourprofile">
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Instagram</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="url" name="instagram" class="form-control bg-dark text-white" placeholder="https://instagram.com/youraccount">
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label text-white mg-b-0">Website</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="url" name="website" class="form-control bg-dark text-white" placeholder="https://website.com/">
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20 text-right">
                    <div class="col-md-12">
                      <button type="reset" class="btn btn-dark pd-x-30">Reset</button>
                      <button type="submit" name="submit" class="btn btn-az-primary pd-x-30 mg-r-5">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div id="message" class="alert d-none">
              <small class="message"></small>
          </div>
          <div class="card card-table-two">
            <div class="card-header">
              <h6 class="card-title mt-3">EDIT EMPLOYEE</h6>
            </div>
            <div class="card-body pd-sm-40 bg-gray-200">
              <?= form_open('do-edit-employee', 'id="employeeForm" method="post"');?>

                <div class="">
                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label mg-b-0">Employee Name</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee_id; ?>">
                      <input type="text" name="employee_name" class="form-control" placeholder="Employee Name" value="<?= $employee->employee_name ?>" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label mg-b-0">Jobdesc *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <div id="jobdesc" class="parsley-select">
                        <select class="form-control jobdesc w-100" data-placeholder="Choose Jobdesc"  data-parsley-errors-container="#slErrorJobdesc" name="jobdesc_id" required>
                          <option value="">Choose Jobdesc</option>
                          <?php foreach ($jobdescs as $jobdesc) :?>

                          <option value="<?= $jobdesc->jobdesc_id;?>" <?php if($jobdesc->jobdesc_id === $employee->jobdesc_id): ?>selected="selected"<?php endif;?>>
                            <?= strtoupper($jobdesc->jobdesc_name);?></option>
                          <?php endforeach;?>

                        </select>
                        <div id="slErrorJobdesc"></div>
                      </div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label mg-b-0">Jobdesc Series *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="number" min="1" name="jobdesc_series" class="form-control" placeholder="0" value="<?= $employee->jobdesc_series ?>" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label mg-b-0">Email *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="email" name="user_email" class="form-control" placeholder="you@somewhere.com" value="<?= $employee->user_email ?>" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-4">
                      <label class="form-label mg-b-0">Status</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <div class="form-group mg-b-20">
                        <label class="ckbox">
                          <input type="checkbox" id="is_active" name="is_active" value="1" <?php if($employee->is_active == 1) : ?>checked <?php endif;?>><span class="mb-2">Active</span>
                        </label>
                      </div>
                    </div>
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
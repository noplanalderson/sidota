    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-3">ADD REPORT</h6>
            </div>
            <div class="card-body bg-dark-200">
              <?= form_open_multipart('submit-report', 'id="activityForm" method="post"');?>

                <input type="hidden" id="ticket_code" name="ticket_code" value="">
                <div class="">
                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">PIC *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input type="text" name="pic" class="form-control bg-dark text-white" value="<?= $this->user->employee_name;?>" disabled>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Date *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-calendar-alt tx-24 lh--9 op-6"></i>
                          </div>
                        </div>
                        <input type="text" id="date_activity" name="date_activity" class="form-control bg-dark text-white fc-datepicker" data-parsley-errors-container="#slError" placeholder="YYYY-MM-DD" value="" required>
                      </div>
                      <div id="slError"></div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Location *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input type="text" id="location" name="location" class="form-control bg-dark text-white" placeholder="Location" value="" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Location Address</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <textarea rows="3" id="location_address" name="location_address" class="form-control bg-dark text-white" placeholder="Location Address"></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Activity Category *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <div id="slWrapper" class="parsley-select">
                        <select id="category_activity_id" class="form-control bg-dark text-white select2 w-100" data-placeholder="Choose Category" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" name="category_activity_id" required>
                          <option label="Choose one"></option>
                          <?php foreach ($categories as $category) :?>

                          <option value="<?= $category->category_activity_id;?>"><?= $category->category_activity;?></option>
                          <?php endforeach;?>

                        </select>
                        <div id="slErrorContainer"></div>
                      </div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Shift *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <select id="shift" class="form-control bg-dark text-white" data-placeholder="Choose Shift" name="shift" required>
                        <option value="">-Choose Shift-</option>
                        <option value="pagi">Pagi</option>
                        <option value="siang">Siang</option>
                        <option value="malam">Malam</option>
                        <option value="wfh">WFH</option>
                      </select>
                    </div>
                  </div><!-- col -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Used Tools *</label>
                      <a id="add" class="btn btn-sm btn-primary mg-t-10 text-white">Add Form</a>
                    </div><!-- col -->
                    <!-- <div> -->
                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-6 mg-t-5 mg-md-t-0">
                          <input type="text" name="tool[]" class="form-control bg-dark text-white" placeholder="Tool" value="">
                        </div>
                        <div class="col-md-6 mg-t-5 mg-md-t-0">
                          <input type="text" name="tool_owner[]" class="form-control bg-dark text-white" placeholder="Tool Owner" value="">
                        </div>
                      </div>
                      <div id="field" class="mg-t-20"></div>
                      <!-- </span> -->
                    </div>
                  </div><!-- col -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Activity *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <textarea rows="3" id="activity" name="activity" class="form-control bg-dark text-white" placeholder="Activity Report" required></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Indication/Problem</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <textarea rows="3" id="problem" name="problem" class="form-control bg-dark text-white" placeholder="Problem(s)"></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Action (Separate by Comma to create action list)</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input id="action" name="action" class="form-control bg-dark text-white" placeholder="Action(s)" value="">
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Activity Result (Separate by Comma to create result list)*</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input id="result_activity" name="result_activity" class="form-control bg-dark text-white" placeholder="Result" value="" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Status *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <select id="status" class="form-control bg-dark text-white" data-placeholder="Choose Status" name="status" required>
                        <option value="">-Choose Status-</option>
                        <option value="finished">Finished</option>
                        <option value="pending">Pending</option>
                        <option value="on-progress">On Progress</option>
                      </select>
                  </div><!-- col -->
                </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20 item form-group">
                    <div class="col-md-3">
                      <label class="control-label mg-b-0" for="note">Documentation(s)</label>
                    </div>
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <div class="file-loading">
                          <input id="pictures" name="files[]" type="file" class="picture_upload"
                          data-allowed-file-extensions='["jpg","jpeg","png","webp"]' multiple="" />
                      </div>
                      <small class="text-danger font-weight-normal">Max. Size 5 MB/Picture</small>
                    </div>
                  </div><!-- row -->
                  <button type="submit" name="submit" class="btn btn-az-primary pd-x-30 mg-r-5">Submit</button>
                  <button type="reset" class="btn btn-dark pd-x-30">Reset</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
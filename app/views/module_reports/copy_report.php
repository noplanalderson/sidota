<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
    <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="row mg-b-20">
            <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
              <div id="message" class="alert d-none">
                  <small class="message"></small>
              </div>
              <div class="card card-table-two">
                <div class="card-header">
                  <h6 class="card-title mt-3"><?= $card_title ?></h6>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 pd-30 pd-sm-40 bg-gray-200">

                    <?php 
                    if($this->uri->segment(1) == 'edit-report') : 

                      echo form_open('edit-submit', 'id="activityForm" method="post"');
                      
                      else :
                    
                      echo form_open_multipart('submit-report', 'id="activityForm" method="post"');
                    endif;
                    ?>

                    <input type="hidden" id="ticket_code" name="ticket_code" value="">
                    
                    <input type="hidden" id="activity_id" name="activity_id" value="<?= encrypt($report->activity_id);?>">
                    <div class="">
                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">PIC *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <input type="text" name="pic" class="form-control" value="<?= $this->user->employee_name;?>" disabled>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Date *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-calendar tx-24 lh--9 op-6"></i>
                              </div>
                            </div>
                            <input type="text" id="date_activity" name="date_activity" class="form-control fc-datepicker" data-parsley-errors-container="#slError" value="<?= $report->date_activity;?>" placeholder="YYYY-MM-DD" required>
                          </div>
                          <div id="slError"></div>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Location *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <input type="text" id="location" name="location" class="form-control" value="<?= $report->location;?>" placeholder="Location" >
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Location Address</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <textarea id="location_address" rows="3" name="location_address" class="form-control" value="<?= $report->location_address;?>" placeholder="Location Address"></textarea>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Activity Category *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <div id="slWrapper" class="parsley-select">
                            <select id="category_activity_id" class="form-control select2 w-100" data-placeholder="Choose Category" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" name="category_activity_id" required>
                              <option label="Choose one"></option>
                              <?php foreach ($categories as $category) :?>

                              <option value="<?= $category->category_activity_id;?>" <?php if($report->category_activity_id == $category->category_activity_id) : ?>selected="selected"<?php endif;?>>
                                <?= $category->category_activity;?></option>
                              <?php endforeach;?>

                            </select>
                            <div id="slErrorContainer"></div>
                          </div>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Shift *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <select id="shift" class="form-control" data-placeholder="Choose Shift" name="shift" required>
                            <option value="">-Choose Shift-</option>
                            <option value="pagi" <?php if($report->shift == 'pagi') :?>selected="selected"<?php endif;?>>Pagi</option>
                            <option value="siang" <?php if($report->shift == 'siang') :?>selected="selected"<?php endif;?>>Siang</option>
                            <option value="malam" <?php if($report->shift == 'malam') :?>selected="selected"<?php endif;?>>Malam</option>
                            <option value="wfh" <?php if($report->shift == 'wfh') :?>selected="selected"<?php endif;?>>WFH</option>
                          </select>
                        </div>
                      </div><!-- col -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Used Tool *</label>
                          <a id="add" class="btn btn-sm btn-primary mg-t-10 text-white">Add Tool</a>
                        </div><!-- col -->
                        <!-- <div> -->
                        <div class="col-md-9">
                          <div id="field" class="mg-t-20">
                            <?php 
                              $count = count($tools);
                              if($count > 0) {
                              foreach ($tools as $tool) :
                            ?>
                              <div class="row added <?= encrypt($tool->tool_id) ?> mg-t-20">
                                <div class="col-md-4 mg-t-5 mg-md-t-0">
                                  <input type="text" id="tool-1" name="tool[]" class="form-control" placeholder="Used Tool" value="<?= $tool->tool;?>">
                                </div>
                                <div class="col-md-4 mg-t-5 mg-md-t-0">
                                  <input type="text" id="owner-1" name="tool_owner[]" class="form-control" placeholder="Tool Owner" value="<?= $tool->tool_owner;?>">
                                </div>
                                <a href="#" data-id="<?= encrypt($tool->tool_id) ?>" class="remove_tool"><i class="fas fa-times-circle"></i></a>
                              </div>
                              <small id="tool_msg" class="text-success"></small>
                            <?php endforeach;
                              }
                              else
                              {
                            ?>
                            <div class="row added mg-t-20">
                              <div class="col-md-4 mg-t-5 mg-md-t-0">
                                <input type="text" id="tool-1" name="tool[]" class="form-control" placeholder="Used Tool" value="">
                              </div>
                              <div class="col-md-4 mg-t-5 mg-md-t-0">
                                <input type="text" id="owner-1" name="tool_owner[]" class="form-control" placeholder="Tool Owner" value="">
                              </div>
                              <a href="#" class="remove_field"><i class="fas fa-times-circle"></i></a>
                            </div>
                            <?php } ?>
                          </div>
                          <!-- </span> -->
                        </div>
                      </div><!-- col -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Activity *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <textarea id="activity" rows="3" name="activity" class="form-control" placeholder="Activity Report" required><?= $report->activity;?></textarea>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Indication/Problem</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <textarea id="problem" rows="3" name="problem" class="form-control" placeholder="Problem"><?= $report->problem;?></textarea>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Action(s) (Separate by comma to create action lists)</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <input id="action" name="action" class="form-control" placeholder="Action Lists" value="<?= $report->action;?>">
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Activity Result (Separate by comma to create result lists)*</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <input id="result" name="result_activity" class="form-control" placeholder="Activity Result" value="<?= $report->result_activity;?>" required>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-3">
                          <label class="form-label mg-b-0">Status *</label>
                        </div><!-- col -->
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <select id="status" class="form-control" data-placeholder="Choose Status" name="status" required>
                            <option value="">-Choose Status-</option>
                            <option value="finished" <?php if($report->status == 'finished') :?>selected="selected"<?php endif;?>>Finished</option>
                            <option value="pending" <?php if($report->status == 'pending') :?>selected="selected"<?php endif;?>>Pending</option>
                            <option value="on-progress" <?php if($report->status == 'on-progress') :?>selected="selected"<?php endif;?>>On Progress</option>
                          </select>
                        </div><!-- col -->
                      </div><!-- row -->

                      <div class="row row-xs align-items-center mg-b-20 item form-group">
                        <div class="col-md-3">
                          <label class="control-label mg-b-0" for="note">Documentation</label>
                        </div>
                        <div class="col-md-9 mg-t-5 mg-md-t-0">
                          <div class="file-loading">
                              <input name="files[]" type="file" class="picture_upload"
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
      </div>
    </div>
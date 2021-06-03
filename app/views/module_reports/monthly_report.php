<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="row mg-b-20">
            <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
              <div id="delete_msg" class="alert d-none">
                  <small class="delete_msg"></small>
              </div>
              <div class="card card-table-two">
                <div class="card-header">
                  <h4><?= $employee->employee_name; ?></h4>
                  <h6 class="card-title"><?= ucwords($employee->jobdesc_name).' '.$employee->jobdesc_series;?></h6>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive mt-3">
                  <table id="reports" class="table table-striped table-bordered">
                    <thead class="text-center">
                      <tr>
                        <th>Date</th>
                        <th>Shift</th>
                        <th>Location</th>
                        <th>Category</th>
                        <th>Activity</th>
                        <th>Problem</th>
                        <th>Action</th>
                        <th>Result</th>
                        <th width="140px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($reports as $report) :?>

                      <tr>
                        <td><?= date('d F Y', strtotime($report->date_activity));?></td>
                        <td><?= strtoupper($report->shift);?></td>
                        <td><?= $report->location;?></td>
                        <td><?= $report->category_activity;?></td>
                        <td><?= $report->activity;?></td>
                        <td><?= $report->problem;?></td>
                        <td><?= $report->action;?></td>
                        <td><?= $report->result_activity;?></td>
                        <td>
                          <?= button($btn_copy, FALSE, 'a', 'href="'.base_url('copy-report/' . encrypt($report->activity_id)).'" class="btn-sm btn-success"');?>

                          <?php if($this->session->userdata('uid') == $report->employee_id) :?>

                            <?= button($btn_edit, FALSE, 'a', 'href="'.base_url('edit-report/'.encrypt($report->activity_id)).'" class="btn-sm btn-primary"');?>
                            
                            <?= button($btn_detail, FALSE, 'a', 'href="'.base_url('report-detail/' . encrypt($report->activity_id)).'" class="btn-sm btn-secondary"');?>

                            <?= button($btn_delete, FALSE, 'a', 'class="delete-btn btn-sm btn-danger text-white" data-id="'.encrypt($report->activity_id).'"');?>

                          <?php endif;?>
                        </td>
                      </tr>
                      <?php endforeach;?>

                    </tbody>
                  </table>
                </div>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
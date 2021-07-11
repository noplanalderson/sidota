<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body overflow-auto overflow-hidden">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-3">ON GOING</h6>
            </div>
            <div class="table-responsive pd-20 mt-3">
              <table id="ongoing" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>PIC</th>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>Result</th>
                    <th class="wd-20p">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($on_goings as $ongoing) :?>

                  <tr>
                    <td><?= $ongoing->employee_name;?></td>
                    <td><?= $ongoing->date_activity;?></td>
                    <td><?= $ongoing->activity;?></td>
                    <td><?= $ongoing->result_activity;?></td>
                    <td>
                      <?= button($btn_detail, FALSE, 'a', 'href="'.base_url('report-detail/'.encrypt($ongoing->activity_id)).'" target="_blank" rel="noopener noreferrer" class="update btn-sm btn-success"');?>
                      <select name="status" data-id="<?= encrypt($ongoing->activity_id) ?>" class="form-control-sm status">
                        <option value="finished" <?php if($ongoing->status == 'finished'): ?>selected=""<?php endif;?>>Finished</option>
                        <option value="on-progress" <?php if($ongoing->status == 'on-progress'): ?>selected=""<?php endif;?>>On Progress</option>
                        <option value="pending" <?php if($ongoing->status == 'pending'): ?>selected=""<?php endif;?>>Pending</option>
                      </select>
                    </td>
                  </tr>
                  <?php endforeach;?>

                </tbody>
              </table>
            </div>
          </div><!-- card -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
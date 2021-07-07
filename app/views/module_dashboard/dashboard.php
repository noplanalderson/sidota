<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title"><?= $this->user->employee_name; ?></h2>
              <p class="az-dashboard-text"><?= ucwords($this->user->jobdesc_name).' '.$this->user->jobdesc_series;?></p>
            </div>
            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Last Login</label>
                  <h6>
                    <?= date('d F Y H:i:s', $this->user->last_login);?>
                    
                  </h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>From</label>
                  <h6><?= $this->user->ip;?></h6>
                </div><!-- media-body -->
              </div><!-- media -->
            </div>
          </div><!-- az-dashboard-one-title -->

          <div class="row row-sm mg-b-20">
            <div class="col-lg-4 col-md-4 col-sm-12 ht-lg-100p">
              <div class="card card-table-two">
                <div class="card-header">
                  <h6 class="card-title mt-3">COMPLETED ACTIVITY BY CATEGORIES</h6>
                </div><!-- card-header -->
                <div class="card-body row">
                  <div class="col-md-12 col-lg-12 mg-lg-l-auto mg-t-20 mg-md-t-0">
                    <?php
                    
                    if(empty($categories))
                    {
                      echo "<center>You don't have activity</center>";
                    }

                    foreach ($categories as $category) :?>

                    <div class="az-traffic-detail-item">
                      <div>
                        <?php $percentage = ($category->hitung / $category->total) * 100;?>

                        <span><?= $category->category_activity;?></span>
                        <span><?= $category->hitung;?> <span>(<?= round($percentage, 0);?>%)</span></span>
                      </div>
                      <progress class="w-100 random-color" value="<?= round($percentage, 0);?>" min="0" max="100"></progress>
                      <!-- progress -->
                    </div>
                    <?php endforeach;?>

                  </div><!-- col -->
                </div><!-- card-body -->
              </div><!-- card-dashboard-four -->
            </div><!-- col -->
            <div class="col-lg-8 col-md-8 col-sm-12 mg-t-20 mg-lg-t-0">
              <div class="row row-sm">
                <div class="col-sm-12">
                  <div class="card card-table-two">
                    <div class="card-header">
                      <h6 class="card-title mt-3">TICKET LOGS</h6>
                    </div><!-- card-header -->
                    <div class="card-body mt-2">                
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Ticket Code</th>
                              <th>Date</th>
                              <th class="wd-45p">Report</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($tickets as $ticket) :?>

                            <tr>
                              <td><strong><a href="<?= base_url('ticket-detail/'.encrypt($ticket->ticket_code));?>"><?= $ticket->ticket_code;?></a></strong></td>
                              <td><?= $ticket->date_report;?></td>
                              <td><?= $ticket->problem_report;?></td>
                              <td><?= $ticket->status;?></td>
                            </tr>
                            <?php endforeach;?>

                          </tbody>
                        </table>
                      </div>
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mg-t-20">
                  <div class="card card-table-two">
                    <div class="card-header">
                      <h6 class="card-title mt-3">PENDING ACTIVITIES ON THIS WEEK</h6>
                      <p class="ongoing-period"><?= date('d F Y', strtotime($yesterday)).' - '.date('d F Y', strtotime($now));?></p>
                    </div>
                    <div class="pd-20 table-responsive mt-3">
                      <table id="ongoing" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>PIC</th>
                            <th>Activity</th>
                            <th>Result</th>
                            <th>Note</th>
                            <th class="wd-15p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($activities as $activity) :?>

                          <tr>
                            <td><?= $activity->date_activity;?></td>
                            <td><?= $activity->employee_name;?></td>
                            <td><a href="<?= base_url('report-detail/'.encrypt($activity->activity_id)); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none"><?= $activity->activity;?></a></td>
                            <td><?= $activity->result_activity;?></td>
                            <td><?= $activity->status;?></td>
                            <td>
                              <select name="status" data-id="<?= encrypt($activity->activity_id) ?>" class="form-control-sm status">
                                <option value="finished" <?php if($activity->status == 'finished'): ?>selected=""<?php endif;?>>Finished</option>
                                <option value="on-progress" <?php if($activity->status == 'on-progress'): ?>selected=""<?php endif;?>>On Progress</option>
                                <option value="pending" <?php if($activity->status == 'pending'): ?>selected=""<?php endif;?>>Pending</option>
                              </select>
                            </td>
                          </tr>
                          <?php endforeach;?>

                        </tbody>
                      </table>
                    </div><!-- table-responsive -->
                  </div><!-- card -->
                </div>
              </div>
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
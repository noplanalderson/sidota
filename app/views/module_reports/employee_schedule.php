<?php 
defined('BASEPATH') OR die('No Direct Script Access Allowed'); ?>

    <div class="az-content mt-3">
      <div class="container">
        <div class="az-content-body schedule-area">
          <div class="card card-table-two">
            <div class="card-header">
              <h6 class="card-title mt-3">Employee Schedule - <?= date('F Y', $period); ?></h6>
            </div>
            <div class="row mt-2 pd-30">
              <div class="col-md-2 col-sm-12 pd-1 text-center mt-2">
                Choose Period
              </div>
              <div class="col-md-3 col-sm-12 pd-5">
                <?= form_open('schedule', 'method="post" id="periodForm" accept-charset="utf-8"');?>
                <select name="year" id="year" class="form-control" required>
                  <option value="">Year</option>
                  <?php foreach ($years as $year) :?>

                    <option value="<?= $year->year;?>" <?php if($year->year == date('Y', $period)) :?>selected=""<?php endif;?>><?= $year->year;?></option>
                  <?php endforeach;?>

                </select>
              </div>
              <div class="col-md-3 col-sm-12 pd-5">
                <select name="month" id="month" class="form-control" required>
                  <option value="">Month</option>
                  <?php for ($i = 1; $i <= 12; $i++) :?>

                    <option value="<?= sprintf("%02d", $i);?>" <?php if($i == date('m', $period)) :?>selected=""<?php endif;?>><?= sprintf("%02d", $i);?></option>
                  <?php endfor;?>

                </select>
                </form>
              </div>
              <div class="col-md-4 col-sm-12 pd-5">
                <button title="Print" id="btn-print" class="btn btn-info btn-small mg-b-5"><i class="fa fa-print"></i> Print Schedule</button>
              </div>
            </div>
            <div class="row pd-30 table-responsive" id="schedule">
              <div class="col-md-12 col-sm-6 d-flex">
                <table class="table-schedule table-bordered">
                  <thead>
                    <tr class="text-center">
                        <th rowspan="2" class="align-middle">Name</th>
                        <th colspan="<?= $calendar; ?>"><?= date('F', $period);?></th>
                    </tr>
                    <tr class="text-center">
                      <?php for ($i = 1; $i <= $calendar; $i++) :?>
                        <th width="5px"><?= $i;?></th>
                      <?php endfor;?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($employees as $emp) :?>
                    <tr>
                      <td><?= $emp->employee_name;?></td>

                      <?php 
                      for ($i = 1; $i <= $calendar; $i++) :
                        
                        $schedule = $this->schedule_m->getSchedule($emp->employee_id, date('Y-m', $period), $i);
                        
                        if(!$schedule) 
                        { 
                          echo "<td width='5px' class='bg-danger text-dark text-center font-weight-bold'>OFF</td>";
                        }
                        else 
                        { 
                          $shifting = $this->schedule_m->getShift($emp->employee_id, date('Y-m', $period), $i);
                          echo "<td width='5px' class='text-center'>";
                          foreach ($shifting as $shift) 
                          {
                            echo "<a href='".base_url('daily-report/'.$shift->shift.'/'.strtotime(date('Ym', $period).$i).'/'.encrypt($emp->jobdesc_id))."'>".strtoupper($shift->shift[0])."</a>";
                          }
                          echo "</td>"; 
                        }
                      endfor;?>

                    </tr>
                    <?php endforeach;?>

                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- card -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
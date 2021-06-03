<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two">
            <div class="card-header">
              <h6 class="card-title">DAILY REPORT</h6>
            </div>
            <div class="row mt-2 pd-30">
              <div class="col-md-3 pd-2">
                <?= form_open('daily-report', 'id="dailyForm" method="post" accept-charset="utf-8"');?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-calendar tx-24 lh--9 op-6"></i>
                    </div>
                  </div>
                  <input type="text" name="date" id="date" class="form-control fc-datepicker" data-parsley-errors-container="#slError" placeholder="YYYY-MM-DD" value="<?= empty($date) ? '' : date('Y-m-d', $date); ?>" required>
                </div>
              </div>
              <div class="col-md-3 pd-2">
                  <select name="jobdesc_id" id="jobdesc_id" class="form-control" required>
                    <option value="">Choose Jobdesc</option>
                    <?php foreach ($jobdescs as $jobdesc) :?>
                    <option value="<?= $jobdesc->jobdesc_id; ?>" <?php if(encrypt($jobdesc->jobdesc_id) == $jobdesc_selected) :?>selected=""<?php endif; ?>><?= $jobdesc->jobdesc_name; ?></option>
                    <?php endforeach;?>
                  </select>
              </div>
              <div class="col-md-2 pd-2">
                  <select name="shift" id="shift" class="form-control" required>
                    <option value="">Choose Shift</option>
                    <option value="pagi" <?php if($shift == 'pagi') :?>selected=""<?php endif; ?>>Pagi</option>
                    <option value="siang" <?php if($shift == 'siang') :?>selected=""<?php endif; ?>>Siang</option>
                    <option value="malam" <?php if($shift == 'malam') :?>selected=""<?php endif; ?>>Malam</option>
                    <option value="wfh" <?php if($shift == 'wfh') :?>selected=""<?php endif; ?>>WFH</option>
                  </select>
                </form>
              </div>
              <div class="col-md-1 pd-2">
                <button type="button" id="copy" class="btn btn-sm rounded btn-primary"><i class="fa fa-copy"></i> Copy</button>
              </div>
              <div class="col-md-2 pd-2">
                <a href="https://web.whatsapp.com/send?phone=<?= $this->user->employee_phone;?>" target="_blank" class="btn rounded btn-sm btn-success"><i class="ion-logo-whatsapp"></i> Send to WA</a>
              </div>
            </div>
            <div id="area" class="m-3 row pd-10 bg-dark rounded">
              <div class="col-md-12 text-white">
                  <p class="font-weight-bold">DAILY REPORT</p>
                  <br/>
                  <p class="font-weight-bold">Date : <?= date('d F Y', $date); ?></p>
                  <p class="font-weight-bold">Shift : <?= strtoupper($shift);?></p>
                  <p class="font-weight-bold">PIC : <?= ucwords($pic_list);?></p>
                  <br/>

                  <ol>
                    <?php foreach ($reports as $report) :?>
                    <li>
                      <strong><?= $report->activity;?></strong><br/>
                      <strong>Location :</strong> <?= $report->location;?><br/>
                      <strong>Problem/Indication :</strong> <?= $report->problem;?><br/>
                      <strong>Action :</strong> <?= $report->action;?><br/>
                      <strong>Result :</strong>
                      <?= str_replace('- ', '<br/>- ', $report->result_activity); ?>
                    </li><br/>
                    <?php endforeach;?>
                  </ol>
              </div>
            </div>
          </div><!-- card -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-3">EMPLOYEE LISTS</h6>
            </div>
            <div class="row row-sm mt-2 pd-20">
              <?php foreach ($employees as $pic) :?>

              <div class="col-md-3 col-sm-4 col-xs-6 mt-5 pd-10 pd-sm-20 bg-dark-200 text-white table-bordered">
                <div class="thumbnail w-100">
                  <div class="image view view-first w-100">
                    <a href="<?= base_url('profile/'.encrypt($pic->employee_id));?>" target="_blank">
                      <img class="w-100 d-block rounded-circle" src="<?= site_url('_/images/users/'.encrypt($pic->employee_id).'/thumbnail/'.$pic->employee_picture);?>" alt="<?= $pic->employee_name;?>" />
                    </a>
                  </div>
                  <div class="caption mg-t-20 text-center">
                    <a href="<?= base_url('reports/'.encrypt($pic->employee_id));?>" class="btn btn-small btn-primary"><i class="fas fa-list"></i> Reports</a>
                    <a href="<?= base_url('documentations/'.encrypt($pic->employee_id));?>" class="btn btn-small btn-success"><i class="fas fa-images"></i> Documentation</a>
                  </div>
                  <div class="caption text-center">
                    <p class='mg-t-10'><b><?= $pic->employee_name;?></b><br/>
                    <?= ucwords($pic->jobdesc_name.' '.$pic->jobdesc_series);?></p>
                  </div>
                </div>
              </div>
              <?php endforeach;?>

            </div>
          </div><!-- card -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->

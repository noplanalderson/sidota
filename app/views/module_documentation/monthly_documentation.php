<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="row mg-b-20">
            <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
            <div id="delete_msg" class="alert d-none">
                <small class="delete_msg"></small>
            </div>
            
              <div class="card card-table-two">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-8">
                      <h4><?= $employee->employee_name; ?></h4>
                      <h6 class="card-title"><?= ucwords($employee->jobdesc_name).' '.$employee->jobdesc_series;?></h6>
                    </div>
                    <div class="col-md-4 mt-2 text-right">
                      <?= button($btn_download, TRUE, 'a', 'href="'.base_url('download-documentation/' . $month .'/' . $employeeID).'" class="btn btn-sm mt-lg-0 mt-sm-2 btn-success rounded" download ');?>

                      <?= button($btn_print, TRUE, 'a', 'href="'.base_url('print-documentation/' . $month  . '/' . $employeeID).'" class="btn btn-sm mt-lg-0 mt-sm-2 btn-primary rounded"');?>
                    </div>
                  </div>
                </div>
                <div class="row pd-30 text-center d-flex">
                  <?php 
                    if(empty($documentations)) echo '<h3 class="pd-20">No Image Available</h3>';

                    foreach ($documentations as $doc) :
                  ?>
                  <div class="col-md-3 col-sm-4 col-xs-12 mt-2 pd-10 bg-gray-200 table-bordered <?= encrypt($doc->picture);?>">
                    <div class="thumbnail w-100">
                      <div class="image view view-first w-100">
                        <a href="#" class="modal-effect show" data-effect="effect-flip-vertical" data-toggle="modal" data-target="#show-image" data-id="<?= encrypt($doc->picture);?>">
                          <img class="w-100 h-100 d-block rounded" src="<?= encodeImage('./_/images/uploads/'.$employeeID.'/'.$doc->upload_date.'/thumbnail/'.$doc->picture);?>" alt="activity" />
                        </a>
                      </div>
                      <div class="caption">
                        <?php if($this->session->userdata('uid') == $employee->employee_id):?>
                          <?= button($btn_delete, FALSE, 'button', 'data-id="'.encrypt($doc->picture).'" class="btn btn-sm btn-danger mg-t-20 delete-btn rounded"');?>

                        <?php endif;?>
                        <a href="<?= base_url('download-documentation/single/'.encrypt($doc->picture));?>" class="btn btn-sm btn-success mg-t-20 rounded" title="Download" download /><i class="fas fa-download"></i></a>
                      </div>
                      <div class="caption">
                        <p class='mg-t-20 font-weight-bold'><?= $doc->activity;?></p>
                        <p><?= date('d F Y', $doc->date_activity);?></p>
                      </div>
                    </div>
                  </div>
                  <?php endforeach;?>

                </div>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->

    <!-- LARGE MODAL -->
    <div id="show-image" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title"></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 text-center">
                <img id="image" class="w-100 d-block ml-auto mr-auto">
              </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
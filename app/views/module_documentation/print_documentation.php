<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="row row-sm mg-b-20">
            <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
              <div id="printable-area" class="card card-table-two">
                  <div class="card-header">
                <div class="row mg-b-10">
                    <div class="col-md-8">
                      <h4><?= $employee->employee_name;?></h4>
                      <h6 class="card-title"><?= ucwords($employee->jobdesc_name).' '.$employee->jobdesc_series;?></h6>
                    </div>
                    <div class="col-md-4">
                      <button title="Print" id="btn-print" class="btn btn-info btn-small mg-b-5 float-right"><i class="fa fa-print"></i> Print Documentations</button>
                    </div>
                </div>
                  </div>
                <div class="row pd-1 pd-sm-10 mg-t-1">
                  <div class="col-md-12">
                    <table border="1px" bordercolor="#ddd" cellpadding="10px" align="center">
                    <?php 
                      foreach ($documentations as $doc) : 
                    ?>

                    <tr>
                      <td>
                        <img class="h-auto d-block rounded mr-auto ml-auto w-50" src="<?= site_url('_/images/uploads/'.$employeeID.'/'.$doc->upload_date.'/'.$doc->picture);?>" alt="<?= $doc->activity; ?>" />
                        <div class="text-center">
                          <p class='mt-3 font-weight-bold'><?= $doc->activity;?></p>
                          <p><?= date('d F Y', $doc->date_activity);?></p>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach;?>

                    </table>
                  </div>
                </div>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
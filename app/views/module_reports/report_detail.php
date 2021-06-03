<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="row mg-b-20">
            <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
            
              <div class="card card-table-two">
                <div class="row">
                  <div class="col-lg-12 text-right">
                    <button title="Print" id="btn-print" class="btn btn-info mt-3 mr-3"><i class="fa fa-print"></i> Print</button>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                  <div class="table-responsive">
                    <div id="report">
                      <table class="table table-striped table-bordered" width="800px" align="center" cellpadding="0";>
                      <!--FORM HEADER-->
                          <tr class="text-center">
                              <td colspan="5" rowspan="5">
                                <img src="<?= encodeImage('./_/images/sites/logo-tng.png');?>" width="150px" height="150px" class="mt-4">
                              </td>
                              <td colspan="7" rowspan="5" class="align-middle">
                                <h3>FORMULIR KUNJUNGAN LAPANGAN</h3>
                              </td>
                              <td colspan="3" class="align-middle">
                                BIDANG TEKNOLOGI INFORMASI DAN KOMUNIKASI<br/>DINAS KOMUNIKASI DAN INFORMATIKA<br/>KOTA TANGERANG
                              </td>
                          </tr>
                          <tr class="w-50">
                              <td width="70px">No. Dokumen</td>
                              <td colspan="2">FR-TIK.KTNG.004.R0</td>
                          </tr>
                          <tr>
                              <td>Revisi</td>
                              <td>00</td>
                          </tr>
                          <tr>
                              <td>Tanggal</td>
                              <td><?= $report->date_activity;?></td>
                          </tr>
                          <tr>
                              <td>Halaman</td>
                              <td>1 dari 1</td>
                          </tr>
                          <tr height="10px">
                              <td colspan="15">&nbsp;</td>
                          </tr>

                      <!--FORM BODY-->
                          <tr>
                              <td colspan="1" width="150px">NOMOR</td>
                              <td colspan="14"></td>
                          </tr>
                          <tr class="font-weight-bold text-center">
                              <td colspan="15">WAKTU PELAKSANAAN</td>
                          </tr>
                          <tr>
                              <td colspan="5">TANGGAL</td>
                              <td colspan="10"><?= $report->date_activity;?></td>
                          </tr>
                          <tr>
                              <td colspan="5">JAM</td>
                              <td colspan="10"></td>
                          </tr>

                          <tr class="font-weight-bold text-center">
                              <td colspan="15">DATA PETUGAS</td>
                          </tr>
                          <tr>
                              <td colspan="5">NAMA</td>
                              <td colspan="10"><?= $employee->employee_name;?></td>
                          </tr>
                          <tr>
                              <td colspan="5">NO. TELP</td>
                              <td colspan="10"><?= $employee->employee_phone;?></td>
                          </tr>

                          <tr class="font-weight-bold text-center">
                              <td colspan="15">DATA LOKASI KUNJUNGAN</td>
                          </tr>
                          <tr>
                              <td colspan="5">OPD/LOKASI</td>
                              <td colspan="10"><?= $report->location;?></td>
                          </tr>
                          <tr>
                              <td colspan="5">ALAMAT</td>
                              <td colspan="10"><?= $report->location_address;?></td>
                          </tr>
                          <tr>
                              <td colspan="5">NO. TELP</td>
                              <td colspan="10"></td>
                          </tr>

                          <tr class="font-weight-bold text-center">
                              <td colspan="15">PEKERJAAN</td>
                          </tr>
                          <tr>
                              <td colspan="5">KATEGORI PEKERJAAN</td>
                              <td colspan="10"><?= $report->category_activity;?></td>
                          </tr>
                          <tr>
                              <td colspan="5">DETAIL PEKERJAAN</td>
                              <td colspan="10"><?= $report->activity;?></td>
                          </tr>
                          <tr>
                              <td colspan="5">PERANGKAT YANG DIGUNAKAN</td>
                              <td colspan="10">
                                <ol>
                                  <?php
                                    $tools = $this->reports_m->getToolsByActivity($report->activity_id);

                                    foreach ($tools as $tool) :
                                  ?>
                                  <li><?= $tool->tool;?> (<?= $tool->tool_owner;?>)</li>
                                  <?php endforeach;?>
                                </ol>
                              </td>
                          </tr>
                          <tr>
                              <td colspan="5">HASIL PEKERJAAN</td>
                              <td colspan="10">
                                <?= str_replace('- ', '<br/>- ', $report->result_activity);?>
                                  
                              </td>
                          </tr>
                      </table>

                      <!--TANDA TANGAN-->
                      <table class="mt-5 font-weight-bold" border="0" width="800px" align="center">
                          <tr class="text-center">
                              <td width="400px">MENGETAHUI,<br/>PIC OPD/LOKASI</td>
                              <td width="400px">PETUGAS</td>
                          </tr>
                      </table>

                      <table class="mg-t-50 mb-5 font-weight-bold" border="0" width="800px" align="center">
                          <tr class="text-center">
                              <td width="400px">(.................................................)</td>
                              <td width="400px"><?= strtoupper($employee->employee_name);?></td>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
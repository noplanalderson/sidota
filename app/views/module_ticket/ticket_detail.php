<?php 
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="row mg-b-20">
            <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
            
              <div class="card card-table-two rounded">
                <div class="row">
                  <div class="col-md-12">
                    <button title="Print" id="btn-print" class="btn btn-info mr-3 mt-2 rounded float-right"><i class="fa fa-print"></i> Print</button>
                    <?php
                      switch ($ticket->status) {
                        case 'opened':

                          $link = 'approve-ticket';
                          $style= 'btn-primary';

                          break;
                        
                        case 'approved':

                          $link = 'close-ticket';
                          $style= 'btn-primary';

                          break;

                        default:

                          $link = 'close-ticket';
                          $style= 'btn-primary d-none';
                          break;
                      }

                      $btn_update = $this->app_m->getContentMenu($link);
                    ?>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                  <div class="table-responsive">
                    <div id="report">
                      <table class="table table-striped table-bordered" width="800px" align="center" cellpadding="0";>
                      <!--FORM HEADER-->
                          <tr class="text-center">
                              <td colspan="5" rowspan="5" class="align-middle"><img src="<?= encodeImage('./_/images/sites/logo-tng.png');?>" width="150px" height="150px"></td>
                              <td colspan="7" rowspan="5" class="align-middle"><h3>TICKET FORM</h3></td>
                              <td colspan="3" class="align-middle">BIDANG TEKNOLOGI INFORMASI DAN KOMUNIKASI<br/>DINAS KOMUNIKASI DAN INFORMATIKA<br/>KOTA TANGERANG</td>
                          </tr>
                          <tr class="align-middle w-50">
                              <td width="70px">No. Dokumen</td>
                              <td colspan="2">FR-TIK.KTNG.004.R0</td>
                          </tr>
                          <tr>
                              <td>Revisi</td>
                              <td>00</td>
                          </tr>
                          <tr>
                              <td>Tanggal</td>
                              <td><?= $ticket->date_report;?></td>
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
                              <td colspan="1" class="text-center" width="150px">NOMOR</td>
                              <td colspan="14"></td>
                          </tr>
                          <tr class="font-weight-bold text-center">
                              <td colspan="15">WAKTU LAPORAN</td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">TANGGAL</td>
                              <td colspan="10"><?= $ticket->date_report;?></td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">DIBUAT OLEH</td>
                              <td colspan="10"><?= $ticket->created_by;?></td>
                          </tr>

                          <tr class="font-weight-bold text-center">
                              <td colspan="15">PELAPOR, PENERIMA, DAN EKSEKUTOR</td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">NAMA PELAPOR</td>
                              <td colspan="10"><?= $ticket->reporter;?></td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">NAMA PENERIMA</td>
                              <td colspan="10"><?= $ticket->approved_by;?></td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">NAMA EKSEKUTOR</td>
                              <td colspan="10"><?= $ticket->solved_by;?></td>
                          </tr>

                          <tr class="font-weight-bold text-center">
                              <td colspan="15">PEKERJAAN DAN LOKASI</td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">LOKASI PEKERJAAN</td>
                              <td colspan="10"><?= $ticket->location;?></td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">KATEGORI PEKERJAAN</td>
                              <td colspan="10"><?= $ticket->category_activity;?></td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">LAPORAN MASALAH</td>
                              <td colspan="10"><?= $ticket->problem_report;?></td>
                          </tr>
                          <tr>
                              <td colspan="5" class="text-center">TANGGAL SELESAI</td>
                              <td colspan="10"><?= $ticket->date_solved;?></td>
                          </tr>
                      </table>

                    <br/><br/>
                      <!--TANDA TANGAN-->
                      <table border="0" width="800px" align="center" class="text-center font-weight-bold">
                          <tr>
                              <td width="400px">MENGETAHUI,<br/>PIC OPD/LOKASI</td>
                              <td width="400px">PETUGAS</td>
                          </tr>
                      </table>

                      <table border="0" width="800px" align="center" class="text-center mg-t-50 mg-b-20 font-weight-bold">
                          <tr>
                              <td width="400px">(.................................................)</td>
                              <td width="400px"><?= strtoupper($ticket->solved_by);?></td>
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
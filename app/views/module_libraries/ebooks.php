<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body overflow-auto">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-3">LIBRARIES</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="ebook" class="table table-striped table-bordered">
                  <thead>
                    <tr class="text-center">
                      <th>Ebook Title</th>
                      <th>Upload Date</th>
                      <th>Uploader</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Type</th>
                      <th width="120px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ebooks as $ebook) :?>

                    <tr>
                      <td><?= ucwords($ebook->ebook_title);?></td>
                      <td><?= $ebook->uploadDate;?></td>
                      <td><?= $ebook->employee_name;?></td>
                      <td><?= $ebook->ebook_description;?></td>
                      <td><?= $ebook->ebook_categories;?></td>
                      <td><?php $file = explode('.', $ebook->ebook_file); echo end($file);?></td>
                      <td>
                        <?php if($this->session->userdata('uid') == $ebook->employee_id) : ?>

                          <?= button($btn_edit, FALSE, 'a', 'href="'.base_url('edit-ebook/'.encrypt($ebook->ebook_id)).'" class="btn-sm btn-warning text-white"');?>

                          <?= button($btn_delete, FALSE, 'a', 'class="delete-btn btn-sm btn-danger text-white" data-id="'.encrypt($ebook->ebook_id).'"');?>

                        <?php endif;?>

                        <?= button($btn_download, FALSE, 'a', 'href="'.base_url('download-ebook/'.encrypt($ebook->ebook_id)).'" class="btn-sm btn-success text-white" target="_blank"');?>
                      </td>
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
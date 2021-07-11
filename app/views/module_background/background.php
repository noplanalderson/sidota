<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div id="delete_msg" class="alert d-none">
              <small class="delete_msg"></small>
          </div>
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
                <h6 class="card-title mt-3">BACKGROUND</h6>
                <?= button($btn_add, TRUE, 'button', 'href="#" class="btn-sm add-background btn-primary float-right" data-toggle="modal" data-target="#backgroundModal" id="'.$add_url.'"');?>
            </div>
            <div class="card-body">
              <table id="background_tbl" class="table table-striped table-bordered table-responsive w-100">
                <thead>
                  <tr class="text-center">
                    <th>Background</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($images as $img) :?>

                  <tr>
                    <td>
                      <img src="<?= $path . $img->image;?>" alt="<?=  $img->image; ?>" width="25%">
                    </td>
                    <td>
                      <?= button($btn_delete, FALSE, 'button', 'href="#" data-id="'.$img->bg_hash.'" class="btn delete-btn btn-small btn-danger" id="'.$delete_url.'"');?>
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

      <div class="modal fade" id="backgroundModal" tabindex="-1" role="dialog" aria-labelledby="Background" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="accessAction"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <div id="message" class="alert d-none">
                <small class="message"></small>
              </div>

              <?= form_open_multipart('', 'id="bgForm" method="post"');?>
                <div class="row row-xs align-items-center mg-b-20 item form-group">
                  <div class="col-md-12 mg-t-5 mg-md-t-0">
                    <div class="file-loading">
                        <input name="files[]" type="file" class="picture_upload"
                        data-allowed-file-extensions='["jpg","jpeg","png","webp"]' multiple="" />
                    </div>
                    <small class="text-danger font-weight-normal">Max. Size 5 MB/Picture</small>
                  </div>
                </div><!-- row -->
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
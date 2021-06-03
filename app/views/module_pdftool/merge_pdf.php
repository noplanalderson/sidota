<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="col-md-12 col-sm-12 col-xs-12 mg-t-20 mg-lg-t-0">
            
            <div class="card card-table-two">
              <div class="card-header">
                <h6 class="card-title mt-3">MERGE PDF FILE</h6>
              </div>

              <div class="row m-md-2">
                <div class="col-md-12">
                  <div id="loading" class="alert d-none">
                      <small class="loading"></small>
                  </div>
                </div>
                <div class="col-md-12">
                  <div id="message" class="alert d-none">
                      <small class="message"></small>
                  </div>
                </div>
              </div>

              <?= form_open_multipart("mergefile", "method='post' class='upload-form'");?>
                <div class="row m-md-2">
                  <div class="col-md-12">
                    <input type="text" class="form-control" name="file_title" placeholder="File Title">
                  </div>
                  <div class="col-md-12">
                    <label class="mg-t-10">Merge Activity Reports with Documentation (Max. 5 MB)</label>
                    <div class="file-loading">
                        <input id="files" name="files[]" type="file" class="file"
                        data-allowed-file-extensions='["pdf"]' required multiple="" />
                    </div>
                    <div id="doc-errors"></div>
                  </div>
                  <div class="col-md-12 mt-2">
                    <input type="submit" name="upload" value="Upload" class="btn btn-block btn-primary rounded">
                  </div>
                </div>
              </form>
            </div><!-- card -->
          </div><!-- col -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
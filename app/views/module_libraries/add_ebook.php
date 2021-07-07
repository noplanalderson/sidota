<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two">
            <div class="card-header">
              <h6 class="card-title mt-3">ADD EBOOK</h6>
            </div>
            <div class="card-body">
              <?= form_open_multipart('libraries/upload', 'id="ebookForm" method="post"');?>

                <div class="">
                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label mg-b-0">Author *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input type="text" name="author" class="form-control" value="<?= $this->user->employee_name;?>" disabled>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label mg-b-0">Categories *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <div id="slWrapper" class="parsley-select">
                        <select class="form-control select2 w-100" data-placeholder="Choose Categories" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" name="category[]" multiple="multiple" required>
                          <option label="Choose one"></option>
                          <?php foreach ($categories as $category) :?>

                          <option value="<?= $category->category;?>"><?= $category->category;?>
                          </option>
                          <?php endforeach;?>

                        </select>
                        <div id="slErrorContainer"></div>
                      </div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label mg-b-0">Ebook Title *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input type="text" name="ebook_title" class="form-control" placeholder="Ebook Title" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label mg-b-0">Ebook Description *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <textarea rows="3" name="ebook_description" class="form-control" placeholder="Ebook Description (max. 255 Characters)" maxlength="255" required></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20 item form-group">
                    <div class="col-md-3">
                      <label class="control-label mg-b-0" for="note">Ebook File *</label>
                    </div>
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <div class="file-loading">
                          <input id="file" name="file" type="file"
                          data-allowed-file-extensions='["pdf","txt","doc","docx","ppt","pptx"]' required  />
                      </div>
                      <div id="doc-errors"></div>
                      <small class="text-danger font-weight-normal">Max. Size 5 MB</small>
                    </div>
                  </div><!-- row -->
                  <button type="submit" name="upload" class="btn btn-az-primary pd-x-30 mg-r-5">Upload Ebook</button>
                  <button type="reset" class="btn btn-dark pd-x-30">Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
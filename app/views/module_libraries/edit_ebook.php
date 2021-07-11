<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?> 
   
    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-4">EDIT EBOOK</h6>
            </div>
            <div class="card-body pd-30 pd-sm-40 bg-dark-200">
              <?= form_open_multipart('libraries/update', 'id="ebookForm" method="post"');?>

                <input type="hidden" name="ebook_id" value="<?= encrypt($ebook->ebook_id);?>">
                <input type="hidden" name="upload_date" value="<?= $ebook->upload_date;?>">
                <div class="">
                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Author *</label>
                    </div><!-- col -->
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <input type="text" name="pic" class="form-control bg-dark text-white" value="<?= $this->user->employee_name;?>" disabled>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Categories *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <div id="slWrapper" class="parsley-select">
                        <select class="form-control bg-dark text-white select2 w-100 bg-dark" data-placeholder="Choose Categories" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" name="category[]" multiple="multiple" required>
                          <option label="Choose one"></option>
                          <?php foreach ($categories as $category) :?>

                          <option value="<?= $category->category;?>" <?= multiple_selected($category->category, $ebook->ebook_categories);?>><?= $category->category;?></option>
                          <?php endforeach;?>

                        </select>
                        <div id="slErrorContainer"></div>
                      </div>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Ebook Title *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <input type="text" name="ebook_title" class="form-control bg-dark text-white" placeholder="Ebook Title" value="<?= $ebook->ebook_title;?>" required>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-3">
                      <label class="form-label text-white mg-b-0">Ebook Description *</label>
                    </div><!-- col -->
                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                      <textarea rows="3" name="ebook_description" class="form-control bg-dark text-white" placeholder="Ebook Description (Max. 255 Character)" maxlength="255" ><?= $ebook->ebook_description;?></textarea>
                    </div><!-- col -->
                  </div><!-- row -->

                  <div class="row row-xs align-items-center mg-b-20 item form-group">
                    <div class="col-md-3">
                      <label class="control-label mg-b-0 text-white" for="note">Ebook File</label>
                    </div>
                    <div class="col-md-9 mg-t-5 mg-md-t-0">
                      <div class="row row-sm">
                        <div class="col-md-11 col-sm-6 col-xs-6">
                          <input type="hidden" name="oldbook" value="<?= $ebook->ebook_file;?>">
                          <input type="file" id="file" class="form-control bg-dark text-white" name="file" data-allowed-file-extensions='["pdf","txt","doc","docx","ppt","pptx"]'>
                          <small class="text-danger">Max Size 10 MB. Extension doc, docx, ppt, pptx, pdf.</small>
                        </div>
                      </div>
                    </div>
                  </div><!-- row -->
                  <button type="submit" name="upload" class="btn btn-az-primary pd-x-30 mg-r-5">Submit</button>
                  <button type="reset" class="btn btn-dark pd-x-30">Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
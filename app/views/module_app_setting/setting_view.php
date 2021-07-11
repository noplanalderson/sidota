<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>
  <div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <div class="card card-table-two rounded mb-5">
          <div class="card-header">
            <h6 class="card-title mt-3">APP SETTINGS</h6>
          </div>
          <div class="card-body pd-sm-40 bg-dark-200">
            <?= form_open('submit-setting', 'id="settingForm" method="post"'); ?>

                <div class="row row-xs align-items-center mg-b-20">
                  <div class="col-md-3">
                    <label class="form-label text-white mg-b-0">Title 1 *</label>
                  </div><!-- col -->
                  <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input type="text" name="app_title" class="form-control bg-dark text-white" value="<?= $this->app->app_title;?>" required>
                  </div><!-- col -->
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20">
                  <div class="col-md-3">
                    <label class="form-label text-white mg-b-0">Title Alt. *</label>
                  </div><!-- col -->
                  <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input type="text" name="app_title_alt" class="form-control bg-dark text-white" value="<?= $this->app->app_title_alt;?>" required>
                  </div><!-- col -->
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20">
                  <div class="col-md-3">
                    <label class="form-label text-white mg-b-0">Footer Text *</label>
                  </div><!-- col -->
                  <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <textarea rows="3" name="footer_text" class="form-control bg-dark text-white" placeholder="Footer Text (150 Character)" maxlength="150" required><?= $this->app->footer_text;?></textarea>
                  </div><!-- col -->
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20">
                  <div class="col-md-3">
                    <label class="form-label text-white mg-b-0">Show Month for Graph *</label>
                  </div><!-- col -->
                  <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <input type="number" name="show_month" class="form-control bg-dark text-white" value="<?= $this->app->show_month;?>" max="12" min="3" required>
                  </div><!-- col -->
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20">
                  <div class="col-md-3">
                    <label class="form-label text-white mg-b-0">Show Category Activity Graph *</label>
                  </div><!-- col -->
                  <div class="col-md-8 mg-t-5 mg-md-t-0">
                    <div id="slWrapper" class="parsley-select">
                      <select class="form-control bg-dark text-white select2 w-100" data-placeholder="Choose Categories" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" name="category_activity_id[]" multiple="multiple" required>
                        <option value="">Choose Categories</option>
                        <?php foreach ($categories as $category) : ?>

                          <option value="<?= $category->category_activity_id;?>"
                          <?= multiple_selected($category->category_activity_id, $this->app->show_category);?>>
                            <?= $category->category_activity;?>

                          </option>
                        <?php endforeach; ;?>

                      </select>
                      <div id="slErrorContainer"></div>
                    </div>
                  </div><!-- col -->
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20 item form-group">
                  <div class="col-md-3">
                    <label class="control-label mg-b-0" for="note">App Icon *</label>
                  </div>
                  <div class="col-md-9 mg-t-5 mg-md-t-0">
                    <div class="row row-sm">
                      <div class="col-md-11 col-sm-6 col-xs-6">
                        <input type="file" class="form-control bg-dark text-white" id="app_icon" name="app_icon">
                        <small class="text-danger">Max. File Size 2 MB.</small>
                      </div>
                    </div>
                  </div>
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20 item form-group">
                  <div class="col-md-3">
                    <label class="control-label mg-b-0" for="note">Logo Aplikasi *</label>
                  </div>
                  <div class="col-md-9 mg-t-5 mg-md-t-0">
                    <div class="row row-sm">
                      <div class="col-md-11 col-sm-6 col-xs-6">
                        <input type="file" class="form-control bg-dark text-white" id="app_logo" name="app_logo">
                        <small class="text-danger">Max. File Size 5 MB.</small>
                      </div>
                    </div>
                  </div>
                </div><!-- row -->

                <div class="row row-xs align-items-center mg-b-20 item form-group">
                  <div class="col-md-3">
                    <label class="control-label mg-b-0" for="note">Login Logo *</label>
                  </div>
                  <div class="col-md-9 mg-t-5 mg-md-t-0">
                    <div class="row row-sm">
                      <div class="col-md-11 col-sm-6 col-xs-6">
                        <input type="file" class="form-control bg-dark text-white" id="app_logo_login" name="app_logo_login">
                        <small class="text-danger">Max. File Size 5 MB.</small>
                      </div>
                    </div>
                  </div>
                </div><!-- row -->
                <button type="submit" name="submit" class="btn btn-az-primary pd-x-30 mg-r-5">Submit</button>
                <button type="reset" class="btn btn-dark pd-x-30">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
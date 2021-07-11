<?php defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">

          <div class="row row-sm mg-b-20">
            <div class="col-lg-6 mg-t-20 mg-lg-t-0">
              <div class="card card-table-two rounded">
                <div class="card-header">
                  <h6 class="card-title">JOBDESC</h6>
                </div>
                <div class="card-body table-responsive mt-3">
                  <?= button($btn_add, TRUE, 'button', 'href="#" class="btn-sm add-jobdesc btn-primary float-right" data-toggle="modal" data-target="#jobdescModal"');?>
                  <table class="table utilities table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Jobdesc Name</th>
                        <th>User Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($jobdescs as $jobdesc) :?>

                      <tr>
                        <td><?= $jobdesc->jobdesc_name;?></td>
                        <td><?= $jobdesc->type_code;?></td>
                        <td>
                          <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-jobdesc" data-toggle="modal" data-target="#jobdescModal" data-id="'.encrypt($jobdesc->jobdesc_id).'"');?>
                          <?= button($btn_delete, FALSE, 'button', 'data-id="'.encrypt($jobdesc->jobdesc_id).'" id="jobdesc" class="btn delete-btn btn-small btn-danger"');?>
                        </td>
                      </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div>
            <div class="col-lg-6 mg-t-20 mg-lg-t-0">
              <div class="card card-table-two rounded">
                <div class="card-header">
                  <h6 class="card-title">ACTIVITY CATEGORIES</h6>
                </div>
                <div class="card-body table-responsive">
                  <?= button($btn_add, TRUE, 'button', 'href="#" class="btn-sm add-act-category btn-primary float-right" data-toggle="modal" data-target="#actCategoryModal"');?>
                  <table class="table utilities table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($act_categories as $category) :?>

                      <tr>
                        <td><?= $category->category_activity;?></td>
                        <td>
                          <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-act-category" data-toggle="modal" data-target="#actCategoryModal" data-id="'.encrypt($category->category_activity_id).'"');?>
                          <?= button($btn_delete, FALSE, 'button', 'data-id="'.encrypt($category->category_activity_id).'" id="act-category" class="btn delete-btn btn-small btn-danger"');?>
                        </td>
                      </tr>
                      <?php endforeach;?>

                    </tbody>
                  </table>
                </div><!-- card-body -->
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
          <div class="row row-sm mg-b-20">
            <div class="col-lg-6 mg-t-20 mg-lg-t-0">
              <div class="card card-table-two rounded">
                <div class="card-header">
                  <h6 class="card-title">EBOOK CATEGORIES</h6>
                </div>             
                <div class="card-body table-responsive">
                  <?= button($btn_add, TRUE, 'button', 'href="#" class="btn-sm add-ebook-category btn-primary float-right" data-toggle="modal" data-target="#ebookCategoryModal"');?>
                  <table class="table utilities table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Ebook Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($ebook_categories as $e_category) :?>

                      <tr>
                        <td><?= $e_category->category;?></td>
                        <td>
                          <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-ebook-category" data-toggle="modal" data-target="#ebookCategoryModal" data-id="'.encrypt($e_category->id_category).'"');?>
                          <?= button($btn_delete, FALSE, 'button', 'data-id="'.encrypt($e_category->id_category).'" id="ebook-category" class="btn delete-btn btn-small btn-danger"');?>
                        </td>
                      </tr>
                      <?php endforeach;?>

                    </tbody>
                  </table>
                </div><!-- card-body -->
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->

    <div class="modal fade" id="jobdescModal" tabindex="-1" role="dialog" aria-labelledby="Jobdesc Modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
              <h5 class="modal-title" id="utilAction"></h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">

            <?= form_open('edit-utility/jobdesc', 'id="jobdescForm" method="post"');?>

            <input type="hidden" id="jobdesc_id" name="jobdesc_id" value="">

            <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">Jobdesc Name</label>
              <div class="col-sm-12 col-md-10">
                <input type="text" id="jobdesc_name" name="jobdesc_name" class="form-control bg-dark text-white" placeholder="Jobdesc Name" required="required">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">User Type</label>
              <div class="col-sm-12 col-md-10">
                <select id="type_id" name="type_id" class="form-control bg-dark text-white" required="required">
                <?php foreach ($user_type as $type) :?>
                  
                  <option value="<?= $type->type_id ?>"><?= $type->type_code ?></option>
                <?php endforeach;?>
                
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
            <button class="btn btn-success submit" type="submit" name="submit"></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="actCategoryModal" tabindex="-1" role="dialog" aria-labelledby="Activity Category Modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
              <h5 class="modal-title" id="utilAction"></h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">

            <?= form_open('edit-utility/act-category', 'id="actCatForm" method="post"');?>

            <input type="hidden" id="category_activity_id" name="category_activity_id" value="">

            <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">Category</label>
              <div class="col-sm-12 col-md-10">
                <input type="text" id="category_activity" name="category_activity" class="form-control bg-dark text-white" placeholder="Activity Category" required="required">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
            <button class="btn btn-success submit" type="submit" name="submit"></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ebookCategoryModal" tabindex="-1" role="dialog" aria-labelledby="Ebook Category" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
              <h5 class="modal-title" id="utilAction"></h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">

            <?= form_open('edit-utility/ebook-category', 'id="ebookCatForm" method="post"');?>

            <input type="hidden" id="id_category" name="id_category" value="">

            <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">Category</label>
              <div class="col-sm-12 col-md-10">
                <input type="text" id="category" name="category" class="form-control bg-dark text-white" placeholder="Activity Category" required="required">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
            <button class="btn btn-success submit" type="submit" name="submit"></button>
            </form>
          </div>
        </div>
      </div>
    </div>
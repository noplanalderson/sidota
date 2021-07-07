<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="card card-table-two">
            <div class="card-header">
                <h6 class="card-title mt-3">ACCESS LISTS</h6>
                <?= button($btn_add, TRUE, 'button', 'href="#" class="btn-sm add-access btn-primary float-right" data-toggle="modal" data-target="#accessModal"');?>
            </div>
            <div class="card-body">
              <table id="access_lists" class="table table-striped table-bordered table-responsive">
                <thead>
                  <tr class="text-center">
                    <th>User Type</th>
                    <th width="50%">Access Lists</th>
                    <th>Index Page</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user_type as $type) :?>

                  <tr>
                    <td><?= $type->type_code;?></td>
                    <td><?= $this->access_m->getAccessList($type->type_id);?></td>
                    <td>
                      <select name="index_page" class="index_page" data-id="<?= encrypt($type->type_id) ?>" required>
                        <option value="">Index Page</option>
                        <?php foreach ($this->access_m->getIndexPage($type->type_id) as $index) :?>
                        
                        <option value="<?= $index->menu_link ?>" <?php if($type->index_page === $index->menu_link):?>selected=""<?php endif;?>><?= $index->menu_label ?></option>
                        <?php endforeach; ?>
                      
                      </select>
                    </td>
                    <td>
                      <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn btn-small btn-warning edit-access" data-toggle="modal" data-target="#accessModal" data-id="'.encrypt($type->type_id).'"');?>
                      <?= button($btn_delete, FALSE, 'button', 'href="#" data-id="'.encrypt($type->type_id).'" class="btn delete-btn btn-small btn-danger"');?>
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

      <div class="modal fade" id="accessModal" tabindex="-1" role="dialog" aria-labelledby="Access Management" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
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

              <?= form_open('', 'id="accessForm" method="post"');?>

              <input type="hidden" id="type_id" name="type_id" value="">

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Access Type</label>
                <div class="col-sm-12 col-md-10">
                  <input type="text" id="type_code" name="type_code" class="form-control" placeholder="Access Type" required="required">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Privileges</label>
                <div class="col-sm-12 col-md-10">
                  <select id="menu_id" name="menu_id[]" class="form-control select2-search" required="required" multiple="multiple">
                  <?php foreach ($menus as $menu) :?>
                    
                    <option value="<?= $menu->menu_id ?>"><?= $menu->menu_label ?></option>
                  <?php endforeach;?>
                  
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="reset" data-dismiss="modal">Reset</button>
              <button id="submit" class="btn btn-success" type="submit" name="submit"></button>
              </form>
            </div>
          </div>
        </div>
      </div>
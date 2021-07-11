<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
            
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
              <h6 class="card-title mt-3">DOCUMENTATION BY MONTH</h6>
            </div>

            <div class="row row-sm mt-2 pd-20">
              <?= form_open("", "method='post' class='documentation-period' accept-charset='utf-8'");?>
                <label class="ml-3 mt-2 text-white">Select Period</label>
                <div class="col-md-12 d-flex mr-5">
                  <input type="hidden" id="uid" name="uid" value="<?= $employeeID ?>">
                  <input type="text" id="from" class="form-control bg-dark text-white mg-10" name="from" required="required">
                  <input type="text" id="to" class="form-control bg-dark text-white mg-10" name="to" required="required">
                  <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary mg-10">Submit</button>
                </div>
              </form>
            </div>
            <div class="row mg-r-5 pd-20">
              <?php foreach ($months as $month) :?>

              <div class="col-md-2 col-sm-4 col-xs-6 mt-5 ml-3 pd-30 bg-dark-200 text-white table-bordered">
                <div class="thumbnail w-100">
                  <div class="image view view-first w-100">
                    <a href="<?= base_url('monthly-documentation/'.strtotime($month->month).'/'.$employeeID);?>">
                      <img class="w-100" src="<?= site_url('_/images/photo-gallery.png');?>" alt="documentation" />
                    </a>
                  </div>
                  <div class="caption text-center">
                    <h6 class='mg-t-20'><?= $month->month;?></h6>
                  </div>
                </div>
              </div>
              <?php endforeach;?>
            </div>
          </div><!-- card -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body overflow-auto">
          <div class="card card-table-two rounded mb-5">
            <div class="card-header">
                <h6 class="card-title mt-3">EMPLOYEE LISTS</h6>
            </div>
            <div class="card-body">
              <table id="employees" class="table table-striped table-bordered table-responsive">
                <thead>
                  <tr class="text-center">
                    <th>Employee Name</th>
                    <th>Jobdesc</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($employees as $employee) :?>

                  <tr>
                    <td><?= $employee->employee_name;?></td>
                    <td><?= strtoupper($employee->jobdesc_name).' '.$employee->jobdesc_series;?></td>
                    <td><?= $employee->employee_address;?></td>
                    <td><?= $employee->employee_phone;?></td>
                    <td><?= $employee->user_email;?></td>
                    <td><?= $employee->status; ?></td>
                    <td>
                      <?= button($btn_edit, FALSE, 'a', 'href="'.base_url('edit-employee/'.encrypt($employee->user_id)).'" class="btn-sm btn-warning text-white"');?>
                      <?= button($btn_delete, FALSE, 'a', 'class="delete-btn btn-sm btn-danger text-white" data-id="'.encrypt($employee->user_id).'"');?>
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
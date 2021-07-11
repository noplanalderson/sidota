<?php
defined('BASEPATH') OR die('No Direct Script Access Allowed');?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body overflow-auto">

          <div class="card card-table-two rounded">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8 col-sm-12">
                  <h6 class="card-title mt-3">TICKET LISTS</h6>
                </div>
                <div class="col-md-2 col-sm-12 text-right mt-2">
                  <?= button($btn_add, TRUE, 'button', 'href="#" class="btn-sm add-ticket btn-primary float-right" data-toggle="modal" data-target="#ticketModal"');?>
                </div>
                <div class="col-md-2 col-sm-12 mt-2">
                  <select name="status" class="ticket-status form-control bg-dark text-white bg-dark text-white">
                    <option value="">Ticket Status</option>
                    <option value="all">All</option>
                    <option value="opened">Opened</option>
                    <option value="approved">Approved</option>
                    <option value="closed">Closed</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="table-responsive pd-20 mt-3">
              <table id="ticket" class="table table-striped table-bordered">
                <thead class="text-center">
                  <tr>
                    <th>Ticket Code</th>
                    <th>Date</th>
                    <th>Reporter</th>
                    <th>Report</th>
                    <th>Created by</th>
                    <th>Approved by</th>
                    <th>Closed by</th>
                    <th width="100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tickets as $ticket) :?>

                  <tr>
                    <td><?= $ticket->ticket_code;?></td>
                    <td><?= $ticket->date_report;?></td>
                    <td><?= $ticket->reporter;?></td>
                    <td><?= $ticket->problem_report;?></td>
                    <td><?= $ticket->employee_name;?></td>
                    <td><?= $ticket->approved_by;?></td>
                    <td><?= $ticket->solved_by;?></td>
                    <td>
                    <?php
                      switch ($ticket->status) {
                        case 'opened':

                          $link = 'approve-ticket';
                          $style= 'btn-primary';

                          break;
                        
                        case 'approved':

                          $link = 'close-ticket';
                          $style= 'btn-primary';

                          break;

                        default:

                          $link = 'close-ticket';
                          $style= 'btn-primary d-none';
                          break;
                      }

                      $btn_update = $this->app_m->getContentMenu($link);
                    ?>
                    <?= button($btn_detail, FALSE, 'a', 'href="'.base_url('ticket-detail/'.encrypt($ticket->ticket_code)).'" class="btn-sm btn-success"');?>
                    <?= button($btn_update, FALSE, 'a', 'href="'.base_url($link . '/' . encrypt($ticket->ticket_code)).'" class="btn-sm '.$style.'"');?>

                    <?php if($this->session->userdata('uid') == $ticket->created_by) :?>
                    <?= button($btn_edit, FALSE, 'a', 'href="#" class="btn-sm btn-warning edit-ticket" data-toggle="modal" data-target="#ticketModal" data-id="'.encrypt($ticket->ticket_code).'"');?>
                    <?= button($btn_delete, FALSE, 'a', 'href="#" data-id="'.encrypt($ticket->ticket_code).'" class="delete-btn btn-sm btn-danger"');?>
                    <?php endif;?>
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

     <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="Ticket Management" aria-hidden="true">
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

              <?= form_open('', 'id="ticketForm" method="post"');?>

              <input type="hidden" id="ticket_code" name="ticket_code" value="">

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label text-white">Reporter</label>
                <div class="col-sm-12 col-md-10">
                  <input type="text" id="reporter" name="reporter" class="form-control bg-dark text-white" placeholder="Reporter Name" required="required">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label text-white">Date Report</label>
                <div class="col-sm-12 col-md-10">
                  <input type="date" id="date_report" name="date_report" class="form-control bg-dark text-white" required="required">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label text-white">Category</label>
                <div class="col-sm-12 col-md-10">
                  <select id="category_activity_id" name="category_activity_id" class="form-control bg-dark text-white select2-search" required="required">
                  <?php foreach ($categories as $category) :?>
                    
                    <option value="<?= $category->category_activity_id ?>"><?= $category->category_activity ?></option>
                  <?php endforeach;?>
                  
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label text-white">Problem Report</label>
                <div class="col-sm-12 col-md-10">
                  <textarea name="problem_report" id="problem_report" class="form-control bg-dark text-white"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label text-white">Location</label>
                <div class="col-sm-12 col-md-10">
                  <input type="text" id="location" name="location" class="form-control bg-dark text-white" placeholder="Location" required="required">
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
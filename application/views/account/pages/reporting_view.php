<div class="col-xs-12">
  <div class="col-xs-12 col-sm-6" data-toggle="modal" data-target="#sales_report_modal">
    <a class="btn btn-app btn-block">
        <i class="fa fa-money"></i> Sales Report
    </a>
  </div>
 <div class="col-xs-12 col-sm-6">
    <a class="btn btn-app btn-block" data-toggle="modal" data-target="#inventory_report">
      <i class="fa fa-clipboard"></i> Inventory Report
    </a>
  </div>

 
</div>

<div class="modal fade" id="sales_report_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Sales Report Details</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('pos/print_sales',array('id'=>'sales_report_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="error_message">
        </div>

        <div class="form-group">
            <label>Branch</label>
            <select name="branch_id" id="branch_id" class="form-control">
                <option selected disabled value="">Select Branch</option>
                <?php
                  $query="select * from branches where id in (".$this->session->branches.")";
                  $result = $this->branch_model->_custom_query($query)->result();

                  foreach ($result as  $value) {
                    ?>
                      <option value="<?= $value->id; ?>"><?= $value->branch_name;?></option>
                    <?php
                  }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>
        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default btn-sm"><span class="fa fa-print"></span> Print</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="inventory_report" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Inventory Report Details</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('pos/print_inventory',array('id'=>'inventory_report_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="error_message">
        </div>

        <div class="form-group">
            <label>Branch</label>
            <select name="branch_id" id="branch_id" class="form-control">
                <option selected disabled value="">Select Branch</option>
                <?php
                  $query="select * from branches where id in (".$this->session->branches.")";
                  $result = $this->branch_model->_custom_query($query)->result();

                  foreach ($result as  $value) {
                    ?>
                      <option value="<?= $value->id; ?>"><?= $value->branch_name;?></option>
                    <?php
                  }
                ?>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> Add Order</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
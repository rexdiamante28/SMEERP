<div class="modal fade" id="unique_order_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Order Details</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('pos/add_order',array('id'=>'unique_order_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="unique_error_message">
        </div>

        <div class="form-group">
            <label>IMEI</label>
            <input type="text" name="unique_id" id="unique_id" class="form-control">
            <input type="text" name="store_item_id" id="store_item_id" class="form-control" style="display:none">
            <input type="text" name="selling_price" id="selling_price" class="form-control" style="display:none">
        </div>
        <div id="imei-div" class="card">
        </div>
      </div>
      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> Add Order</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
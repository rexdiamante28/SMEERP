<div class="modal fade" id="add_record_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Order Details</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('pos/add_order',array('id'=>'add_record_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="error_message">
        </div>

        <div class="form-group hidden">
            <label>Store Item Id</label>
            <input type="text" name="item_movement_item_id" readonly id="item_movement_item_id" class="form-control">
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" name="quantity" id="quantity" class="form-control">
        </div>
        <div class="form-group">
            <label>Discount (%)</label>
            <input type="text" name="discount" id="discount" class="form-control">
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
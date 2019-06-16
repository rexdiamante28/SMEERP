<div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Payment Details</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('pos/pay_order',array('id'=>'pay_order_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="error_message">
        </div>

        <div class="form-group">
            <label>Total: P</label>
            <input type="text" name="total" readonly id="total" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Total Discount: P</label>
            <input type="text" name="discount" readonly id="discount" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Total Tax: P</label>
            <input type="text" name="tax" readonly id="tax" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Amount Due: P</label>
            <input type="text" name="amount_due" id="amount_due" class="form-control">
        </div>
        <div class="form-group">
            <label>Balance: P</label>
            <input type="text" name="amount_balance" id="amount_balance" class="form-control">
        </div>
        <div class="form-group">
            <label>Balance due date:</label>
            <input type="date" name="balance_due_date" id="balance_due_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Change: P</label>
            <input type="text" name="change" id="change" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Remarks</label>
            <input type="text" name="remarks" id="remarks" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> Save Payment</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Order Details</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open('users/change_password',array('id'=>'change_password_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="error_message">
        </div>

        <div class="form-group ">
            <label>Current Password</label>
            <input type="text" name="current_password" id="current_password" class="form-control">
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="text" name="new_password" id="new_password" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="text" name="confirm_password" id="confirm_password" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> Update Password</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
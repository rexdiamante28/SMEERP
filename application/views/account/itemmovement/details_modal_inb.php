<div class="modal fade" id="details_modal_inb" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Item Movement Items</strong></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger hidden" id="error_message">
        
        </div>
        <div class="row" id="details_modal_content_inb">
            <?php $this->load->view('common/loading'); ?>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id = "accept_oub_to_inb">Accept</button>
        <button type="button" class="btn btn-default btn-sm"  data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade" id="details_modal_inb_accept" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Accept Items</strong></h4>
      </div>
      <div class="modal-body">
        <h4>Please make sure you have checked all the items if they are complete. Click 'Confirm' to proceed.</h4>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id = "accept_oub_to_inb_confirm">Confirm</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>


<div class="modal fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Item Movement Items</strong></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger hidden" id="error_message">
        
        </div>
        <div class="row" id="details_modal_content">
            <?php $this->load->view('common/loading'); ?>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" id = "add_item_in_movement_button">Add New Item</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>
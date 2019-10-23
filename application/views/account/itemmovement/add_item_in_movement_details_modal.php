<div class="modal fade" id="add_item_in_movement_details_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Item Movement Items</strong></h4>
      </div>
      <?php
        echo form_open('itemmovements/add_item_in_movement',array('id'=>'add_item_in_movement_details_form','method'=>'post'));
      ?>
      <div class="modal-body">
        <div class="alert alert-danger hidden" id="error_message">
        
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">id :</label>
              </div>

              <div class="col-lg-8 col-md-8 ">
                <div id="subject_combo">
                  <input type="text" class="form-control " readonly name="id" id="id" >
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Movement Id :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo ">
                  <input type="text" class="form-control " readonly name="movement_id" id="movement_id" >
                  <input type="text" class="form-control " readonly name="movement_type" id="movement_type" >
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Item Id :</label>
              </div>

              <div class="col-lg-8 col-md-8 ">
                <div id="subject_combo">
                  <input type="text" class="form-control " readonly name="item_id" id="item_id" >
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 " style="margin-bottom: 15px;">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Quantity :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo">
                  <input type="text" class="form-control" name="quantity" id="quantity" >
                </div>
              </div>
            </div>


            <div class="col-lg-12 col-md-12 " style="margin-bottom: 15px;" id="buying_price-div">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Unit Price :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo">
                  <input type="text" class="form-control" name="buying_price" id="buying_price" >
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 " style="margin-bottom: 15px;" id="selling_price-div">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Market Price :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo">
                  <input type="text" class="form-control" name="selling_price" id="selling_price" >
                </div>
              </div>
            </div>            

            <div class="col-lg-12 col-md-12 " style="margin-bottom: 15px;" id="supplier-div">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Supplier :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo">
                  <input type="text" class="form-control" name="supplier" id="supplier" >
                </div>
              </div>
            </div>            

            <div class="col-lg-12 col-md-12 " style="margin-bottom: 15px;" id="incentives-div">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">Incentives :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo">
                  <input type="text" class="form-control" name="incentives" id="incentives" >
                </div>
              </div>
            </div>            

            <div class="col-lg-12 col-md-12 " style="margin-bottom: 15px;" id="remarks-div">
              <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
                <label for="subject_code">DR NO. :</label>
              </div>

              <div class="col-lg-8 col-md-8">
                <div id="subject_combo">
                  <textarea type="text" class="form-control" name="remarks" id="remarks" ></textarea>
                </div>
              </div>

               <span class="pull-right hidden" id="form-loading" style="margin-right:15px;">
                  <?php $this->load->view('common/loading');?>
                </span>
            </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" id="add_item_to_movement_submit" class="btn btn-primary btn-sm" >Submit</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>
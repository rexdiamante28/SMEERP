<div class="modal fade" id="add_record_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog <?php if(isset($modal_size)){echo $modal_size;}?>" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong>Item Record</strong></h4>
      </div>
      <div class="modal-body">
      <?php echo form_open_multipart('items/upload_photo',array('id'=>'upload_image_form','method'=>'post')) ?>
          <div class="col-lg-12 col-md-12 no-padd" style="margin-bottom: 15px;" hidden>
            <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
              <label for="subject_desc">Item Image :</label>
            </div>

            <div class="col-lg-8 col-md-8" hidden>
              <input type="file" name="item_image" id="item_image" class="hidden_td" >
              <img id="img_preview" class="img-thumbnail img-responsive col-xs-12 padd-10 point" src="<?= base_url().'assets/images/items/default.png'?>" >
              <button class="btn btn-xs hidden btn-primary" id="uploadbutton"  type="submit">Upload Image</button>
            </div>
            <span class="pull-right hidden" id="upload-loading" style="margin-right:15px;">
                <?php $this->load->view('common/loading');?>
            </span>
          </div>
      </form>

      <?php echo form_open('items/add_item',array('id'=>'add_record_form','method'=>'post')) ?>
        <div class="alert alert-danger hidden" id="error_message">
        
        </div>
        <div class="row">

          <?php $this->load->view('account/items/add_item'); ?>

          <span class="pull-right hidden" id="form-loading" style="margin-right:15px;">
            <?php $this->load->view('common/loading');?>
          </span>

        </div>
      </div>

      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>
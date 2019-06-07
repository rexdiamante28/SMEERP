<!-- Modal form
parameters
1. modal id
2. modal title
3. action url
4. form view
-->
<div class="modal fade" id="<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog <?php if(isset($modal_size)){echo $modal_size;}?>" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><strong><?= $title; ?></strong></h4>
      </div>
      <?php
        $myformid = "";
        if(isset($form_id)){$myformid =  $form_id;}else{$myformid = 'add_record_form';}

        if(isset($enctype))
        {
            echo form_open_mutipart($action,array('id'=>$myformid,'method'=>'post'));
        }
        else
        {
            echo form_open($action,array('id'=>$myformid,'method'=>'post'));
        }
        
      ?>
      <div class="modal-body">
        <div class="alert alert-danger hidden" id="error_message">
        
        </div>
        <div class="row">

          <?= $form; ?>

          <span class="pull-right hidden" id="form-loading" style="margin-right:15px;">
            <?php $this->load->view('common/loading');?>
          </span>

        </div>
      </div>

      <div class="modal-footer">
        <button name="submit" type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-save"></span> Save</button>
        <?php
            if(isset($data_number))
            {
                ?>
                    <button type="button" class="btn btn-default btn-sm" id="modal_id<?= $data_number; ?>"  data-number="<?= $data_number; ?>">Close</button>
                <?php
            }
            else
            {
                ?>
                    <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
                <?php
            }
        ?>
      </div>
      </form>

    </div>
  </div>
</div>
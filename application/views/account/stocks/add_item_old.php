<div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_code">id :</label>
  </div>
  <div class="col-lg-8 col-md-8">
    <div id="subject_combo">
      <input type="text" class="form-control" name="id" id="id" placeholder="Id">
      <input type="text" class="form-control" name="img_preview" id="img_preview" placeholder="Id" value="<?= base_url().'assets/images/items/default.png'; ?>">
    </div>
  </div>
</div>

<div class="col-xs-12">
  <table class="table">
      <tr>
          <td >Item Image</td>
          <td>
            <img id="t_item_image" src="" style="width:100px;">
          </td>
      </tr>
      <tr>
          <td >Branch</td>
          <td id="t_branch"></td>
      </tr>
      <tr>
          <td >Category</td>
          <td id="t_category"></td>
      </tr>
      <tr>
          <td >Item Name</td>
          <td id="t_item_name"></td>
      </tr>
      <tr>
          <td >Item Unit</td>
          <td id="t_item_unit"></td>
      </tr>
      <tr>
          <td >Item Description</td>
          <td id="t_item_description"></td>
      </tr>
      <tr>
          <td >Item Code</td>
          <td id="t_item_code"></td>
      </tr>
      <tr>
          <td >Bar Code</td>
          <td id="t_bar_code"></td>
      </tr>
      <tr>
          <td >Unique Identifier</td>
          <td id="t_unique_identifier"></td>
      </tr>
      <tr>
          <td >Remaining Stock</td>
          <td id="t_item_stock"></td>
      </tr>
  </table>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Threshold Minimum :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="threshold_min" id="threshold_min" placeholder="Minimum stock" >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Threshold Maximum :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="threshold_max" id="threshold_max" placeholder="Maximum stock" >
  </div>
</div>

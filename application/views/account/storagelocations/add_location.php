<div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_code">id :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <div id="subject_combo">
      <input type="text" class="form-control" name="id" id="id" placeholder="Id">
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Branch :</label>
  </div>
  <div class="col-lg-8 col-md-8">
      <select name="branch_id" id="branch_id" class="form-control">
        <option disabled  value="" selected>Select Branch</option>
        <?php
            $query="select * from branches where id in (".$this->session->branches.")";
            $branches = $this->branch_model->_custom_query($query)->result();

            foreach ($branches as $value) {
              ?>
                  <option value="<?= $value->id; ?>"><?= $value->branch_name; ?></option>
              <?php
            }
        ?>
      </select>
  </div>

</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Location Name :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="location_name" id="location_name" placeholder="Location name" >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Description :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <textarea class="form-control" name="description" id="description" placeholder="Description" ></textarea>
  </div>
</div>

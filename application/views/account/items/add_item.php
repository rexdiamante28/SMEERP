<div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_code">id :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <div id="subject_combo">
      <input type="text" class="form-control" name="id" id="id" placeholder="Id">
      <input type="text" class="form-control" name="image_name" id="image_name" >
    </div>
  </div>
</div>



<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Has Unique Identifier :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="checkbox" name="unique_identifier" id="unique_identifier">
  </div>
</div>



<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Category :</label>
  </div>
  <div class="col-lg-8 col-md-8">
      <select name="item_category" id="item_category" class="form-control">
        <option disabled  value="" selected>Select Category</option>
        <?php
            $query="select * from item_categories";
            $categories = $this->itemcategories_model->_custom_query($query)->result();

            foreach ($categories as $value) {
              ?>
                  <option value="<?= $value->id; ?>"><?= $value->category_string; ?></option>
              <?php
            }
        ?>
      </select>
  </div>

</div>


<!-- <div class="col-lg-12 col-md-12" style="margin-bottom: 15px;" hidden>
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Code :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="item_code" id="item_code" placeholder="Item Code" >
  </div>
</div> -->
<!-- 
<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Bar Code :</label>
  </div> -->
<!-- 
  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="bar_code" id="bar_code" placeholder="Bar Code" >
  </div>
</div> -->

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Name :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Price :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="price" id="price" placeholder="Item Price" >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Generic Name :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="generic_name" id="generic_name" placeholder="Generic Name" >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Unit :</label>
  </div>
  <div class="col-lg-8 col-md-8">
      <select name="item_unit" id="item_unit" class="form-control">
        <option disabled  value="" selected>Select Unit</option>
        <?php
            $query="select * from item_units";
            $units = $this->itemunits_model->_custom_query($query)->result();

            foreach ($units as $value) {
              ?>
                  <option value="<?= $value->id; ?>"><?= $value->unit; ?></option>
              <?php
            }
        ?>
      </select>
  </div>

</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Status :</label>
  </div>
  <div class="col-lg-8 col-md-8">
      <select name="status" id="status" class="form-control">
        <option disabled  value="" selected>Select Status</option>
        <option   value="1" >Active</option>
        <option   value="0" >Inactive</option>
      </select>
  </div>

</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Item Description :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <textarea class="form-control" name="item_description" id="item_description" placeholder="Item Description" ></textarea>
  </div>
</div>


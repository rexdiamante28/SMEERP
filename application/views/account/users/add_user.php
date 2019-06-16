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

<div class="col-xs-12">
  <h4>User Privileges</h4>
      <div id="function_options_div">
        <h5>General</h5>
        <label><input type="checkbox" class="function_option" value= "Manage Users"> Manage Users</label><br/>
        <label><input type="checkbox" class="function_option" value= "Manage Branches"> Manage Branches</label><br/>
        <label><input type="checkbox" class="function_option" value= "Manage Locations"> Manage Locations</label><br/>
        <label><input type="checkbox" class="function_option" value= "Manage Items"> Manage Items</label><br/>
        <label><input type="checkbox" class="function_option" value= "Manage Stocks"> Manage Stocks</label><br/>
        <label><input type="checkbox" class="function_option" value= "Sell Items"> Sell Items</label><br/>
        <label><input type="checkbox" class="function_option" value= "View Reports"> View Reports</label><br/>
        <h5>Notifications</h5>
        <small class="fred1"><b>Note:</b> Notifications are broadcasted accross branches as long
        as the user have rights to them.</small><br/>
        <label><input type="checkbox" class="function_option" value= "Notification Sales"> Notification Sales</label><br/>
        <label><input type="checkbox" class="function_option" value= "Notification Inventory"> Notification Inventory</label><br/>
        <label><input type="checkbox" class="function_option" value= "Notification Users"> Notification Users</label><br/>
        <label><input type="checkbox" class="function_option" value= "Notification Items"> Notification Items</label><br/>
      </div>
  <hr>
  <h4>Branch Asssignments</h4>
      <div id="branches_options">
          <?php
                $query="select * from branches";
                $branches = $this->branch_model->_custom_query($query)->result();

                foreach ($branches as $value) {
                  ?>
                      <label><input type="checkbox" class="branch_option" value="<?= $value->id; ?>" name="branches"> <?= $value->branch_name; ?></label><br/>
                  <?php
                }
          ?>
      </div>
  <hr>
  <h4>User Details</h4>
</div>

<div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">branches:</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="branches_list" id="branches_list" readonly>
  </div>
</div>

<div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">functions:</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="functions_list" id="functions_list" readonly>
  </div>
</div>


<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Username :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="username" id="username"  >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">First Name :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="first_name" id="first_name"  >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Middle Name :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="middle_name" id="middle_name"  >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Last Name:</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="last_name" id="last_name"  >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Telephone Number :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="telephone_number" id="telephone_number"  >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Mobile Number :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="mobile_number" id="mobile_number"  >
  </div>
</div>


<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Email Address :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input type="text" class="form-control" name="email_address" id="email_address"  >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Status :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <select type="text" class="form-control" name="status" id="status"  >
        <option selected disabled value="">Select Status</option>
        <option value="1">Active</option>
        <option  value="0">Inactive</option>
    </select>
  </div>
</div>
<div class="col-lg-12 col-md-12 hidden" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_code">id :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <div id="subject_combo">
      <input type="text" class="form-control" name="id" id="id" placeholder="branch Id">
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
    <label for="subject_desc">Facilitator :</label>
  </div>

  <div class="col-lg-8 col-md-8">
      <select name="facilitator" id="facilitator" class="form-control">
      </select>
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Reference Code :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input class="form-control" name="code" id="code" placeholder="Reference Code" >
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Type :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <select class="form-control" name="type" id="type">
        <option value="" disabled selected>Select Type</option>
        <option value="Inbound">Inbound</option>
        <option value="Outbound">Outbound</option>
        <option value="Orders">Orders</option>
        <option value="Damages">Damages</option>
        <option value="Quarantine">Quarantine</option>
    </select>
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;" hidden id="move_to_branch">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Move to Branch :</label>
  </div>

  <div class="col-lg-8 col-md-8" >
      <select name="branch_id2" id="branch_id2" class="form-control">
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
    <label for="subject_desc">Date :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <input class="form-control" type="date" name="date" id="date" >
  </div>
</div>


<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Status :</label>
  </div>

  <div class="col-lg-8 col-md-8">
      <select name="status" id="status" class="form-control">
        <option disabled  value="" selected>Select status</option>
        <option value="Draft">Draft</option>
        <option value="Reviewed">Reviewed</option>
        <option value="Approved">Approved</option>
        <option value="Closed">Closed</option>
      </select>
  </div>
</div>

<div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
  <div class="col-lg-4 col-md-4" style="padding-top: 5px;">
    <label for="subject_desc">Internal Notes :</label>
  </div>

  <div class="col-lg-8 col-md-8">
    <textarea class="form-control" name="internal_notes" id="internal_notes" ></textarea>
  </div>
</div>

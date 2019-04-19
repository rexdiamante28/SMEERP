<div class="content-inner" id="pageActive" data-num="3">

<?= $breadcrumb; ?>

<?php

    //set values
    $primary = "";
    $pofile_fname = "";
    $pofile_mname = "";
    $pofile_lname = "";

    if(!$form_empty)
    {
        $primary = en_dec('en',$form_data['id']);
        $pofile_fname = $form_data['first_name'];
        $pofile_mname = $form_data['middle_name'];
        $pofile_lname = $form_data['last_name'];
        $pofile_pnumber = $form_data['phone_number'];
        $pofile_mnumber = $form_data['mobile_number'];
        $pofile_email = $form_data['email'];
    }

?>

    <div class="content-container">
        <div class="row">
            <div class="col-12">  
                <form id="profile_form" class="col-12" method="post" action="<?= $form_action; ?>">
                    <div class="form-group hidden">
                        <input type="text" name="primary" id="primary" value="<?= $primary; ?>" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>First Name<span class="asterisk asteriskww" style="color:red">*</span></label>
                                    <input required type="text" class="form-control char_only" maxlength="100" value="<?=$pofile_fname?>" name="first_name" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input  id="" type="text" class="form-control   char_only" maxlength="100" value="<?=$pofile_mname?>" name="middle_name" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Last Name<span class="asterisk" style="color:red">*</span></label>
                                <input required id="" type="text" class="form-control  lnameinput char_only_1" maxlength="100" value="<?=$pofile_lname?>" name="last_name" data-placement="right">
                            </div>                                    
                        </div>                                    
                    </div> 

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile Number<span class="asterisk asteriskww" style="color:red">*</span></label>
                                    <input required id="" type="text" class="form-control  char_only" maxlength="11" value="<?=$pofile_mnumber?>" name="mobile_number" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input  id="" type="text" class="form-control char_only" maxlength="20" value="<?=$pofile_pnumber?>" name="phone_number" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email<span class="asterisk" style="color:red">*</span></label>
                                <input required id="" type="text" class="form-control  lnameinput char_only_1" maxlength="100" value="<?=$pofile_email?>" name="email" data-placement="right">
                            </div>                                    
                        </div>                                    
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>
                </form>
            </div>
        </div><br/>
    </div>

</div>
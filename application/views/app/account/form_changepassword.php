<div class="content-inner" id="pageActive" data-num="3">

<?= $breadcrumb; ?>

<?php

    $primary = en_dec('en',$form_data['id']);

?>

    <div class="content-container">
        <div class="row">
            <div class="col-12">  
                <form id="changepassword_form" class="col-12" method="post" action="<?= $form_action; ?>">
                    <div class="form-group hidden">
                        <input type="text" name="primary" id="primary" value="<?= $primary; ?>" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Current Password<span class="asterisk asteriskww" style="color:red">*</span></label>
                                    <input required type="password" class="form-control char_only" maxlength="100"  name="current_password" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>New Password<span class="asterisk asteriskww" style="color:red">*</span></label>
                                <input  id="" type="password" class="form-control   char_only" maxlength="100"  name="new_password" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Confirm New Password<span class="asterisk" style="color:red">*</span></label>
                                <input required id="" type="password" class="form-control  lnameinput char_only_1" maxlength="100" name="confirm_password" data-placement="right">
                            </div>                                    
                        </div>                                    
                    </div> 
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Update Password</button>
                    </div>
                </form>
            </div>
        </div><br/>
    </div>

</div>
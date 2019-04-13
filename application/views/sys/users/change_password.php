<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="" data-labelname="">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
    <div class="container-fluid">
        
                <div class="row">
                    <div class="col-4 offset-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <?php echo form_open(base_url().'sys/users/change_password_save',array('id'=>'change_user_password_form','method'=>'post')) ?>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="old_password"  id="old_password" class="form-control" placeholder="Old Password">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_password"  id="new_password" class="form-control" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" name="confirm_password"  id="confirm_password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg pull-right">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    
</div>




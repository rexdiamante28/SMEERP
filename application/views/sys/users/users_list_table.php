<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="" data-labelname="">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
    
    <section class="tables">   
        <div class="container-fluid">
            <section class="tables">   
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border-top-gray" id="searchRN">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <input type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="searchtext">
                                                            <button class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="button" id="searchBtn">
                                                                <i class="fa fa-search no-margin"></i>
                                                            </button>
                                                            <?php
                                                                if($this->loginstate->get_access()['admin']['settings']['users']['create']==1)
                                                                {
                                                                    ?>
                                                                        <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="newuser_btn">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add
                                                                        </button>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-bordered table-grid" id="table-grid">
                                        <thead>
                                            <tr>
                                                <th>User Avatar</th>
                                                <th>Username</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>




<?php
    if($this->loginstate->get_access()['admin']['accounts']['merchants']['create']==1)
    {
        ?>
            <!-- Modals-->
            <div id="addusermodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-md-12">
                                <h4 id="exampleModalLabel" class="modal-title">User</h4>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <?php echo form_open_multipart(base_url().'sys/users/create_user',array('id'=>'user_form','method'=>'post')) ?>
                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="password" name="f_id" id="f_id" class="form-control" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                 <label>User Avatar</label><br/>
                                                 <input type="file" class="hidden" name="avatar_image" id="avatar_image">
                                                 <div id="avatar-placeholder"></div>
                                                 <img src="" id="avatar_preview" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>User Email</label>
                                                <input type="text" name="f_email" id="f_email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="input-group">
                                                <input type="password" name="f_password" id="f_password" class="form-control" placeholder="Password">
                                                <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="passwordunmask_btn">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select style="height:42px;" type="text" name="f_user_status" id="f_user_status" class="form-control" placeholder="Status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr/>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button data-toggle="collapse" data-target="#demo" class="btn btn-primary">Access Control</button>
                                        </div>
                                        <div id="demo" class="collapse col-12">
                                            <div class="row col-12">
                                                <?php $this->load->view('sys/access_control/access_control_view'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-default cancelBtn waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
                                <button type="button" id="initiate_btn" class="btn btn-primary  waves-effect waves-light">
                                    <i class="fa fa-save"></i>
                                    <span>Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>
